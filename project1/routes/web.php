<?php

use App\Http\Controllers\AcademicianController;
use App\Http\Controllers\GrantProjectController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProjectMemberController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/academicians',\App\Http\Controllers\AcademicianController::class);
Route::resource('/grant-projects', GrantProjectController::class);
Route::resource('/milestones', MilestoneController::class);
Route::resource('/project-members', ProjectMemberController::class);
//Route::resource('/staffs',\App\Http\Controllers\StaffController::class);
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/join-project', [ProjectMemberController::class, 'joinForm'])->name('join.project');
Route::post('/join-project', [ProjectMemberController::class, 'joinProject'])->name('join.project.store');

//Auth::routes();