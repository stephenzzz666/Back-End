<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| All routes are linked to the corresponding controllers and views.
|
*/

// Homepage redirect to students list
Route::get('/', function () {
    return redirect()->route('students.index');
});

// ----------------------------
// Student Routes
// ----------------------------
Route::resource('students', StudentController::class);

// ----------------------------
// Course Routes
// ----------------------------
Route::resource('courses', CourseController::class);

// ----------------------------
// Enrollment Routes (with grading)
// ----------------------------
Route::resource('enrollments', EnrollmentController::class);