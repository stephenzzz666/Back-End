<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Enrollment by Month (Bar Chart)
        $enrollments = Student::select(
            DB::raw('count(*) as count'), 
            DB::raw("DATE_FORMAT(created_at, '%M') as month")
        )
        ->groupBy('month')
        ->orderBy('created_at')
        ->get();

        // 2. Course Distribution (Pie Chart)
        $courses = Course::withCount('students')->get()->map(function($course) {
            return [
                'name' => $course->name,
                'value' => $course->students_count
            ];
        });

        return response()->json([
    'enrollments' => $enrollments,
    'courses' => $courses,
    'stats' => [
        'total_students' => Student::count(),
        'total_courses' => Course::count(),
    ],
    // 📊 Add this for the Line Chart:
    'attendance' => \App\Models\SchoolDay::orderBy('date', 'asc')
        ->take(10)
        ->get(['date', 'present_count'])
]);
    }
}