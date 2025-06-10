<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requester;
    public $project;

    public function __construct($requester, $project)
    {
        $this->requester = $requester;
        $this->project = $project;
    }

    public function build()
    {
        return $this->subject('New Project Request')
                    ->view('project_request');
    }
}
