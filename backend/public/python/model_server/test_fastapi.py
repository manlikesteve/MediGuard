from fastapi import FastAPI

app = FastAPI()

@app.get("/")
def home():
    return {"message": "Hello from test FastAPI"}

# Run with: uvicorn test_fastapi:app --reload --port 8010
