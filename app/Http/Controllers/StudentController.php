<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Return all students with their course relationship
        return response()->json(Student::with('course')->get());
    }
}