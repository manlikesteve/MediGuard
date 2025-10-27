<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Threat;

class DashboardController extends Controller
{
    /**
     * Display the analyst dashboard with live metrics.
     */
    public function index()
    {
        $activeThreats = Threat::where('status', 'active')->count();
        $reviewedAlerts = Threat::where('status', 'reviewed')->count();

        // Determine system status
        $recentDoS = Threat::where('type', 'DoS')
            ->where('detected_at', '>=', now()->subMinutes(30))
            ->where('status', 'active')
            ->count();

        $systemStatus = $recentDoS > 0 ? 'Under Attack' : 'Secure';

        // Render dashboard with statistics
        return view('dashboard', compact('activeThreats', 'reviewedAlerts', 'systemStatus'));
    }

    /**
     * Handle prediction request from dashboard form.
     */
    public function predict(Request $request)
    {
        $featuresInput = $request->input('features');

        // Convert the comma-separated string to a numeric array
        $features = array_map('floatval', explode(',', $featuresInput));

        try {
            $response = Http::timeout(10)->post(config('services.ml_api.url'), [
                'features' => $features
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return back()->with('prediction', $result['prediction'] ?? 'No prediction');
            } else {
                return back()->with('error', 'Model API error: ' . $response->body());
            }

        } catch (\Exception $e) {
            \Log::error('Prediction API connection error: ' . $e->getMessage());
            return back()->with('error', '⚠️ Error connecting to prediction service. Please check if the model server is running.');
        }
    }
}