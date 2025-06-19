<?php

namespace App\Http\Controllers;

use App\Models\ProjectTeam;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // Show all teams (you can customize this view)
  public function index()
{
    $teams = ProjectTeam::with('project', 'teamLead')->get(); 
    return view('team.index', compact('teams')); 
}


    // Show form to create a new team
    public function createTeamForm()
    {
        $allProjects = Project::all();
        return view('viewProject', compact('allProjects'));
    }

    // Store a new team
    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required',
            'project_id' => 'required|exists:projects,id',
            'description' => 'nullable',
        ]);

        ProjectTeam::create([
            'name' => $request->team_name,
            'project_id' => $request->project_id,
            'description' => $request->description,
            'team_lead_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Team created successfully!');
    }

    // Edit an existing team
    public function edit(ProjectTeam $team)
    {
        $allProjects = Project::all();
        $projectMembers = User::all();

        return view('team.edit', compact('team', 'allProjects', 'projectMembers'));
    }

    // Update an existing team
    public function update(Request $request, ProjectTeam $team)
    {
        $request->validate([
            'team_name' => 'required',
            'project_id' => 'required|exists:projects,id',
            'description' => 'nullable',
        ]);

        $team->update([
            'name' => $request->team_name,
            'project_id' => $request->project_id,
            'description' => $request->description,
        ]);

        return redirect()->route('teams.index')->with('success', 'Team updated successfully!');
    }

    // Delete a team
    public function destroy(ProjectTeam $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }
}
