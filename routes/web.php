<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Authentication,
    TeamController,
    ProjectController,
    TaskController,
    MessageController,
    MeetingController,
    SettingsController,
    WelcomepageController,
    UsersController,
    SkillsController,
    ProjectRequestController,
    TaskCommentController
};

// ======================
//  AUTHENTICATION ROUTES
// ======================
Route::controller(Authentication::class)->group(function () {
    Route::get('/', 'welcome');
    Route::get('/navregister', 'navregister');
    Route::get('/navlogin', 'navLogin');
    Route::post('/login', 'loginUser')->name('login');
    Route::post('/register', 'register');
    Route::post('/step_two', 'step_two_register');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout');
    Route::get('/verify', 'verify');
});

// ======================
//  WELCOME PAGE ROUTES
// ======================
Route::controller(WelcomepageController::class)->group(function () {
    Route::get('/Home', 'home')->name('home');
    Route::get('/explore-projects', 'exploreProjects')->name('explore-projects');
    Route::get('/find-talent', 'findTalent')->name('find-talent');
    Route::get('/help', 'help')->name('help');
    Route::get('/how-it-works', 'howItWorks')->name('how-it-works');
});

// ======================
//  SETTINGS ROUTES
// ======================
Route::controller(SettingsController::class)->group(function () {
    Route::get('/settings/changePassword', 'index')->name('changepass');
    Route::get('/settings/help', 'help')->name('help');
});

// ======================
//  TEAM ROUTES
// ======================
Route::prefix('teams')->controller(TeamController::class)->group(function () {
    Route::get('/', 'index')->name('teams.index');
    Route::get('/create', 'createTeamForm')->name('teams.create');
    Route::post('/', 'store')->name('teams.store');
    Route::get('/{team}/edit', 'edit')->name('teams.edit');
    Route::put('/{team}', 'update')->name('teams.update');
    Route::delete('/{team}', 'destroy')->name('teams.destroy');
});

// ======================
//  MESSAGE & MEETING ROUTES
// ======================
Route::get('/messages', [MessageController::class, 'index'])->name('messages');
Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings');

// ======================
//  SKILLS ROUTES
// ======================
Route::controller(SkillsController::class)->group(function () {
    Route::get('/profession/search', 'getProfession');
    Route::get('/skills/search', 'getSkills');
    Route::get('/interests/search', 'getInterests');
    Route::get('/softSkill/search', 'getSoftskills');
});

// ======================
//  USER PROFILE ROUTES
// ======================
Route::controller(UsersController::class)->group(function () {
    Route::get('/profile/{id}', 'profile');
    Route::get('/navUsers', 'navUsers')->name('navUsers');
    Route::get('/navProfile/edit', 'navedit');
    Route::post('/profile/update', 'profileUpdate');
    Route::post('/resetPassword', 'resetPassword');
});

// ======================
//  PROJECT ROUTES
// ======================
Route::controller(ProjectController::class)->group(function () {
    Route::get('/projects', 'index')->name('projects');
    Route::get('/navcreateproject', 'navcreateproject')->name('navCreateProject');
    Route::post('/CreateProject', 'CreateProject');
    Route::get('/view/{project}', 'viewProject')->name('viewProject');
    Route::post('/deleteProject', 'deleteProject')->name('deleteProject');
    Route::get('/navMyProject', 'navMyProject')->name('navMyProject');
    Route::get('/navUpdateProject/{id}', 'navUpdateProject')->name('editProject');
    Route::post('/UpdateProject/{id}', 'UpdateProject');
    Route::get('/projectInvites', 'projectInvites')->name('projectInvites');
});

// ======================
//  PROJECT REQUEST ROUTES
// ======================
Route::controller(ProjectRequestController::class)->group(function () {
    Route::get('/project/request/{requesterId}/accept', 'acceptRequest');
    Route::get('/project/request/{requester}/reject', 'rejectRequest')->name('project.reject');
    Route::post('/request/{project}', 'sendRequest')->name('request');
    Route::post('/projects/{project}/invite', 'sendInvite')->name('sendInvite');
});

// ======================
//  TASK ROUTES (Protected by auth)
// ======================
Route::middleware(['auth'])->group(function () {
    // Task Resource Routes
    Route::resource('tasks', TaskController::class)->except(['show']);
    
    // Custom show route to include authorization
    Route::get('tasks/{task}', [TaskController::class, 'show'])
        ->name('tasks.show')
        ->middleware('can:view,task');
    
    // Additional Task Routes
    Route::post('tasks/{task}/change-status', [TaskController::class, 'changeStatus'])
        ->name('tasks.change-status');
    Route::post('tasks/{task}/assign-team', [TaskController::class, 'assignTeam'])
        ->name('tasks.assign-team');
    
    // Comment Routes
    Route::post('comments', [TaskCommentController::class, 'store'])
        ->name('comments.store');
    Route::delete('comments/{comment}', [TaskCommentController::class, 'destroy'])
        ->name('comments.destroy');
});