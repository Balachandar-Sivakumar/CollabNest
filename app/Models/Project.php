<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class Project extends Model
{
    use HasHashid, HashidRouting;
    use HasFactory;

         protected $fillable = [
            'title',
            'logo',
            'description',
            'goals',
            'requirement_documents',
            'skills_required',
            'project_url',
            'is_private',
            'owner_id',
        ];
        
        public function requesters()
        {
            return $this->belongsToMany(User::class, 'project_requests', 'project_id', 'user_id');
        }


}
