<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WelcomepageController;
use App\Http\Controllers\UsersController;

// Home page
Route::get('/', [Authentication::class, 'welcome']);

// Register page navigation
Route::get('/register', [Authentication::class, 'register']);

// User login
Route::post('/login', [Authentication::class, 'loginUser']);

// Login page navigation
Route::get('/navlogin', [Authentication::class, 'navLogin']);

// Registration step 1 (personal details)
Route::post('/step_one', [Authentication::class, 'step_one_register']);

// Registration step 2
Route::post('/step_two', [Authentication::class, 'step_two_register']);

// Dashboard page (protected or after login)
Route::get('/dashboard', [Authentication::class, 'dashboard'])->name('dashboard');

// Logout
Route::post('/logout', [Authentication::class, 'logout']);

// Team page
Route::get('/team', [TeamController::class, 'index'])->name('team');

// Projects page
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

// Tasks page
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');

// Messages page
Route::get('/messages', [MessageController::class, 'index'])->name('messages');

// Meetings page
Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings');

// Files page
Route::get('/files', [FileController::class, 'index'])->name('files');

// Settings page
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// Fallback route - show custom 404 error page
// Route::fallback(function () {
//     return response()->view('404', [], 404);
// });


Route::get('/how-it-works', [WelcomePageController::class, 'howItWorks'])->name('how-it-works');

Route::get('/Home', [WelcomepageController::class, 'home'])->name('home');

Route::get('/explore-projects', [WelcomepageController::class, 'exploreProjects'])->name('explore-projects');

Route::get('/find-talent', [WelcomepageController::class, 'findTalent'])->name('find-talent');

Route::get('/help', [WelcomepageController::class, 'help'])->name('help');

Route::get('/users',[UsersController::class, 'NavUsers']);
