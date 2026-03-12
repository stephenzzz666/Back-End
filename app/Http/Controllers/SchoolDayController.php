<?php
namespace App\Http\Controllers;

use App\Models\SchoolDay;

class SchoolDayController extends Controller
{
    public function index()
    {
        return response()->json(SchoolDay::all());
    }
}