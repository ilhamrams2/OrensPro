<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrganisationController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AttendanceSessionController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\MemberAttendanceController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Management Routes
    Route::resource('organisations', OrganisationController::class)->names('organisations');
    Route::resource('divisions', DivisionController::class)->names('divisions');
    Route::resource('users', UserController::class)->names('users');

    Route::resource('attendance-sessions', AttendanceSessionController::class)->names('attendance-sessions');
    Route::get('attendance-sessions/{session}/marking', [AttendanceController::class, 'showMarkingSheet'])->name('attendance.marking');
    Route::post('attendance-sessions/{session}/mark', [AttendanceController::class, 'mark'])->name('attendance.mark');

    // Member Attendance
    Route::get('presence', [MemberAttendanceController::class, 'index'])->name('member.attendance.index');
    Route::post('presence', [MemberAttendanceController::class, 'store'])->name('member.attendance.store');
});