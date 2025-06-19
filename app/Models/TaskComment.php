<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $fillable = ['comment', 'task_id', 'user_id'];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}