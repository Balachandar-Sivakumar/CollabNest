<?php

namespace App\Http\Controllers;

use App\Models\ProjectTeam;
use App\Models\Project;
use Illuminate\Http\Request;


class TeamController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required',
            'project_id' => 'required',
            'description' => 'nullable',
        ]);

        ProjectTeam::create([
            'name' => $request->team_name,
            'project_id' => $request->project_id,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Team created successfully!');
    }

    public function createTeamForm()
    {
        $allProjects = Project::all(); 
       
        return view('viewProject', compact('allProjects'));

    }

}