<?php

namespace App\Http\Controllers;


use App\Models\TaskComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class TaskCommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'task_id' => 'required|exists:tasks,id'
        ]);

        $comment = TaskComment::create([
            'comment' => $validated['comment'],
            'task_id' => $validated['task_id'],
          'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function destroy(TaskComment $comment)
    {
        // $this->authorize('delete', $comment);
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }

// Update existing comment
public function update(Request $request, TaskComment $comment)
{
    if (Auth::id() !== $comment->user_id) {
        abort(403, 'Unauthorized');
    }

    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    $comment->comment = $request->comment;
    $comment->save();

    return back()->with('success', 'Comment updated!');
}
}