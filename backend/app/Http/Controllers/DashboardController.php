<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Threat;

class DashboardController extends Controller
{
    /**
     * Display dashboard metrics.
     */
    public function index()
    {
        $activeThreats = Threat::where('status', 'active')->count();
        $reviewedAlerts = Threat::where('status', 'reviewed')->count();

        $recentDoS = Threat::where('type', 'DoS')
            ->where('detected_at', '>=', now()->subMinutes(30))
            ->where('status', 'active')
            ->count();

        $systemStatus = $recentDoS > 0 ? 'Under Attack' : 'Secure';

        return view('analyst.dashboard', compact(
            'activeThreats',
            'reviewedAlerts',
            'systemStatus'
        ));
    }

    /**
     * Handle prediction requests from dashboard (AJAX).
     */
    public function predict(Request $request)
    {
        try {
            // Parse features input (array of floats)
            $features = $request->input('features');
            if (!is_array($features)) {
                $features = array_map('floatval', explode(',', $features));
            }

            // URL of the FastAPI model server
            $modelServerUrl = config('services.ml_api.url', 'http://127.0.0.1:8005/predict');

            // Make HTTP POST request to FastAPI model
            $response = Http::timeout(10)->post($modelServerUrl, [
                'features' => $features
            ]);

            if ($response->failed()) {
                return response()->json([
                    'error' => 'Prediction service returned an error.',
                    'details' => $response->body(),
                ], 500);
            }

            $result = $response->json();

            // Return JSON for JS to display in dashboard
            return response()->json([
                'status' => 'success',
                'prediction' => $result['prediction'] ?? 'Unknown',
                'input_feature_count' => $result['input_feature_count'] ?? count($features),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => '⚠️ Error connecting to prediction service',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}