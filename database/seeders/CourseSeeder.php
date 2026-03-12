<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $departments = ['Math', 'Science', 'History', 'English', 'Art'];
        for ($i = 1; $i <= 20; $i++) {
            Course::create([
                'name' => "Course $i",
                'department' => $departments[array_rand($departments)],
            ]);
        }
    }
}