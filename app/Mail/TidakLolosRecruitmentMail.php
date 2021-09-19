<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TidakLolosRecruitmentMail extends Mailable
{
    public $recruitment_user; 
    
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recruitment_user)
    {
        $this->recruitment_user = $recruitment_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Open Recruitment TAHUNGODING')->markdown('back.email.tidak_lolos_email')->with('recruitment_user', $this->recruitment_user);
    }
}
