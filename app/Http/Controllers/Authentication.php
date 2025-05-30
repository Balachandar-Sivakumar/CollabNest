<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class Authentication extends Controller
{
  public function welcome()
    {

        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('welcome');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('register_step1');
    }

    public function navLogin()
    {
      
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function step_one_register(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        session([
            'step_1' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]
        ]);

        return view('register_step2');
    }

    public function step_two_register(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        $request->validate([
            'profession'   => 'required|array|min:1',
            'skills'       => 'required|array|min:1',
            'interests'    => 'required|array|min:1',
            'availability' => 'required|string'
        ]);

        $step1 = session('step_1');

        if (!$step1 || !isset($step1['name'], $step1['email'], $step1['password'])) {
            return redirect('/register')->withErrors(['message' => 'Session expired. Please register again.']);
        }

        $verificationToken = Str::random(64);
        $hash = hash('sha256', $step1['email']);

        // Store all info in session
        session([
            'pending_registration' => [
                'name' => $step1['name'],
                'email' => $step1['email'],
                'password' => $step1['password'],
                'profile' => [
                    'profession'   => $request->profession,
                    'skills'       => $request->skills,
                    'interests'    => $request->interests,
                    'availability' => $request->availability,
                ],
                'token' => $verificationToken
            ]
        ]);

        // Send email
        Mail::to($step1['email'])->send(new WelcomeMail($step1['email'], $verificationToken, $hash));

        session()->forget('step_1');

        return redirect('/email-sent');
    }   



    public function loginUser(Request $request)
    {
        
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
     
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
         } 
        else {

            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
       
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (is_null(!Auth::user()->verified_at)) {
            return redirect('/not-verified');
        }

        return view('dashboard');
    }

}
