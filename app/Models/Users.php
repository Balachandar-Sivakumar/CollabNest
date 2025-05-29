<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];
}
