<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $token;
    public $hash;
    public $user;

    public function __construct($token, User $user)
    {
        
        $this->token = $token;
        $this->user = $user; 
        $this->hash = hash('sha256', $user->email); 
        
    }
    public function build()
    {
        // $link = url("/verify?token={$this->token}&email_hash={$this->hash}");

        return $this->subject('Verify Your Email')
                    ->view('verifymail')
                    ->with([
                        'token' => $this->token,
                        'user' => $this->user,
                        'hash' => $this->hash,
                    ]);
    }

}
