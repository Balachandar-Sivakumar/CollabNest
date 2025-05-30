<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;


class MailSendController extends Controller
{
    public function verify(Request $request)
    {
        $emailHash = $request->query('email_hash');
        $token = $request->query('token');

        $pending = session('pending_registration');

        if (!$pending || $pending['token'] !== $token) {
            return view('verification-failed', ['message' => 'Invalid or expired token']);
        }

        if (hash('sha256', $pending['email']) !== $emailHash) {
            return view('verification-failed', ['message' => 'Email hash mismatch']);
        }

        // Now store the user
        $user = Users::create([
            'name'     => $pending['name'],
            'email'    => $pending['email'],
            'password' => bcrypt($pending['password']),
            'verified_at' => now(),
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'profile_settings' => json_encode($pending['profile']),
        ]);

        session()->forget('pending_registration');
        Auth::login($user);

        return redirect('/dashboard');
    }

}


