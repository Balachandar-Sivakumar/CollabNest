<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomepageController extends Controller
{
    public function home()
    {
        return view('welcome');  // resources/views/welcome.blade.php
    }

    public function howItWorks()
    {
        return view('how-it-works');  // resources/views/how-it-works.blade.php
    }

    public function exploreProjects()
    {
        return view('explore-projects');  // create this view file
    }

    public function findTalent()
    {
        return view('find-talent');  // create this view file
    }

    public function help()
    {
        return view('help');  // create this view file
    }
}
