<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFeedback;
use App\Models\Notification;
use App\Models\Survey;
use Hash;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;
use App\Jobs\SendMultipleEmailJob;


class UsersController extends Controller
{

    public function index()
    {
        $users=User::where('user_type','user')->orderBy('id','DESC')->get();      
        return view('admin.users.index',[
            'users'=>$users
        ]);
    }

    public function feedbackLists()
    {
        $feedbackLists=UserFeedback::with('user')->orderBy('id','DESC')->get();      
        return view('admin.users.feedback',[
            'feedbackLists'=>$feedbackLists
        ]);
    }

    public function notifications()
    {
        $notifications=Notification::orderBy('id','DESC')->get();      
        return view('admin.users.notification',[
            'notifications'=>$notifications
        ]);
    }

    public function sendMail()
    {
        $users=User::where('user_type','user')->orderBy('id','DESC')->get(); 
        $surveys= Survey::where('is_published','Yes')->get();     
        return view('admin.users.sendmail',[
            'users'=>$users,
            'surveys' =>$surveys
        ]);
    }

    public function sendMessage(Request $request)
    {
        $userIds= $request->user_id;  
        $surveyId= $request->survey_id;  
        $users= User::whereIn('id',$userIds)->get();
        $survey= Survey::find($surveyId);
        dispatch(new SendEmailJob($users,$survey));
        return redirect('admin/user/send-email')->with('success','Email has been send successfully.');
        
    }

    public function sendMailUser()
    {
        $surveys= Survey::where('is_published','Yes')->get();     
        return view('admin.users.sendmailuser',[
            'surveys' =>$surveys
        ]);
    }

    public function sendMessageUser(Request $request)
    {
        $emails= $request->email;
        if (array_filter($emails)) {
            foreach($emails as $email){
               if($email){
            $surveyId= $request->survey_id;  
            $survey= Survey::find($surveyId);
            dispatch(new SendMultipleEmailJob($email,$survey));
            }
         }
         return redirect('admin/user/send-email-user')->with('success','Email has been send successfully.');
        } else {
            return redirect('admin/user/send-email-user')->with('error','Please Select Email ID.');
        }  
        

       
        
    }





}
