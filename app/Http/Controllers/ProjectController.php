<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Auth\Events\Validated;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\User;
use App\Models\Skill;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects',compact('projects'));
    }

    public function navcreateproject(){
        return view('createProject');
    }

    public function CreateProject(Request $request)
    {
      

          $validated =  $request->validate([
        'title' => 'required',
        'description' => 'required',
        'goals' => 'required',
        'skills_required' => 'nullable|array',
        'github' => 'nullable|url|max:255',
        'trello' => 'nullable|url|max:255',
        'is_private' => 'required|boolean',
        ]);


        $validated['owner_id']=Auth::user()->id;
        $document_path=[];
        if($request->hasFile('requirement_documents')){
            foreach($request->file('requirement_documents') as $file){
                $document_path[] = $file->store('projectDocuments','public');
            }
           
        }

        if($request->hasFile('logo')){
            $logo_path = $request->file('logo')->store('files','public');
        }

        $skills=[];

        foreach($validated['skills_required'] as $skill){
            $skills[]=Skill::where('skill',$skill)->value('id');
        }

        $validated['requirement_documents'] = json_encode($document_path);
        $validated['logo']=$logo_path;
        $validated['project_url']=json_encode(['github'=>$validated['github'],'trello'=>$validated['trello']]);
        $validated['skills_required']=json_encode($skills);
        

        Project::create($validated);

        return redirect()->route('projects')->with('success', 'Project created!');
    }

    public function viewProject(Project $project)
    {
        return view('viewProject', compact('project'));
    }

    public function navUpdateProject($id){
        
        $project = Project::where('id',$id)->first();
        return view('updateProject',compact('project'));
    }

}