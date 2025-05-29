<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailSend;

class MailSendController extends Controller
{
    public function verify(Request $request)
    {
        $emailHash = $request->query('email_hash');
        $token = $request->query('token');

        $user = MailSend::where('verification_token', $token)->first();

        if (!$user) {
            return view('verification-failed', ['message' => 'Invalid token!']);
        }

        if (hash('sha256', $user->email) !== $emailHash) {
            return view('verification-failed', ['message' => 'Email hash mismatch!']);
        }

        $user->update([
            'verified_at' => now(),
            'verification_token' => null
        ]);

        return view('verification-success');
    }
}


