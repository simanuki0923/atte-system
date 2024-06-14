<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Work;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    // Display the main attendance view

    public function index()
    {
        
   
      $displayDate = Carbon::now();
      $works = Work::whereDate('date', $displayDate)
            ->with('user', 'rests')
            ->paginate(10);
            return view('attendance', compact('works', 'displayDate'));
    }

    
   
// Display attendance records for a specific date
    
    public function indexDate(Request $request)
    {
        $displayDate = Carbon::now();
        $works = Work::whereDate('date', $displayDate)->paginate(5);
        return view('attendance', compact('works', 'displayDate'));
    }

    
    

 
// Handle starting work, ending work, starting rest, and ending rest
    
     public function work(Request $request)
    {     
        $now_date = Carbon::now()->format('Y-m-d');
        $now_time = Carbon::now()->format('H:i:s');
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if (!$user) {
            return redirect('/')->with('error', 'User not found');
        }

        if ($request->has('start_work')) {
            Work::create([
                'date' => $now_date,
                'start' => $now_time,
                'user_id' => $user_id,
            ]);
            $user->status = 1; // Work started
        }

        if ($request->has('end_work')) {
            $attendance = Work::where('user_id', $user_id)
                ->where('date', $now_date)
                ->first();
        if ($attendance) {
            $attendance->end = $now_time;
            $attendance->save();
            $user->status = 3; // Work ended
            }
        }

        if ($request->has('start_rest')) {
            $work = Work::where('user_id', $user_id)
                ->where('date', $now_date)
                ->first();
        if ($work) {
            Rest::create([
                'start' => $now_time,
                'work_id' => $work->id, // Make sure 'work_id' is assigned correctly
                ]);
                $user->status = 2; // Break started
            }
        }

        if ($request->has('end_rest')) {
            $work = Work::where('user_id', $user_id)
                ->where('date', $now_date)
                ->first();
        if ($work) {
            $rest = Rest::where('work_id', $work->id)
                    ->whereNotNull('start')
                    ->whereNull('end')
                    ->first();
                
        if ($rest) {
                $rest->end = $now_time;
                $rest->save();
                $user->status = 1; // Break ended, back to work
                }
            }
        }
        $user->save();
        return redirect('/')->with('status', $user->status);
    }
     
    // Display punch status
    
    public function punch()
    {
        $now_date = Carbon::now()->format('Y-m-d');
        $user_id = Auth::user()->id;
        $work = Work::where('user_id', $user_id)
            ->where('date', $now_date)
            ->first();
        $status = $work ? Auth::user()->status : 0;
        return view('index', compact('status'));
    }

    // Display attendance records for a specific date and handle date navigation
    
  
    public function perDate(Request $request, $date)
    {
        $displayDate = Carbon::parse($date);

    if ($request->has('prevDate')) {
        $displayDate->subDay();
        }

    if ($request->has('nextDate')) {
        $displayDate->addDay();
        }

        $works = Work::whereDate('date', $displayDate)
            ->with('user', 'rests')
            ->paginate(5);
         return view('attendance', compact('works', 'displayDate'));
    }

}