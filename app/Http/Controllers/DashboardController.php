<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $calendarEvents = [
            ['title' => 'Team Meeting', 'start' => now()->toDateString()],
            ['title' => 'Project Deadline', 'start' => now()->addDays(2)->toDateString()],
        ];
        return view('dashboard', compact('calendarEvents'));
    }
}