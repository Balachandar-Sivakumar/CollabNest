<?php

namespace App\Policies;

use App\Models\TaskComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, TaskComment $comment)
    {
        return $user->id === $comment->user_id || $user->is_admin;
    }
}