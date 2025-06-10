<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy{
    public function view(User $user, Task $task)
{
    return $user->id === $task->assigned_to || $user->id === $task->assigned_by;
}

public function update(User $user, Task $task)
{
    // Allow both the assigner and the assigned user to update
    return $user->id === $task->assigned_by || $user->id === $task->assigned_to;
}

public function delete(User $user, Task $task)
{
    return $user->id === $task->assigned_by;
}
}


