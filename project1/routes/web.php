<?php

use App\Http\Controllers\AcademicianController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/academicians',\App\Http\Controllers\AcademicianController::class);
Route::resource('/grantprojects',\App\Http\Controllers\GrantProjectController::class);
Route::resource('/milestones',\App\Http\Controllers\MilestoneController::class);
//Route::resource('/staffs',\App\Http\Controllers\StaffController::class);
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
