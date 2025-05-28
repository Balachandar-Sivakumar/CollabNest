<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\user_profile;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function NavUsers(){
        $users = User::get();
        $skills = user_profile::all();
        return view('user_profile',compact('skills','users'));
    }
 
}
