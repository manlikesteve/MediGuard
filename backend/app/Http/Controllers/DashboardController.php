<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Threat;

class DashboardController extends Controller
{
    public function index()
    {
        $activeThreats = Threat::where('status', 'active')->count();
        $reviewedAlerts = Threat::where('status', 'reviewed')->count();

        // System status: Secure if no active DoS alerts in the last 30 mins
        $recentDoS = Threat::where('type', 'DoS')
            ->where('detected_at', '>=', now()->subMinutes(30))
            ->where('status', 'active')
            ->count();

        $systemStatus = $recentDoS > 0 ? 'Under Attack' : 'Secure';

        return view('dashboard', compact('activeThreats', 'reviewedAlerts', 'systemStatus'));
    }
}
