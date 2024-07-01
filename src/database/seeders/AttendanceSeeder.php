<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        // Get all user IDs
        $userIds = User::pluck('id')->toArray();

        foreach ($userIds as $userId) {
            // Create Attendance record
            $attendance = Attendance::create([
                'user_id' => $userId,
                'clock_in' => Carbon::now()->subHours(8),
                'clock_out' => Carbon::now(),
            ]);

            // Create Work record based on Attendance
            $work = Work::create([
                'user_id' => $attendance->user_id,
                'date' => $attendance->clock_in->format('Y-m-d'),
                'start' => $attendance->clock_in->format('H:i:s'),
                'end' => $attendance->clock_out->format('H:i:s'),
            ]);

            // Mock break start and end time
            $breakStartTime = Carbon::parse($attendance->clock_in)->addHours(1);
            $breakEndTime = Carbon::parse($breakStartTime)->addMinutes(30);

            // Create Rest record based on Work
            Rest::create([
                'work_id' => $work->id,
                'start' => $breakStartTime->format('H:i:s'),
                'end' => $breakEndTime->format('H:i:s'),
            ]);
        }
    }
}