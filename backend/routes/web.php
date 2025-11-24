<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Define all web routes for the MediGuard system.
| - Public welcome page for guests
| - Dashboard and model prediction routes for authenticated users
| - Profile management routes
|
*/

// Public Welcome Page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/test-ml', function () {
//     try {
//         $response = Http::timeout(10)->get('http://127.0.0.1:8005/test');
//         return $response->json();
//     } catch (\Exception $e) {
//         return response()->json(['error' => $e->getMessage()], 500);
//     }
// });

// Authenticated Dashboard (Main Page)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Prediction API (handles form submission for ML model)
Route::post('/predict', [DashboardController::class, 'predict'])
    ->middleware(['auth'])
    ->name('predict');

// Profile Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';