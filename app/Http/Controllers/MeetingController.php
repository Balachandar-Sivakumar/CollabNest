<?php


namespace App\Http\Controllers;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        // Generate a unique meeting ID or get from request
        $meetingId = $request->get('meeting') ?? Str::random(10);

        // Create the Jitsi meeting link
        $inviteLink = url('/meetings?meeting=' . $meetingId);

        return view('meetings', compact('meetingId', 'inviteLink'));
    }
}