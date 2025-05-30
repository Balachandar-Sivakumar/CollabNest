<?php

namespace App\Mail;


use Illuminate\Mail\Mailable;
use App\Models\Users;
use PHPUnit\Metadata\Uses;

class WelcomeMail extends Mailable
{
    public function __construct($email, $token, $hash)
    {
        $this->email = $email;
        $this->token = $token;
        $this->hash = $hash;
    }

    public function build()
    {
        $url = url("/verify?token={$this->token}&email_hash={$this->hash}");
        return $this->subject('Verify Your Email')
                    ->view('emails.verify')
                    ->with(['url' => $url]);
    }
}

