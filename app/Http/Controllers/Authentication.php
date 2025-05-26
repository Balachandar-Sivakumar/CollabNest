<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skills;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Authentication extends Controller
{
  public function welcome()
    {

        if (Auth::check()) {
            return redirect('/dashboard');
        }
        $users = User::all();

        return view('welcome', compact('users'));
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
                'password' => Hash::make($request->password),
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
            'skills' => 'required|array|min:1',
            'interests' => 'required|array|min:1',
            'availability' => 'required|string',
        ]);

        $step1 = session('step_1');

        if (!$step1) {
            return redirect('/register')->withErrors('Session expired. Please restart registration.');
        }

        $user = User::create([
            'name' => $step1['name'],
            'email' => $step1['email'],
            'password' => $step1['password'],
        ]);

        Skills::create([
            'user_id' => $user->id,
            'skills' => json_encode($request->skills),
            'interests' => json_encode($request->interests),
            'availability' => $request->availability,
        ]);

        session()->forget('step_1');

        Auth::login($user);

        return redirect('/dashboard');
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
        } else {
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
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect('/login');
    }
}
