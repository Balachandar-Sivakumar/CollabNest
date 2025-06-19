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
        return $this->subject('Project Request: Project Title Is '.$this->project->title)
                    ->view('project_request')->with([
                    'requester' => $this->requester,
                    'project' => $this->project,
                ]);
    }
}
