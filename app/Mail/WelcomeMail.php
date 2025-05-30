<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Users;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $token;
    public $hash;
    public $user;

    public function __construct(string $email, string $token, string $hash,User $user)
    {
        $this->user = $user;
        $this->email = $email;
        $this->token = $token;
        $this->hash = $hash;
    }

    public function build()
    {
        $url = url("/verify?token={$this->token}&email_hash={$this->hash}");
        return $this->subject('Verify Your Email')
                    ->view('verifymail')
                    ->with(['url' => $url,'user'=> $this->user]);
    }
}
