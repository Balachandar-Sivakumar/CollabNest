<?php

namespace App\Http\Controllers;
use App\Models\Task; // Instead of App\Http\Controllers\Task
use App\Models\TaskComment; // Instead of App\Http\Controllers\TaskComment
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    public function store(Request $request, Task $task) {
    $request->validate([
        'comment' => 'required|string|max:1000'
    ]);

    $task->comments()->create([
        'user_id' => Auth::id(),
        'comment' => $request->comment
    ]);

    return back()->with('success', 'Comment added successfully.');
}

public function update(Request $request, TaskComment $comment) {
    $this->authorize('update', $comment);
    
    $request->validate([
        'comment' => 'required|string|max:1000'
    ]);

    $comment->update(['comment' => $request->comment]);
    return back()->with('success', 'Comment updated successfully.');
}

public function destroy(TaskComment $comment) {
    $this->authorize('delete', $comment);
    $comment->delete();
    return back()->with('success', 'Comment deleted successfully.');
}
}
