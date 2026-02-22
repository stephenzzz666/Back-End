<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course'])->get();
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id'  => 'required|exists:courses,id',
            'score'      => 'nullable|numeric|min:0|max:100',
            'grade'      => 'nullable|string|max:2',
        ]);

        $grade = $request->grade ?: Enrollment::scoreToGrade($request->score);

        Enrollment::create([
            'student_id' => $request->student_id,
            'course_id'  => $request->course_id,
            'score'      => $request->score,
            'grade'      => $grade,
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment added successfully.');
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id'  => 'required|exists:courses,id',
            'score'      => 'nullable|numeric|min:0|max:100',
            'grade'      => 'nullable|string|max:2',
        ]);

        $grade = $request->grade ?: Enrollment::scoreToGrade($request->score);

        $enrollment->update([
            'student_id' => $request->student_id,
            'course_id'  => $request->course_id,
            'score'      => $request->score,
            'grade'      => $grade,
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}