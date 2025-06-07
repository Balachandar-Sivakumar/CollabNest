<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Auth\Events\Validated;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;

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

    public function UpdateProject(Request $request,$id){
       
           $request->validate([
        'title' => 'required',
        'description' => 'required',
        'goals' => 'required',
        'technical_skills' => 'required',
        'github'=>'required',
        'trello'=>'required',
        'is_private' => 'required|boolean',
        ]);

        $project = Project::where('id',$id)->first();
       
        if($request->hasFile('logo')){
            if(isset($project->logo) && Storage::disk('public')->exists($project->logo)){
                Storage::disk('public')->delete($project->logo);
            }
               $logo_path = $request->file('logo')->store('files','public');
        }

        $document_path=json_decode($project->requirement_documents);
        $removed_docs = json_decode($request->removed_documents) ?? [];

        //Removing paths fron database remove docs
        $document_path = array_filter($document_path, function($doc) use ($removed_docs) {
                return !in_array($doc, $removed_docs);
            });

            //deleting from local storage
        foreach($removed_docs as $removed){
            if(Storage::disk('public')->exists($removed)){
                Storage::disk('public')->delete($removed);
            }
        }

        if($request->hasFile('requirement_documents')){
            foreach($request->file('requirement_documents') as $file){
                array_push($document_path, $file->store('projectDocuments','public'));
            } 
        }

        $skills=[];
        foreach(json_decode(json_encode(array_filter(array_map('trim', explode(',', $request->technical_skills))))) as $skill){
            $skills[]=Skill::where('skill',$skill)->value('id');
        }

        $update = [
            'owner_id'=>Auth::user()->id,
            'title'=>$request->title,
            'logo'=>$logo_path ?? $project->logo,
            'description'=>$request->description,
            'goals'=>$request->goals,
            'requirement_documents'=>json_encode($document_path),
            'skills_required'=> json_encode($skills),
            'project_url'=>json_encode(['github'=>$request->github,'trello'=>$request->trello]),
            'is_private'=>$request->is_private
        ];

        Project::where('id',$id)->update($update);

        return redirect("projects")->with('success','Project updated successfully');

        }

}