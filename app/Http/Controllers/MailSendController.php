<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class MailSendController extends Controller
{
   public function verify(Request $request)
{
    $emailHash = $request->query('email_hash');
    $token = $request->query('token');

    $user = User::where('verification_token', $token)->first();

    if (!$user || hash('sha256', $user->email) !== $emailHash) {
        return view('verification-failed', ['message' => 'Invalid or expired token']);
    }

    $user->update([
        'verified_at' => now(),
        'verification_token' => null,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
}

}


