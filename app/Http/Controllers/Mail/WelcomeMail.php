<?php

namespace App\Mail;


use Illuminate\Mail\Mailable;
use App\Models\MailSend;

class WelcomeMail extends Mailable
{
    public $user, $emailHash, $token;

    public function __construct(MailSend $user, $emailHash, $token)
    {
        $this->user = $user;
        $this->emailHash = $emailHash;
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Verify Your Email')
                    ->view('emails.verify');
    }
}

