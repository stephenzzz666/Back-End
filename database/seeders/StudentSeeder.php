<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $courseIds = Course::pluck('id')->toArray();

        for ($i = 0; $i < 500; $i++) {
            Student::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'birthdate' => $faker->date(),
                'course_id' => $faker->randomElement($courseIds),
            ]);
        }
    }
}