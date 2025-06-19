<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Task $task)
    {
        return $user->id === $task->assigned_by || 
               $user->id === $task->assigned_to || 
               $task->teamMembers->contains($user->id) || 
               $user->is_admin;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Task $task)
    {
        return $user->id === $task->assigned_by || $user->is_admin;
    }

    public function delete(User $user, Task $task)
    {
        return $user->id === $task->assigned_by || $user->is_admin;
    }
}