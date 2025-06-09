<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Project;


class TaskController extends Controller
{
    public function index()
    {
        // Tasks assigned by me
        $assignedTasks = Task::where('assigned_by', Auth::id())->get();
        
        // Tasks assigned to me
        $receivedTasks = Task::where('assigned_to', Auth::id())->get();

        return view('tasks.index', compact('assignedTasks', 'receivedTasks'));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('tasks.create', compact('users'));
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
        return view('tasks.edit', compact('task', 'users'));
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

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}