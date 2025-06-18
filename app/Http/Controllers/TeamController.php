<?php

namespace App\Http\Controllers;

use App\Models\ProjectTeam;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


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
            'team_lead_id' => optional(Auth::user())->id, // Default to authenticated user if no team lead is specified
        ]);

        return redirect()->back()->with('success', 'Team created successfully!');
    }

    public function createTeamForm()
    {
        $allProjects = Project::all(); 
       
        return view('viewProject', compact('allProjects'));

    }
  
    public function edit(ProjectTeam $team)
    {
        $allProjects = Project::all();
        $projectMembers = User::all();

        return view('team.edit', compact('team', 'allProjects', 'projectMembers'));
    }

    public function update(Request $request, ProjectTeam $team)
    {
        $request->validate([
            'team_name' => 'required',
            'project_id' => 'required',
            'description' => 'nullable',
        ]);

        $team->update([
            'name' => $request->team_name,
            'project_id' => $request->project_id,
            'description' => $request->description,
        ]);

        return redirect()->route('teams')->with('success', 'Team updated successfully!');
    }

    public function destroy(ProjectTeam $team)
    {
        $team->delete();
        return redirect()->route('teams')->with('success', 'Team deleted successfully!');
    }
    

}