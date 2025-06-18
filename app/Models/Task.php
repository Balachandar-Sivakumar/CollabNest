<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;


class Task extends Model
{
    use HasFactory;
protected $fillable = [
    'title',
    'description',
    'assigned_by',
    'assigned_to',
    'due_date',
    'status',
    'project_id',
    'requirement_document',
    'images'
];

protected $casts = [
    'due_date' => 'date',
    'images' => 'array'
];

public function assigner() {
    return $this->belongsTo(User::class, 'assigned_by');
}

public function assignee() {
    return $this->belongsTo(User::class, 'assigned_to');
}

public function project() {
    return $this->belongsTo(Project::class);
}

public function comments() {
    return $this->hasMany(TaskComment::class);
}

public function teamMembers() {
    return $this->belongsToMany(User::class, 'task_team_members');
}


}
