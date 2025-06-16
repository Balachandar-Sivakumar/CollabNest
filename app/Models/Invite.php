<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = ['owner_id', 'project_id', 'email', 'target_user_id', 'status'];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function targetUser() {
        return $this->belongsTo(User::class, 'target_user_id');
    }
}
