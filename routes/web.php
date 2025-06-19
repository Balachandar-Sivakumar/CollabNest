<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WelcomepageController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\ProjectRequestController;

// Authentication & Welcome
Route::controller(Authentication::class)->group(function () {
    Route::get('/', 'welcome');
    Route::get('/navregister', 'navregister');
    Route::get('/navlogin', 'navLogin');
    Route::post('/login', 'loginUser');
    Route::post('/register', 'register');
    Route::post('/step_two', 'step_two_register');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout');
    Route::get('/verify', 'verify');
});

// Welcome Pages
Route::controller(WelcomepageController::class)->group(function () {
    Route::get('/Home', 'home')->name('home');
    Route::get('/explore-projects', 'exploreProjects')->name('explore-projects');
    Route::get('/find-talent', 'findTalent')->name('find-talent');
    Route::get('/help', 'help')->name('help');
    Route::get('/how-it-works', 'howItWorks')->name('how-it-works');
});

// User login
Route::post('/login', [Authentication::class, 'loginUser'])->name('login');

Route::get('/login', [Authentication::class, 'loginUser'])->name('login');
// Settings
Route::controller(SettingsController::class)->group(function () {
    Route::get('/settings/changePassword','index')->name('changepass');
    Route::get('/settings/help','help')->name('help');
});

// Team
Route::get('/team', [TeamController::class, 'index'])->name('team');

// Messages
Route::get('/messages', [MessageController::class, 'index'])->name('messages');

// Meetings
Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings');

// Skills
Route::controller(SkillsController::class)->group(function () {
    Route::get('/profession/search', 'getProfession');
    Route::get('/skills/search', 'getSkills');
    Route::get('/interests/search', 'getInterests');
    Route::get('/softSkill/search', 'getSoftskills');
});

// Users
Route::controller(UsersController::class)->group(function () {
    Route::get('/profile/{id}', 'profile');
    Route::get('/navUsers', 'navUsers')->name('navUsers');
    Route::get('/navProfile/edit', 'navedit');
    Route::post('/profile/update', 'profileUpdate');
    Route::post('/resetPassword','resetPassword');
});

// Project Routes
Route::controller(ProjectController::class)->group(function () {
    Route::get('/projects', 'index')->name('projects');
    Route::get('/navcreateproject', 'navcreateproject')->name('navCreateProject');
    Route::post('/CreateProject', 'CreateProject');
    Route::get('/view/{project}', 'viewProject')->name('viewProject');
    Route::post('/deleteProject', 'deleteProject')->name('deleteProject');
    Route::get('/navMyProject', 'navMyProject')->name('navMyProject');
    Route::get('/navUpdateProject/{id}', 'navUpdateProject')->name('editProject');
    Route::post('/UpdateProject/{id}', 'UpdateProject');
    Route::get('/projectInvites','projectInvites')->name('projectInvites');
});

// Project Requests
Route::controller(ProjectRequestController::class)->group(function () {
    Route::get('/project/request/{requesterId}/accept', 'acceptRequest');
    Route::get('/project/request/{requester}/reject', 'rejectRequest')->name('project.reject');
    Route::post('/request/{project}', 'sendRequest')->name('request');
    Route::post('/projects/{project}/invite', 'sendInvite')->name('sendInvite');
});

// Task Routes (with middleware and permissions)
Route::middleware(['auth'])->group(function () {
    Route::controller(TaskController::class)->group(function () {
        Route::get('tasks', 'index')->name('tasks.index');
        Route::get('tasks/create', 'create')->name('tasks.create');
        Route::post('tasks', 'store')->name('tasks.store');
        Route::get('tasks/{task}', 'show')->name('tasks.show')->middleware('can:view,task');
        Route::get('tasks/{task}/edit', 'edit')->name('tasks.edit')->middleware('can:update,task');
        Route::put('tasks/{task}', 'update')->name('tasks.update');
        Route::patch('tasks/{task}', 'update');
        Route::delete('tasks/{task}', 'destroy')->name('tasks.destroy')->middleware('can:delete,task');
    });
});


    Route::middleware(['auth'])->group(function () {
    // List tasks
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    
    // Create task
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    
    // View single task
    Route::get('tasks/{task}', [TaskController::class, 'show'])
        ->name('tasks.show')
        ->middleware('can:view,task');
    
    // Edit task
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit')
        ->middleware('can:update,task');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::patch('tasks/{task}', [TaskController::class, 'update']);
    
    // Delete task
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy')
        ->middleware('can:delete,task');
});

// Make sure you have routes defined like this:
Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');

Route::get('/navUpdateProject/{id}',[ProjectController::class,'navUpdateProject'])->name('editProject');

Route::post('/UpdateProject/{id}',[ProjectController::class,'UpdateProject']);

Route::get('/project/request/{request}/accept', [ProjectRequestController::class, 'acceptRequest'])->name('project.request.accept');

Route::get('/project/request/{request}/reject', [ProjectRequestController::class, 'rejectRequest'])->name('project.reject');

Route::get('/project/invite/{id}', [ProjectRequestController::class, 'sendInvite'])->name('project.invite');

Route::post('/project/{id}/request-join', [ProjectRequestController::class, 'sendRequest'])->name('project.request.join');

Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
Route::put('/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.delete');

Route::middleware('auth')->group(function () {
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
});

Route::post('/project/invite/{id}', [ProjectRequestController::class, 'sendInvite'])->name('project.invite');
