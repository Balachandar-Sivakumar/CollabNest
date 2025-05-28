<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_profile extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
        'technical_skills',
        'soft_skills',
        'skill_level',
        'profession',
        'interests',
        'availability',
        'years_of_experience',
        'bio',
    ];
}
