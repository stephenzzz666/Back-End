<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
    ];

    /**
     * A student can have many enrollments
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get all courses the student is enrolled in
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
}