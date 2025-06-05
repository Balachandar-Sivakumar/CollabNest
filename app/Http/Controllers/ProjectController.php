<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;
use Illuminate\Auth\Events\Validated;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\User;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Projects::all();
        return view('projects',compact('projects'));
    }

    public function navcreateproject(){
        return view('projectForm');
    }

public function CreateProject(Request $request)
{

  
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'goals' => 'required|string',
        'requirement_documents' => 'nullable|file|mimes:pdf,doc,docx|max:3072',
        'skills_required' => 'required|string',
        'git_repo_url' => 'required|url',
        'is_private' => 'required|in:0,1',
    ]);

    if ($request->hasFile('requirement_documents')) {
        $path = $request->file('requirement_documents')->store('files', 'public');
        $validated['requirement_documents'] = $path;
    }

     
    $validated['skills_required'] = json_encode(array_map('trim', explode(',', $validated['skills_required'])));

    $validated['owner_id'] = Auth::user()->id; 

    
       
    Projects::create($validated);

    return redirect()->route('projects')->with('success', 'Project created!');
}

public function viewProject($hashid)
{
    $decoded = Hashids::decode($hashid);

    if (empty($decoded)) {
        abort(404, 'Invalid hashid');
    }

    $id = $decoded[0];
    dd($id); 
    $user = User::with('projects')->findOrFail($id);

    return view('viewProject', compact('user'));
}



}