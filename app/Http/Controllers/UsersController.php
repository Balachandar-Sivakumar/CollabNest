<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Skills;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function NavUsers(){
        $users = User::get();
        return view('user_profile',compact('users'));
    }

   
}
