<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vinkla\Hashids\Facades\Hashids;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password',  'verification_token','verified_at',];

    protected $hidden = [
        'password',
        'remember_token',
    ];

      protected $appends = ['hashid'];

     public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'verified_at' => 'datetime',
    ];
}
