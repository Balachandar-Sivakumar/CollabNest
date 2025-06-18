<?php

namespace App\Http\Controllers;

use App\Models\Task;            
use App\Models\User;    
use App\Models\Project;         
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
   public function store(Request $request) {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'project_id' => 'required|exists:projects,id',
        'assigned_to' => 'required|exists:users,id',
        'due_date' => 'nullable|date',
        'status' => 'nullable|in:todo,in_progress,testing,completed,on_hold,cancelled',
        'requirement_document' => 'nullable|file|max:10240',
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'team' => 'nullable|array',
        'team.*' => 'exists:users,id'
    ]);

    $validated['assigned_by'] = Auth::id();

    // Handle file uploads
    if ($request->hasFile('requirement_document')) {
        $validated['requirement_document'] = $request->file('requirement_document')->store('task_documents', 'public');
    }

    $imagePaths = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePaths[] = $image->store('task_images', 'public');
        }
        $validated['images'] = $imagePaths;
    }

    $task = Task::create($validated);

    // Sync team members
    if ($request->filled('team')) {
        $task->teamMembers()->sync($request->team);
    }

    return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
}

public function update(Request $request, Task $task) {
    $this->authorize('update', $task);

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'assigned_to' => 'required|exists:users,id',
        'due_date' => 'nullable|date',
        'status' => 'required|in:todo,in_progress,testing,completed,on_hold,cancelled',
        'requirement_document' => 'nullable|file|max:10240',
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'team' => 'nullable|array',
        'team.*' => 'exists:users,id'
    ]);

    // Handle file uploads
    if ($request->hasFile('requirement_document')) {
        if ($task->requirement_document) {
            Storage::disk('public')->delete($task->requirement_document);
        }
        $validated['requirement_document'] = $request->file('requirement_document')->store('task_documents', 'public');
    }

    if ($request->hasFile('images')) {
        // Delete old images
        if ($task->images) {
            foreach ($task->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $imagePaths = [];
        foreach ($request->file('images') as $image) {
            $imagePaths[] = $image->store('task_images', 'public');
        }
        $validated['images'] = $imagePaths;
    }

    $task->update($validated);

    // Sync team members
    $task->teamMembers()->sync($request->team ?? []);

    return redirect()->back()->with('success', 'Task updated successfully!');
}

public function show(Task $task) {
    $this->authorize('view', $task);
    $comments = $task->comments()->with('user')->latest()->get();
    return view('tasks.show', compact('task', 'comments'));
}
}
