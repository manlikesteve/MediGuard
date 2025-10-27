from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
import joblib
import numpy as np
import os

# Initialize FastAPI app
app = FastAPI(
    title="MediGuard Isolation Forest API",
    description="FastAPI backend serving the Isolation Forest model for network anomaly detection in MediGuard.",
    version="1.0.0",
    docs_url="/docs",         # enable Swagger docs
    redoc_url="/redoc",       # enable ReDoc docs
    openapi_url="/openapi.json"  # ensure OpenAPI spec is served
)

# Define model path relative to this file
MODEL_PATH = os.path.join(os.path.dirname(__file__), "isolation_forest_model.pkl")

# Load model at startup
@app.on_event("startup")
def load_model():
    global model
    try:
        print("[INFO] Loading Isolation Forest model...")
        model = joblib.load(MODEL_PATH)
        print("[SUCCESS] Model loaded successfully!")
    except Exception as e:
        print(f"[ERROR] Could not load model: {e}")
        model = None

# Define input schema for prediction
class TrafficSample(BaseModel):
    features: list[float]

@app.get("/")
def root():
    return {"message": "MediGuard Model Server is running."}

@app.get("/test")
def test_endpoint():
    return {"status": "OK", "message": "Test route reachable"}

@app.post("/predict")
def predict(sample: TrafficSample):
    if model is None:
        raise HTTPException(status_code=500, detail="Model not loaded.")
    
    try:
        X = np.array(sample.features).reshape(1, -1)
        prediction = model.predict(X)[0]
        result = "Anomaly (Potential Threat)" if prediction == -1 else "Normal"
        return {"prediction": result}
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))