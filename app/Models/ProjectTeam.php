<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectTeam extends Model
{
     use HasHashid, HashidRouting;
    use HasFactory;
    protected $fillable = ['project_id', 'user_id', 'owner_id'];

}
