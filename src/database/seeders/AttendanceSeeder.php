<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Work;
use App\Models\Rest;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user_id = 1;

       $attendance = Attendance::create([
        'user_id' => $user_id,
        'clock_in' => Carbon::now()->subHours(8), // Mock clock in time 8 hours ago
        'clock_out' => Carbon::now(), // Mock clock out time as current time
        // Add more fields as needed
    ]);


       $work = Work::create([
        'user_id' => $attendance->user_id,
        'date' => $attendance->clock_in->format('Y-m-d'),
        'start' => now()->format('H:i:s'),
        // Add more fields as needed
    ]);

    // Mock break start and end time
    $breakStartTime = Carbon::parse($attendance->clock_in)->addHours(1);
    $breakEndTime = Carbon::parse($breakStartTime)->addMinutes(30);

    // Create mock data for rest
    Rest::create([
        'work_id' => $work->id,
        'start' => $breakStartTime->format('H:i:s'),
        'end' => $breakEndTime->format('H:i:s'),
        // Add more fields 
    ]);
    
    
    }
}

