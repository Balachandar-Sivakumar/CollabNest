<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTeamMember extends Model
{
      protected $fillable = [
        'user_id',
        'team_id',
        'project_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(ProjectTeam::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
