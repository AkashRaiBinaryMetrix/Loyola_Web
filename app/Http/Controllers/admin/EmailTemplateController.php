<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;

class EmailTemplateController extends Controller
{
    public function notification(Request $request)
    {
        if($request->isMethod('post'))
        {            
            $check=EmailTemplate::where('id',1)->first();
            
            if(!empty($check))
            {
                $email=EmailTemplate::where('id',1)->first();
                $email->notification=$request->notification;
                $email->updated_at=\Carbon\Carbon::now();
                $email->save();
                return redirect()->back()->with('success','Notification Template edited successfully');
            }else
            {
                $email=new EmailTemplate;
                $email->notification=$request->notification;
                $email->created_at=\Carbon\Carbon::now();
                $email->updated_at=\Carbon\Carbon::now();
                $email->save();
                return redirect()->back()->with('success','Notification Template added successfully');
            }
            
        }else
        {
            $notification=EmailTemplate::first();
            return view('admin.email.notifications')->with(['notification'=>$notification]);
        }
    }

    public function welcome_note(Request $request)
    {
        if($request->isMethod('post'))
        {            
            $check=EmailTemplate::where('id',1)->first();
            if(!empty($check))
            {
                $email=EmailTemplate::where('id',1)->first();
                $email->welcome_note=$request->welcome;
                $email->updated_at=\Carbon\Carbon::now();
                $email->save();
                return redirect()->back()->with('success','Welcome Note Template edited successfully');
            }else
            {
                $email=new EmailTemplate;
                $email->welcome_note=$request->welcome;
                $email->created_at=\Carbon\Carbon::now();
                $email->updated_at=\Carbon\Carbon::now();
                $email->save();
                return redirect()->back()->with('success','Welcome Note Template added successfully');
            }
            
        }else
        {
            $welcome_note=EmailTemplate::first();
            return view('admin.email.welcome_note')->with(['welcome'=>$welcome_note]);
        }
    }

    public function forget_password(Request $request)
    {
        if($request->isMethod('post'))
        {            
            $check=EmailTemplate::where('id',1)->first();
            if(!empty($check))
            {
                $email=EmailTemplate::where('id',1)->first();
                $email->forgot_password=$request->forget_password;
                $email->updated_at=\Carbon\Carbon::now();
                $email->save();
                return redirect()->back()->with('success','Forget password Template edited successfully');
            }else
            {
                $email=new EmailTemplate;
                $email->forgot_password=$request->forget_password;
                $email->created_at=\Carbon\Carbon::now();
                $email->updated_at=\Carbon\Carbon::now();
                $email->save();
                return redirect()->back()->with('success','Forget password Template added successfully');
            }
            
        }else
        {
            $forgetpassword=EmailTemplate::first();
            return view('admin.email.forget_password')->with(['forgetpassword'=>$forgetpassword]);
        }
    }
}
