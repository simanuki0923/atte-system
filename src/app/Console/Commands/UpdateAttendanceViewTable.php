<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateAttendanceViewTable extends Command
{
    protected $signature = 'attendance:update';
    protected $description = 'Update the attendance_view_table with aggregated data from attendances, rests, and works';

    public function handle()
    {
        DB::transaction(function () {
        
            DB::table('attendance_view_table')->truncate();

           // データを集約して挿入
            DB::table('attendance_view_table')->insert(
                DB::table('attendances')
                    ->select([
                        'attendances.user_id',
                        'users.name',
                        'works.date',
                        DB::raw('attendances.start_time AS start'),
                        DB::raw('attendances.end_time AS end'),
                        DB::raw('COALESCE(SUM(rests.duration), 0) AS total_rest'),
                        DB::raw('COALESCE(works.total_work_time, 0) AS total_work'),
                        DB::raw('NOW() AS created_at'),
                        DB::raw('NOW() AS updated_at')
                    ])
                    ->leftJoin('rests', function ($join) {
                        $join->on('attendances.user_id', '=', 'rests.user_id')
                            ->on('attendances.attendance_date', '=', 'rests.date');
                    })
                    ->leftJoin('works', function ($join) {
                        $join->on('attendances.user_id', '=', 'works.user_id')
                            ->on('attendances.attendance_date', '=', 'works.date');
                    })
                    ->join('users', 'attendances.user_id', '=', 'users.id')
                    ->groupBy('attendances.user_id', 'users.name', 'attendances.attendance_date', 'attendances.start_time', 'attendances.end_time', 'works.total_work_time')
                    ->get()->toArray()
            );

            $this->info('Attendance view table updated successfully!');
        });
    }
}