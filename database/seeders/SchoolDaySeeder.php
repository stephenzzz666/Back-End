<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolDay;
use Carbon\Carbon;

class SchoolDaySeeder extends Seeder
{
    public function run()
    {
        $start = Carbon::create(2026, 1, 1);
        $end = Carbon::create(2026, 12, 31);

        for ($date = $start; $date <= $end; $date->addDay()) {
            // Only weekdays
            if ($date->isWeekday()) {
                SchoolDay::create([
                    'date' => $date->toDateString(),
                    'type' => 'school day',
                ]);
            }
        }
    }
}