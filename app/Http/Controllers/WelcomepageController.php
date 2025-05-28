<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomepageController extends Controller
{
    public function home()
    {
        return view('welcome');  // resources/views/welcome.blade.php
    }

    public function howItWorks()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('how-it-works');  // resources/views/how-it-works.blade.php
    }

    public function exploreProjects()
    {
        return view('explore-projects');  
    }

    public function findTalent()
    {
        return view('find-talent');  
    }

    public function help()
    {
        return view('help'); 
    }
}
