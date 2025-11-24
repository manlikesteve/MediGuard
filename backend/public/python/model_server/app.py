from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
import joblib
import numpy as np
import os

# ===================
# FastAPI Init
# ===================
app = FastAPI(
    title="MediGuard Model Server",
    description="API serving Isolation Forest and Random Forest models.",
    version="2.0"
)

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Ideally use ["http://127.0.0.1:8000"] for production
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# ===================
# Model Paths
# ===================
BASE_DIR = os.path.dirname(__file__)
ISO_MODEL_PATH = os.path.join(BASE_DIR, "isolation_forest_model.pkl")
RF_MODEL_PATH = os.path.join(BASE_DIR, "rf_detection_model.pkl")

isolation_model = None
rf_model = None


@app.on_event("startup")
def load_models():
    global isolation_model, rf_model
    print("[INFO] Loading models...")
    try:
        isolation_model = joblib.load(ISO_MODEL_PATH)
        print("[SUCCESS] Isolation Forest model loaded.")
    except:
        print("[ERROR] Could not load Isolation Forest model.")

    try:
        rf_model = joblib.load(RF_MODEL_PATH)
        print("[SUCCESS] Random Forest model loaded.")
    except:
        print("[ERROR] Could not load Random Forest model.")


# ===================
# Schema
# ===================
class TrafficSample(BaseModel):
    features: list[float]


# ===================
# Utility
# ===================
def generate_comment(prediction):
    if "Anomaly" in prediction or "Detected" in prediction:
        return "⚠️ Investigate immediately. Check network logs and isolate the source if required."
    return "✔ Normal. No further action needed."


# ===================
# Routes
# ===================
@app.get("/")
def root():
    return {"message": "MediGuard API running successfully."}


@app.post("/predict")
def predict_isolation(sample: TrafficSample):
    if isolation_model is None:
        raise HTTPException(status_code=500, detail="Isolation model not loaded.")

    X = np.array(sample.features).reshape(1, -1)
    prediction = isolation_model.predict(X)[0]
    result = "Anomaly (Potential Threat)" if prediction == -1 else "Normal"

    return {
        "prediction": result,
        "model": "Isolation Forest",
        "comment": generate_comment(result)
    }


@app.post("/predict-rf")
def predict_rf(sample: TrafficSample):
    if rf_model is None:
        raise HTTPException(status_code=500, detail="Random Forest model not loaded.")

    X = np.array(sample.features).reshape(1, -1)
    prediction = rf_model.predict(X)[0]
    result = "Normal" if prediction == 1 else "DoS Attack Detected"

    return {
        "prediction": result,
        "model": "Random Forest",
        "comment": generate_comment(result)
    }