<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Redirect;
use Session;
use App\Models\EmailTemplate;
use Exception;

class AdminController extends Controller
{
    

    public function login(Request $request)
    {
        $check=Session::get('admin');
        if($check)
        {
           return Redirect::to('admin/home');
        }else
        {
            if($request->isMethod('post'))
            {
                $check=User::where('email',$request->email)->first();
                if(!empty($check) && Hash::check($request->password,$check->password))
                {
                        Session::put('admin',$check);
                        return Redirect::to('admin/home');
                }
                else if(empty($check))
                { 

                   return redirect()->route('admin.login')->with('success','This email is not registered with us'); 
                }

                else if(!Hash::check($request->password,$check->password))
                {
                    return redirect()->route('admin.login')->with('success','Password not matched with records'); 
                }
                
                
            }else
            {
                return view('admin.admin_login');
            }
        }
    }

    public function signup(Request $request)
    {
       
        if($request->isMethod('post'))
        {
            $check=User::where('email',$request->email)->first();
            if(empty($check))
            {
            $user=new User;
            $user->name='admin';
            $user->email=$request->email;
            $user->password=Hash::make($request->pass);
            $user->created_at=\Carbon\Carbon::now();
            $user->updated_at=\Carbon\Carbon::now();
            $user->save();
            return Redirect::to('admin/login')->with('success','You are successfully registered');
            }else
            {
                return Redirect::to('admin/signup')->with('error','email id already exist');
            }
        }else
        {
            return view('admin.admin_signup');
        }
    }

    public function logout(Request $request)
    {
        $result=Session::get('admin');
        if($result)
        {

          Session::forget('admin');
          return redirect()->route('admin.login');
        }else
        {
            return redirect()->route('admin.login');
        }
    }

    public function forget_password(Request $request)
    {
        if($request->isMethod('post'))
        {
            $check=User::where('email',$request->email)->first();
            if(!empty($check))
            {
                $otp=rand(1111,9999);
                User::where('email',$request->email)->update(['otp'=>$otp]);
                $title='If i were';
                $subject='Forgot Password Link';
                $messagenew='<html><head><body>';
                $messagenew.='<p>Hello,</p><p>To authenticate,please use the following One Time Password(OTP).</p><p>'.$otp.'</p><p>Don&#39;t share this OTP with anyone. Our customer service team will never ask you for your password,Otp.</p><p>We hope to see you again soon.</p><p>Best Wishes!</p><p>Thank you</p>';
                $messagenew.='</body></html>';
                $to=$request->email;
                $sendemail=\Helper::sendemail($subject,$title,$messagenew,$to);
                    $response['success']='OTP has been send on your email id successfully';
                    $response['email']=$request->email; 
                return view('admin.password_otp_verify')->with(['data'=>$response]);
            }else
            {
                return redirect()->route('admin.forgot.password')->with('error','Email id is not matched with our records');
            }
        }else
        {
            return view('admin.forgot_password');
        } 
    }

    public function checkotp(Request $request)
    {
        $check=User::where('email',$request->email)->first();
        if(!empty($check))
        {   
            if($request->otp==$check->otp)
            {
                $email=encrypt($request->email);
                $res['url']=url('admin/change-password/'.$email);
                return $res;
            }else
            {
                return 2;  
            }
        }else
        { 
            return 2;
        }  
    }

    public function change_password(Request $request,$id)
    {

        if($request->isMethod('post'))
        {
            if($request->password!=$request->confirm_password)
            {
                return redirect('admin/change-password/'.$id)->with('error','Password and confirm password not matched');
            }else
            {
                $email=decrypt($id);
                User::where('email',$email)->update(['password'=>Hash::make($request->password),'otp'=>1]);
                return redirect()->route('admin.login')->with('success','Password changed successfully');
            }
        }else
        {
                return view('admin.change_password',compact('id'));
        }
    }

    public function admin_profile(Request $request)
    {
        if($request->isMethod('post'))
        {
            $adminlogin=Session::get('admin');
            User::where('id',$adminlogin->id)->update(['name'=>$request->name,'email'=>$request->email,'experiance'=>$request->experience,'skills'=>$request->skills,'created_at'=>\Carbon\Carbon::now(),'updated_at'=>\Carbon\Carbon::now()]);
            return redirect()->back()->with('success','Profile Updated successfully');
        }else
        {
            $adminlogin=Session::get('admin');
            $admin=User::where('id',$adminlogin->id)->first();
            return view('admin.admin_profile',compact('admin'));
        }
        
        
    }

    public function changepassword(Request $request)
    {
        
        if($request->isMethod('post'))
        {
            $check=User::where('email',$request->email)->first();

            if(!Hash::check($request->oldpassword,$check->password))
            {
                
                return redirect('admin/profile')->with('error','Old Password not matched');
            }
            else if($request->newpassword!=$request->newpasswordConfirm)
            {
                return redirect('admin/profile')->with('error','Password and confirm password not matched');
            }else
            {
                
                User::where('email',$request->email)->update(['password'=>Hash::make($request->newpassword)]);
                return redirect()->route('admin.profile')->with('success','Password changed successfully');
            }
        }
    }

    public function edit_profile_image(Request $request)
    {
       try
       {
            if(\Session::get('admin'))
            {
            $image = $request->file('image');
            $name = 'admin-profile-pic'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path(); 
            $image->move($destinationPath, $name);
                User::where('id',\Session::get('admin')->id)->update(['profile_pic'=>$name]);
                return redirect()->back()->with('success','Profile updated successfully');
            }else
            {
                return redirect()->route('admin.login');
            }
       } catch(\Throwable $e){
        
            $msg = 'Server Down Something went wrong';
            $description = $e->getMessage();
            $details = 'Got an error message';
            $config['content'] = $description;
                $config['to'] = 1;
                return redirect()->route('admin.profile')->with('error',$msg);
            }
       
        
    }
}

