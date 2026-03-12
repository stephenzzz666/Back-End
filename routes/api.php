<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolDayController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 🔓 Public Routes
// We add ->name('login') here so the middleware knows this is the login route
Route::post('login', [AuthController::class, 'login'])->name('login');

// 🔒 Protected Routes (Require a valid Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    
    // Authentication
    Route::post('logout', [AuthController::class, 'logout']);

    // 📊 Dashboard Analytics (For your Charts)
    Route::get('dashboard-stats', [DashboardController::class, 'index']);

    // 👥 Resource Data
    Route::get('students', [StudentController::class, 'index']);
    Route::get('courses', [CourseController::class, 'index']);
    Route::get('school-days', [SchoolDayController::class, 'index']);

    // 🛠️ Health Check
    Route::get('/ping', function () {
        return response()->json(['status' => 'pong']);
    });
});

// 💡 Fallback for browser testing
// If you visit a protected route in the browser, this prevents the 500 error
Route::get('login', function () {
    return response()->json([
        'message' => 'Unauthenticated. Please login via the frontend.'
    ], 401);
});