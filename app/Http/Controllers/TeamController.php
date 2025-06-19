<?php

namespace App\Http\Controllers;

use App\Models\ProjectTeam;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProjectTeamMember;


class TeamController extends Controller
{
 
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'owner_id' => Auth::id(),
        ]);

        
        $team = ProjectTeam::create([
            'name' => $project->title . ' - Team',
            'description' => 'Default team for project: ' . $project->title,
            'project_id' => $project->id,
            'team_lead_id' => $project->owner_id,
        ]);

        // ✅ Add project owner as the first team member
        ProjectTeamMember::create([
            'user_id' => Auth::id(),
            'project_id' => $project->id,
            'team_id' => $team->id,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project and default team created successfully!');
    }

    public function create()
    {
        $allProjects = Project::all();
        $projectMembers = User::all();

        return view('team.create', compact('allProjects', 'projectMembers'));
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
    public function index()
    {
        $teams = ProjectTeam::with(['project', 'members.user'])->get();
        $allProjects = Project::all();
        $projectMembers = User::all();

        return view('team', compact('teams', 'allProjects', 'projectMembers'));
    }

}