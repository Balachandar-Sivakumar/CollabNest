<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

  protected $fillable = [
        'title',
        'description',
        'goals',
        'requirement_documents',
        'skills_required',
        'is_private',
        'git_repo_url',
        'owner_id',
    ];
}
