<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TestEmail; 
use Mail;
use App\Models\User;

class SendMultipleEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $email,$survey;
    
    
    /** 
    * Create a new job instance.
    * @return void
    */ 
    
    public function __construct($email,$survey)
    {
      $this->email = $email;
      $this->survey = $survey;
    }
    
    
    public function handle()
     {
      
       $email = $this->email;
       $survey = $this->survey;
        Mail::send('mail_template.surveynotificationmultiple', ['survey' => $survey,'name' =>''], function($message) use ($email)
        {    
            $message->to($email)->subject('Loyola || Survey News');    
        });

       
     }
}

?>