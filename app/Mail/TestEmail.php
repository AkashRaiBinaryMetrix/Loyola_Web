<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $survey;

    public function __construct($user,$survey)
    {

        $this->user = $user;
        $this->survey = $survey;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('mail_template.surveynotification')->subject('Loyola || New Survey Created');
    }
}