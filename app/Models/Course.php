<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'course_name',
        'description',
    ];

    /**
     * A course can have many enrollments
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get all students enrolled in this course
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }
}