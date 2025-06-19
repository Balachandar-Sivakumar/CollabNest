<?php

namespace App\Http\Controllers;

use App\Models\ProjectRequest;
use App\Models\ProjectTeam;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ProjectRequestMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectInviteMail;
use App\Models\ProjectInvite;
use App\Models\ProjectTeamMember;

class ProjectRequestController extends Controller
{
    public function sendRequest(Request $request, $id)
    {

        $project = Project::findOrFail($id);
        

        if ($project->owner_id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot request your own project.');
        }



        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            // 'target_id' => 'required|exists:users,id',
        ]);



        ProjectRequest::create([
            'title' => $request->title,
            'body' => $request->body,
            'project_id' => $project->id,
            'request_type' => 'user_request',
            'user_id' => Auth::id(),
            'target_id' => $project->owner_id,
            'status' => 'pending',
        ]);
        // dd($request);


        $owner = User::find($project->owner_id);
        $requester = Auth::user();

        Mail::to($owner->email)->send(new ProjectRequestMail($requester, $project));

        return redirect()->back()->with('success', 'Request sent successfully!');
    }


    public function acceptRequest($requesterId)
    {
        $projectRequest = ProjectRequest::where('user_id', $requesterId)->firstOrFail();
        $project = Project::findOrFail($projectRequest->project_id);

        if ($project->owner_id == $requesterId) {
            return redirect()->back()->with('error', 'You cannot accept your own request.');
        }

        // ✅ Check if team exists
        $team = ProjectTeam::where('project_id', $project->id)->first();

        if (!$team) {
            $team = ProjectTeam::create([
                'name' => $project->title . ' - Team',
                'description' => 'Default team for project: ' . $project->title,
                'project_id' => $project->id,
                'team_lead_id' => $project->owner_id,
            ]);
        }

        // ✅ Add user to team
        ProjectTeamMember::create([
            'user_id' => $requesterId,
            'project_id' => $project->id,
            'team_id' => $team->id,
        ]);

        $projectRequest->update(['status' => 'accepted']);

        $teamMembers = ProjectTeamMember::with('user')
            ->where('project_id', $project->id)
            ->get();

     
        $teams = ProjectTeam::with(['project', 'members.user'])->get();
        $allProjects = Project::all();
        $projectMembers = User::all();

        return view('viewProject', [
            'project' => $project,
            'owner' => $project->owner,
            'requester' => $projectRequest->user,
            'teamMembers' => $teamMembers,
            'teams' => $teams,
            'allProjects' => $allProjects,
            'projectMembers' => $projectMembers,
        ])->with('success', 'Request accepted and member added to the team!');
    }


    public function rejectRequest(Request $request, $projectId)
    {
        $userId = $request->query('user');

        $project = Project::findOrFail($projectId);

        if (Auth::id() !== $project->owner_id) {
            abort(403, 'Unauthorized action.');
        }

        $projectRequest = ProjectRequest::where('project_id', $projectId)
            ->where('user_id', $userId)
            ->first();

        if ($projectRequest) {
            $projectRequest->update(['status' => 'rejected']);
        }

        return redirect()->route('dashboard')->with('info', 'You rejected the request for project: ' . $project->title);
    }

    public function sendInvite(Request $request, $id)
    {
        $request->validate([
            'emails' => 'required|string'
        ]);

        $project = Project::findOrFail($id);
        $requester = Auth::user(); // ✅ This is the logged-in user

        $email_ids = explode(',', $request->emails);
        $validatedEmails = [];

        foreach ($email_ids as $email) {
            $email = trim($email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return redirect()->back()->with('error', 'Invalid email address: ' . $email);
            }
            $validatedEmails[] = $email;
        }

        foreach ($validatedEmails as $email) {
            $existingInvite = ProjectInvite::where('project_id', $project->id)
                ->where('email', $email)
                ->first();

            if (!$existingInvite) {
                ProjectInvite::create([
                    'owner_id' => Auth::id(),
                    'project_id' => $project->id,
                    'email' => $email,
                    'status' => 'pending'
                ]);

                Mail::to($email)->send(new ProjectInviteMail($project, $requester));
            }
        }

        return redirect()->back()->with('success', 'Invitation email sent!');
    }

   public function acceptInvite($id)
    {
        $invite = ProjectInvite::findOrFail($id);
        $invite->status = 'accepted';
        $invite->save();

        $user = User::where('email', $invite->email)->first();

        if (!$user) {
            return back()->with('error', 'User not found. Please make sure they have registered.');
        }

        // ✅ Add user to a team
        $team = ProjectTeam::where('project_id', $invite->project_id)->first();

        if (!$team) {
            $team = ProjectTeam::create([
                'name' => 'Default Team',
                'description' => 'Auto-generated team',
                'project_id' => $invite->project_id,
                'team_lead_id' => $invite->owner_id,
            ]);
        }

        $alreadyExists = ProjectTeamMember::where('user_id', $user->id)
                            ->where('team_id', $team->id)
                            ->exists();

        if (!$alreadyExists) {
            ProjectTeamMember::create([
                'user_id' => $user->id,
                'project_id' => $invite->project_id,
                'team_id' => $team->id,
            ]);
        }

        // ✅ Create ProjectRequest with status = accepted (record keeping)
        ProjectRequest::updateOrCreate([
            'user_id' => $user->id,
            'project_id' => $invite->project_id,
        ], [
            'status' => 'accepted',
            'request_type' => 'user_request',
            'target_id' => $invite->project_id,
        ]);

        return back()->with('success', 'Invite accepted and user added to the team!');
    }


    public function show($projectId)
    {
        $project = Project::with(['requests.user'])->findOrFail($projectId);

        $projectRequests = $project->requests()->where('status', 'pending')->get();

        return view('viewProject', compact('project', 'projectRequests'));
    }

}
