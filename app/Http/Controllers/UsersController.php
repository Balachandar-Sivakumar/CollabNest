<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\View\ViewServiceProvider;
use App\Models\Profession;
use App\Models\SoftSkills;
use App\Models\Interest;
use App\Models\Skills;
use App\Models\UserTag;



class UsersController extends Controller
{
    public function NavUsers(){
        $skills = UserProfile::where('user_id',Auth::user()->id)->first();
      
        return view('user_profile',compact('skills'));
    }

    public function navedit(){
        $skills = UserProfile::where('user_id',Auth::user()->id)->first();
        return view('profile_update',compact('skills'));
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

        $data = UserProfile::where('user_id',Auth::user()->id)->first();

      
        UserTag::where('user_id',Auth::user()->id)->where('tag_model','profession')->delete();
        UserTag::where('user_id',Auth::user()->id)->where('tag_model','interest')->delete();
        UserTag::where('user_id',Auth::user()->id)->where('tag_model','tech_skill')->delete();
        UserTag::where('user_id',Auth::user()->id)->where('tag_model','soft_skill')->delete();

        foreach(json_decode(json_encode(array_filter(array_map('trim', explode(',', $request->technical_skills))))) as $skill){
            UserTag::create([
                'tag_id'=>Skills::where('skill',$skill)->value('id'),
                'user_id'=>Auth::user()->id,
                'tag_model'=>'tech_skill'
            ]);
            
        }

     
         foreach(json_decode(json_encode(array_filter(array_map('trim', explode(',', $request->soft_skills))))) as $st_skill){

             UserTag::create([

                'tag_id'=>SoftSkills::where('soft_skills',$st_skill)->value('id'),
                'user_id'=>Auth::user()->id,
                'tag_model'=>'soft_skill'
            ]);
           
         }

         foreach(json_decode(json_encode(array_filter(array_map('trim', explode(',', $request->profession))))) as $profession){
            UserTag::create([
                'tag_id'=>Profession::where('profession',$profession)->value('id'),
                'user_id'=>Auth::user()->id,
                'tag_model'=>'profession'
            ]);
         }

          foreach(json_decode(json_encode(array_filter(array_map('trim', explode(',', $request->interests))))) as $interest){
            UserTag::create([
                'tag_id'=>Interest::where('interest',$interest)->value('id'),
                'user_id'=>Auth::user()->id,
                'tag_model'=>'interest'
            ]);
         }

    
        $data = json_decode($data->profile_settings);
   
            $data->skill_level          = trim($request->skill_level);
            $data->availability         = trim($request->availability);
            $data->years_of_experience  = $request->years_of_experience ?? null;
            $data->bio                  = trim($request->bio ??  $data->bio ?? null);
            $data->linkedin             = trim($request->linkedin ?? $data->linkedin ?? null);
            $data->github               = trim($request->github ?? $data->github ?? null);
            $data->leetcode             = trim($request->leetcode ?? $data->leetcode ?? null );

  
    if($request->hasFile('profile_image')){
        $path = $request->file('profile_image')->store('assets','public');
        $data->image=$path;
    }
    if($request->hasFile('resume')){
        $resume_path = $request->file('resume')->store('files','public');
        $data->resume = $resume_path;
    }

    
     
       UserProfile::updateOrCreate(
                ['user_id' => Auth::id()], 
                ['profile_settings' => json_encode($data)]
            );


        return redirect('/profile')->with('success', 'Profile updated successfully.');
    }

 
}
