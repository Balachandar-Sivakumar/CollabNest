<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Vinkla\Hashids\HashidsServiceProvider;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;
    use HasHashid, HashidRouting;

    protected $fillable = ['name', 'email', 'password',  'verification_token','verified_at',];

    protected $hidden = [
        'password',
        'remember_token',
    ];

      protected $appends = ['hashid'];

     public function getHashidAttribute()
    {
         return $this->hashid();
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->findByHashid($value);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'verified_at' => 'datetime',
    ];
}
