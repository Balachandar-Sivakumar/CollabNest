<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        // Get all tasks for admin view if needed
        $tasks = Task::latest()->get();
        
        // Tasks assigned by me
        $assignedTasks = Task::where('assigned_by', Auth::id())->get();
        
        // Tasks assigned to me
        $receivedTasks = Task::where('assigned_to', Auth::id())->get();

        // Fetch a project (example: the first project)
        $project = Project::first();

        return view('viewProject', compact('tasks', 'assignedTasks', 'receivedTasks', 'project'));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $projects = Project::all(); // Fetch all projects
        return view('tasks.create', compact('users', 'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:pending,in_progress,completed',
        ]);

        $validated['assigned_by'] = Auth::id();

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $users = User::where('id', '!=', Auth::id())->get();
        $projects = Project::all(); // Add this if you need project selection in edit
        
        return view('tasks.edit', compact('task', 'users', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:pending,in_progress,completed'
        ]);

        $task->update($validated);

        // Redirect to the index page with a success message
        return redirect()->back()->with('success', 'Task status updated!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
