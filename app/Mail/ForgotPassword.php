<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
       use Queueable, SerializesModels;

    public $email;   

    public function __construct($email)
    {
        
        $this->email = $email;

        
    }

    public function build(){
        return $this->subject('Verify your email')->
                view('forgotMail')
                ->with([
                    'email'=>$this->email
                ]);
    }
}
