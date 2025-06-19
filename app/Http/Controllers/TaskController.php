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
    public function index()
    {
        $tasks = Task::with(['project', 'assignee', 'assigner'])
                    ->latest()
                    ->paginate(10);
        
        $assignedTasks = Task::where('assigned_by', Auth::user()->id)->get();
        $receivedTasks = Task::where('assigned_to', Auth::user()->id)->get();
        
        return view('tasks.index', compact('tasks', 'assignedTasks', 'receivedTasks'));
    }

    public function create()
    {
        $projects = Project::all();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('tasks.create', compact('projects', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date|after:today',
            'status' => 'nullable|in:todo,in_progress,testing,completed,on_hold,cancelled',
            'requirement_document' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'team' => 'nullable|array',
            'team.*' => 'exists:users,id'
        ]);

        $validated['assigned_by'] = Auth::user()->id;

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

        if ($request->filled('team')) {
            $task->teamMembers()->sync($request->team);
        }

        return redirect()->route('tasks.show', $task)->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        $task->load(['project', 'assigner', 'assignee', 'teamMembers', 'comments.user']);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $projects = Project::all();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        $teamMembers = $task->teamMembers->pluck('id')->toArray();
        
        return view('tasks.edit', compact('task', 'projects', 'users', 'teamMembers'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date|after:today',
            'status' => 'required|in:todo,in_progress,testing,completed,on_hold,cancelled',
            'requirement_document' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'team' => 'nullable|array',
            'team.*' => 'exists:users,id'
        ]);

        if ($request->hasFile('requirement_document')) {
            if ($task->requirement_document) {
                Storage::disk('public')->delete($task->requirement_document);
            }
            $validated['requirement_document'] = $request->file('requirement_document')->store('task_documents', 'public');
        }

        if ($request->hasFile('images')) {
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
        $task->teamMembers()->sync($request->team ?? []);

        return redirect()->route('tasks.show', $task)->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        
        if ($task->requirement_document) {
            Storage::disk('public')->delete($task->requirement_document);
        }
        
        if ($task->images) {
            foreach ($task->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $task->delete();
        
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
   public function updateStatus(Request $request, Task $task)
{
    // Allow only the assigned user to update the status
    if (Auth::id() !== $task->assigned_to) {
        abort(403, 'Unauthorized action.');
    }

    // Include all valid enum options including 'todo'
    $validated = $request->validate([
        'status' => 'required|in:todo,in_progress,completed,testing,on_hold,cancelled',
    ]);

    $task->status = $validated['status'];
    $task->save();

    return back()->with('success', 'Task status updated successfully.');
}

}