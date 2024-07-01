<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AttendanceController;

// Routes that require authentication

Route::middleware('auth')->group(function () {
    
Route::get('/', [AttendanceController::class, 'punch'])->name('home');
    
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

// Attendance operations
    Route::post('/work', [AttendanceController::class, 'work'])->name('work.update');
    

Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    
    
Route::get('/attendance/date', [AttendanceController::class, 'indexDate'])->name('attendance.date');
    
   
Route::get('/attendance/{date}', [AttendanceController::class, 'perDate'])->name('attendance.perDate');

// Work and rest operations
    
Route::post('/start-work', [AttendanceController::class, 'startWork'])->name('start.work');
    Route::post('/end-work', [AttendanceController::class, 'endWork'])->name('end.work');
    
 
Route::post('/start-rest', [AttendanceController::class, 'startRest'])->name('start.rest');
    

Route::post('/end-rest', [AttendanceController::class, 'endRest'])->name('end.rest');

// User operations
    
Route::get('/user', [AttendanceController::class, 'indexUser'])->name('user.index');
    
    
Route::post('/user/search', [AttendanceController::class, 'searchUser'])->name('user.search');
    
   
Route::get('/create-folder', [AttendanceController::class, 'createFolderForm'])->name('create.folder.form');
});

// Public routes for login and registration
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');