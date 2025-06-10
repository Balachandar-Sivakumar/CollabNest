<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\User;
use App\Models\Skill;
use App\Models\Task; // Make sure to import the Task model

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects', compact('projects'));
    }

    public function navcreateproject()
    {
        return view('createProject');
    }

    public function CreateProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'goals' => 'required',
            'skills_required' => 'nullable|array',
            'github' => 'nullable|url|max:255',
            'trello' => 'nullable|url|max:255',
            'is_private' => 'required|boolean',
        ]);

        $validated['owner_id'] = Auth::user()->id;

        // Handle file uploads
        $document_path = [];
        if ($request->hasFile('requirement_documents')) {
            foreach ($request->file('requirement_documents') as $file) {
                $document_path[] = $file->store('projectDocuments', 'public');
            }
        }

        $logo_path = null;
        if ($request->hasFile('logo')) {
            $logo_path = $request->file('logo')->store('files', 'public');
        }

        // Convert skill names to IDs
        $skills = [];
        if (!empty($validated['skills_required'])) {
            foreach ($validated['skills_required'] as $skill) {
                $skills[] = Skill::where('skill', $skill)->value('id');
            }
        }

        // Prepare data for saving
        $validated['requirement_documents'] = json_encode($document_path);
        $validated['logo'] = $logo_path;
        $validated['project_url'] = json_encode([
            'github' => $validated['github'] ?? '',
            'trello' => $validated['trello'] ?? ''
        ]);
        $validated['skills_required'] = json_encode($skills);

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created!');
    }

public function viewProject(Project $project)
{
$user = \Illuminate\Support\Facades\Auth::user(); 
$userId = $user->id;

    $assignedTasks = Task::where('project_id', $project->id)
                         ->where('assigned_by', $userId)
                         ->get();

    $receivedTasks = Task::where('project_id', $project->id)
                         ->where('assigned_to', $userId)
                         ->get();

    return view('viewProject', compact('project', 'assignedTasks', 'receivedTasks'));
}


    public function navUpdateProject($id)
    {
        $project = Project::findOrFail($id);
        return view('updateProject', compact('project'));
    }

    public function UpdateProject(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'goals' => 'required',
            'technical_skills' => 'required|string',
            'github' => 'required|url|max:255',
            'trello' => 'required|url|max:255',
            'is_private' => 'required|boolean',
        ]);

        $project = Project::findOrFail($id);

        // Handle logo update
        $logo_path = $project->logo;
        if ($request->hasFile('logo')) {
            if ($logo_path && Storage::disk('public')->exists($logo_path)) {
                Storage::disk('public')->delete($logo_path);
            }
            $logo_path = $request->file('logo')->store('files', 'public');
        }

        // Handle document updates
        $document_path = json_decode($project->requirement_documents, true) ?? [];
        $removed_docs = json_decode($request->removed_documents, true) ?? [];

        $document_path = array_filter($document_path, function ($doc) use ($removed_docs) {
            return !in_array($doc, $removed_docs);
        });

        foreach ($removed_docs as $removed) {
            if (Storage::disk('public')->exists($removed)) {
                Storage::disk('public')->delete($removed);
            }
        }

        if ($request->hasFile('requirement_documents')) {
            foreach ($request->file('requirement_documents') as $file) {
                $document_path[] = $file->store('projectDocuments', 'public');
            }
        }

        // Convert skills string to IDs
        $skills = [];
        $skillList = array_filter(array_map('trim', explode(',', $request->technical_skills)));
        foreach ($skillList as $skill) {
            $skills[] = Skill::where('skill', $skill)->value('id');
        }

        // Prepare update array
        $update = [
            'owner_id' => Auth::user()->id,
            'title' => $request->title,
            'logo' => $logo_path,
            'description' => $request->description,
            'goals' => $request->goals,
            'requirement_documents' => json_encode($document_path),
            'skills_required' => json_encode($skills),
            'project_url' => json_encode([
                'github' => $request->github,
                'trello' => $request->trello
            ]),
            'is_private' => $request->is_private,
        ];

        $project->update($update);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }
}