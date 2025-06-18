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

        ProjectTeam::create([
            'name' => $projectRequest->title,
            'description' => $projectRequest->body,
            'project_id' => $project->id,
            'team_lead_id' => $project->owner_id,

        ]);

        ProjectTeamMember::create([
            'user_id' => $requesterId,
            'project_id' => $project->id,
            'team_id' => ProjectTeam::where('project_id', $project->id)->first()->id,

        ]);



        $projectRequest->update(['status' => 'accepted']);

        $teamMembers = ProjectTeamMember::with('user')
            ->where('project_id', $project->id)
            ->get();

        return view('viewProject', [
            'project' => $project,
            'owner' => $project->owner,
            'requester' => $projectRequest->user,
            'teamMembers' => $teamMembers, 
        ])->with('success', 'Request accepted and team updated!');
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
            // Check if the email already exists in the invites
            $existingInvite = ProjectInvite::where('project_id', $project->id)
                ->where('email', $email)
                ->first();

            if (!$existingInvite) {
                // Save invite to DB
                ProjectInvite::create([
                    'owner_id' => Auth::id(),
                    'project_id' => $project->id,
                    'email' => $email,
                    'status' => 'pending'
                ]);

                Mail::to($email)->send(new ProjectInviteMail($project));
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

        $existing = ProjectRequest::where('project_id', $invite->project_id)
            ->where('user_id', $user->id)
            ->where('status', 'accepted')
            ->first();

        if (!$existing) {

            ProjectRequest::create([
                'user_id' => $user->id,
                'project_id' => $invite->project_id,
                'status' => 'accepted',
                'request_type' => 'user_request',
                'target_id' => $invite->project_id,
            ]);
        }

        return back()->with('success', 'Invite accepted and user added to the team!');
    }

    public function show($projectId)
    {
        $project = Project::with(['requests.user'])->findOrFail($projectId);

        $projectRequests = $project->requests()->where('status', 'pending')->get();

        return view('viewProject', compact('project', 'projectRequests'));
    }



    // public function rejectInvite($id)
    // {
    //     $invite = ProjectInvite::findOrFail($id);
    //     $invite->status = 'rejected';
    //     $invite->save();

    //     return back()->with('info', 'Invite rejected.');
    // }
    // public function viewInvites()
    // {
    //     $invites = ProjectInvite::where('email', Auth::user()->email)
    //                      ->where('status', 'pending')
    //                      ->get();

    //     return view('invites', compact('invites'));
    // }
    // public function viewSentInvites()
    // {
    //     $sentInvites = ProjectInvite::where('owner_id', Auth::id())
    //                          ->where('status', 'pending')
    //                          ->get();

    //     return view('sent_invites', compact('sentInvites'));
    // }
    // public function viewProjectRequests()
    // {
    //     $requests = ProjectRequest::where('target_id', Auth::id())
    //                               ->where('status', 'pending')
    //                               ->get();

    //     return view('project_requests', compact('requests'));
    // }
    // public function viewSentProjectRequests()
    // {
    //     $sentRequests = ProjectRequest::where('user_id', Auth::id())
    //                                   ->where('status', 'pending')
    //                                   ->get();

    //     return view('sent_project_requests', compact('sentRequests'));
    // }
    // public function viewTeamMembers($projectId)
    // {
    //     $project = Project::findOrFail($projectId);
    //     $teamMembers = ProjectTeam::with('user')
    //                               ->where('project_id', $projectId)
    //                               ->get();

    //     return view('team_members', compact('project', 'teamMembers'));
    // }






}
