<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProjectTeam extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'team_lead_id',
        'project_id',
    ];

    public function teamLead()
    {
        return $this->belongsTo(User::class, 'team_lead_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function members()
    {
        return $this->hasMany(ProjectTeamMember::class, 'team_id');
    }

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            ProjectTeamMember::class,
            'team_id',    
            'id',        
            'id',         
            'user_id'     
        );
    }
}
