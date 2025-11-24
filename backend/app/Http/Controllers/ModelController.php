<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ModelController extends Controller
{
    public function predict(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'features' => 'required|array',
            'features.*' => 'numeric'
        ]);

        // Send features to FastAPI
        $response = Http::post('http://127.0.0.1:8005/predict', [
            'features' => $validated['features']
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to contact model server'], 500);
        }

        return response()->json($response->json());
    }
}