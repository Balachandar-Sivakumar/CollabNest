<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\Profession;
use App\Models\SoftSkill;
use App\Models\Interest;
use App\Models\Skill;
use App\Models\UserTag;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function profile($id)
    {
        $skills = UserProfile::where('user_id', $id)->first();

        return view('user_profile', compact('skills', 'id'));
    }

    public function navedit()
    {

        $skills = UserProfile::where('user_id', Auth::user()->id)->first();
        return view('profile_update', compact('skills'));
    }

    public function profileUpdate(Request $request)
    {

        $request->validate([
            'technical_skills'      => 'required',
            'soft_skills'           => 'required',
            'skill_level'           => 'required|string',
            'profession'            => 'required|string',
            'interests'             => 'required|string',
            'availability'          => 'required|string',
            'years_of_experience'   => 'nullable|integer|min:0',
            'bio'                   => 'nullable',
            'linkedin'              => 'nullable',
            'github'                => 'nullable',
            'leetcode'              => 'nullable',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = UserProfile::where('user_id', Auth::user()->id)->first();


        UserTag::where('user_id', Auth::user()->id)->where('tag_model', 'profession')->delete();
        UserTag::where('user_id', Auth::user()->id)->where('tag_model', 'interest')->delete();
        UserTag::where('user_id', Auth::user()->id)->where('tag_model', 'tech_skill')->delete();
        UserTag::where('user_id', Auth::user()->id)->where('tag_model', 'soft_skill')->delete();

        foreach (json_decode(json_encode(array_filter(array_map('trim', explode(',', $request->technical_skills))))) as $skill) {
            UserTag::create([
                'tag_id' => Skill::where('skill', $skill)->value('id'),
                'user_id' => Auth::user()->id,
                'tag_model' => 'tech_skill'
            ]);
        }


        foreach (json_decode(json_encode(array_filter(array_map('trim', explode(',', $request->soft_skills))))) as $st_skill) {

            UserTag::create([

                'tag_id' => SoftSkill::where('soft_skills', $st_skill)->value('id'),
                'user_id' => Auth::user()->id,
                'tag_model' => 'soft_skill'
            ]);
        }

        foreach (json_decode(json_encode(array_filter(array_map('trim', explode(',', $request->profession))))) as $profession) {
            UserTag::create([
                'tag_id' => Profession::where('profession', $profession)->value('id'),
                'user_id' => Auth::user()->id,
                'tag_model' => 'profession'
            ]);
        }

        foreach (json_decode(json_encode(array_filter(array_map('trim', explode(',', $request->interests))))) as $interest) {
            UserTag::create([
                'tag_id' => Interest::where('interest', $interest)->value('id'),
                'user_id' => Auth::user()->id,
                'tag_model' => 'interest'
            ]);
        }


        $data = json_decode($data->profile_settings);

        $data->skill_level          = trim($request->skill_level);
        $data->availability         = trim($request->availability);
        $data->years_of_experience  = $request->years_of_experience ?? null;
        $data->bio                  = trim($request->bio ??  $data->bio ?? null);
        $data->linkedin             = trim($request->linkedin ?? $data->linkedin ?? null);
        $data->github               = trim($request->github ?? $data->github ?? null);
        $data->leetcode             = trim($request->leetcode ?? $data->leetcode ?? null);
        $data->address              = json_encode(['address_1' => $request->address_line_1, 'address_2' => $request->address_line_2, 'zip_code' => $request->postcode, 'state' => $request->state, 'region' => $request->region]) ?? $data->address ?? null;
        $data->mobile               = $request->mobile ?? $data->mobile ?? null;
        $data->dob                  = $request->dob ?? $data->dob ?? null;
        $data->first_name            = $request->first_name ?? $data->first_name ?? null;
        $data->last_name             = $request->last_name ?? $data->last_name ?? null;


        if ($request->hasFile('profile_image')) {

            if (isset($data->image) && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $path = $request->file('profile_image')->store('assets', 'public');
            $data->image = $path;
        }

        if ($request->hasFile('resume')) {

            if (isset($data->resume) && Storage::disk('public')->exists($data->resume)) {
                Storage::disk('public')->delete($data->resume);
            }

            $resume_path = $request->file('resume')->store('files', 'public');
            $data->resume = $resume_path;
        }

        UserProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            ['profile_settings' => json_encode($data)]
        );


        return redirect("/profile/" . Auth::user()->id)->with('success', 'Profile updated successfully.');
    }


    public function navUsers()
    {
        $users = User::all();
        return view('publicUsers', compact('users'));
    }


    public function sendOtp(Request $request)
    {
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return response()->json(['error' => 'Incorrect current password']);
        }
        $otp = rand(100000, 999999);
        $email = Auth::user()->email;

        DB::table('password_resets_otp')->updateOrInsert(
            ['email' => $email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10),
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // Example - using Laravel Mail
        Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($email) {
            $message->to($email)
                ->subject('Password Reset OTP');
        });

        session(['password' => $request->new_password]);

        return response()->json(['success' => 'OTP sent successfully']);
    }

    public function ressetPassword(Request $request)
    {
        $otp = (int)implode($request->otp);

        $record = DB::table('password_resets_otp')
            ->where('email', Auth::user()->email)
            ->where('otp', $otp)
            ->first();

        if (!$record || Carbon::now()->gt(Carbon::parse($record->expires_at))) {
            return redirect()->back()->with(['error' => 'Invalid or expired OTP'], 422);
        }

        $user = User::where('email', Auth::user()->email)->first();
        $user->password = bcrypt(session('password'));
        $user->save();

        // Remove OTP after successful reset
        DB::table('password_resets_otp')->where('email', Auth::user()->email)->delete();

        return redirect()->back()->with(['success'=>'Password reset success']);
    }
}
