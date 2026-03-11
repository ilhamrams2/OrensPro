<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrganisationController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\UserController;
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
});