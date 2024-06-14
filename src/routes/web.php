<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 認証不要のルート
Route::get('/login',[AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('/login',[AuthenticatedSessionController::class, 'store']);

Route::get('/logout',[AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::post('/logout',[AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/register',[RegisteredUserController::class, 'create'])->name('register');
Route::post('/register',[RegisteredUserController::class, 'store'])->name('register.store');

// 認証が必要なルート
Route::middleware(['auth'])->group(function () {
    

Route::get('/', [AttendanceController::class,'punch'])->name('index'); // ホームページ
Route::post('/work', [AttendanceController::class,'work'])->name('work.update'); // 勤務操作用ルート
    
Route::get('/attendance',[AttendanceController::class, 'index'])->name('attendance');

Route::get('/attendance/date',[AttendanceController::class, 'indexDate'])->name('attendance.date');

Route::get('/attendance/{date}',[AttendanceController::class, 'perDate'])->name('attendance.perDate');
    
   
Route::get('/works', [AttendanceController::class,'worksIndex'])->name('works.index');

Route::get('/rests', [AttendanceController::class,'restsIndex'])->name('rests.index');
    

Route::post('/start-work', [AttendanceController::class, 'startWork'])->name('start.work');
    
   
Route::post('/end-work', [AttendanceController::class, 'endWork'])->name('end.work');
    
    
Route::post('/start-rest', [AttendanceController::class, 'startRest'])->name('start.rest');

Route::post('/end-rest', [AttendanceController::class, 'endRest'])->name('end.rest');
    
   
Route::get('/punch', [AttendanceController::class, 'punch'])->name('punch');
});

