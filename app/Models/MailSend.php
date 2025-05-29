<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MailSend extends Authenticatable
{
    use HasFactory;

    protected $table = 'email_users'; // Name of the DB table

    protected $fillable = [
        'name',
        'email',
        'verification_token',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function isVerified()
    {
        return !is_null($this->verified_at);
    }
}
