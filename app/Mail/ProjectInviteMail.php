<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $invite;
    public $user;

    public function __construct(Project $project, $invite, User $user = null)
    {
        $this->project = $project;
        $this->invite = $invite;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('You Are Invited To: Project Title: ' . $this->project->title)
            ->view('invite')
            ->with([
                'invite' => $this->invite,
                'project' => $this->project,
                'user' => $this->user,
            ]);
    }
}
