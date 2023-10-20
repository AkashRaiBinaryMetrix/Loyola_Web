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

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $users,$survey;
    
    
    /** 
    * Create a new job instance.
    * @return void
    */ 
    
    public function __construct($users,$survey)
    {
      $this->users = $users;
      $this->survey = $survey;
    }
    
    
    public function handle()
     {
      
       $users = $this->users;
       $survey = $this->survey;
       $emails= User::where('status','active')->where('user_type','user')->pluck('email')->toArray();

        Mail::send('mail_template.surveynotification', ['survey' => $survey,'name' =>''], function($message) use ($emails)
        {    
            $message->to($emails)->subject('Loyola || New Survey Created');    
        });

    //    foreach($users as $user){
    //     if($user->email){
    //         //$email= $user->email;
    //         // Mail::send('mail_template.surveynotification', ['survey' => $survey,'name' => $user->name], function ($message) use ($email) {
    //         //     $message->to($email)
    //         //       ->subject("Loyola || New Survey Created")
    //         //       ->from('noreply@gmail.com');
    //         // });



    //         $email = new TestEmail($users,$survey);
    //         Mail::to($user->email)->send($email);
    //     }
    //  }
       
     }
}

?>