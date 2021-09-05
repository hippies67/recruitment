<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectedRecruitmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recruitment_user; 

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
        return $this->subject('Open Member TAHUNGODING')->markdown('back.email.rejected_email')->with('recruitment_user', $this->recruitment_user);
    }
}
