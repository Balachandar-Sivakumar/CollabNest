<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentication;

Route::get('/',[authentication::class,'welcome']); //home page

Route::get('/register',[authentication::class,'register']); //navigate to register page

Route::post('/login',[authentication::class,'loginUser']); //user login

Route::get('/navlogin',[authentication::class,'navLogin']); //navigate to login page

Route::post('/step_one',[authentication::class,'step_one_register']);//persnol details

Route::post('/step_two',[authentication::class,'step_two_register']);//registeration

Route::get('/dashboard',[authentication::class,'dashboard']); //navigate to dashboard page

Route::post('/logout',[authentication::class,'logout']); // logout method



