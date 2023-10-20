<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use App\Models\EmailTemplate;
use App\Models\UserLocation;
use Carbon;
use Stevebauman\Location\Facades\Location;
use DB;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function register(Request $request)
    {
       $newuser= new User;
       $newuser->name=$request->name;
       $newuser->email=$request->email;
       $newuser->role_id=2;
       $newuser->password=Hash::make($request->password);
       $check=User::where('email',$request->email)->first();
       if($check)
       {
         $res['status']='false';
         $res['msg']='This email id already exist.';
         return $res;
       }
       // if($newuser->save())
       // {
        $ip = $request->ip();
        $currentUserInfo = Location::get($ip);
        if(!empty($currentUserInfo))
        {
            $userlocation=new UserLocation;
            $userlocation->user_id=$newuser->id ?? '';
            $userlocation->country=$currentUserInfo->countryName;
            $userlocation->timezone=$currentUserInfo->timezone;
            $userlocation->state=$currentUserInfo->regionName;
            $userlocation->city=$currentUserInfo->cityName;
            $userlocation->zipcode=$currentUserInfo->zipCode;
            $userlocation->ip=$currentUserInfo->ip;
            $userlocation->created_at=\Carbon\Carbon::now();
            $userlocation->save();
        }
            $title='If i were';
            $subject='Acknowledgement of Registration';
            $emailtemp = EmailTemplate::first();
            $message=$emailtemp->welcome_note;
            $emai6ltemp=encrypt($request->email);
            $route=url('confirm-email/'.$emailtemp);
            $link='<a href="'.$route.'">Confirm Your Email</a>';
            
            if(strpos($message, '[USER]') !== false && strpos($message, '[EMAIL]') !== false && strpos($message, '[LINK]') !== false)
            {
                $messagenew11=str_replace('[LINK]',$link,$message);
                $messagenew1=str_replace('[EMAIL]',$request->email,$messagenew11);
                $messagenew=str_replace('[USER]',ucwords($request->name),$messagenew1);
            }
            else
            {
                $messagenew=$message;
            }
           
            $to=$request->email;
            \Helper::sendemail($subject,$title,$messagenew,$to);
                $res['status']='true';
                $res['msg']='Thanks for registering with us a confirmation email has been sent to you.';
                return $res;
           
       // } 

    }

    public function forget_password(Request $request)
    {
        // dd($request->all());
        date_default_timezone_set('UTC');
        $check=User::where('email',$request->email)->first();
        if($check)
        {
            $otp=rand(1111,9999);
            $currettime=\Carbon\Carbon::now()->timestamp;
            $time1=\Carbon\Carbon::now()->addMinutes(30);
            $time=$time1->timestamp;
            
            User::where('email',$request->email)->update(['otp'=>$otp]);

            $title='If i were';
            $subject='Forgot Password Link';
            $emailtemp = EmailTemplate::first();
            $message=$emailtemp->forgot_password;
            if(strpos($message, '[OTP]') !== false)
            { 
                $messagenew=str_replace('[OTP]',$otp,$message);  
            }
            else
            {
                $messagenew=$message;
            }
           
            $to=$request->email;
            $sendemail=\Helper::sendemail($subject,$title,$messagenew,$to);
            return 2; 
        }else
        {
            return 1;
        }
    }

    public function verifyotp(Request $request)
    {
        
        $check=User::where('email',$request->email)->where('otp',$request->otp)->first();
        if(!empty($check))
        {
            $res['status']=2;
            $res['route']=url('forget-password/'.encrypt($request->email));
            return $res;
        }else
        {
            return 1;
        }
    }

    public function invite_friends(Request $request)
    {
        if($request->isMethod('post'))
        {
            // dd($request->all());
            $invite=\DB::table('user_invitation')->insertGetId(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'friend_email'=>$request->email,'user_id'=>\Session::get('user')->id,'created_at'=>\Carbon\Carbon::now(),'updated_at'=>\Carbon\Carbon::now()]);
              $activity['post_id']=$invite;
              $activity['like_id']='';
              $activity['user_id']=\Session::get('user')->id;
              $activity['status']='invite';
              $activity['created_at']=\Carbon\Carbon::now();
              $activity['updated_at']=\Carbon\Carbon::now();
              \DB::table('user_activity')->insert($activity);
            $invitation='<a href="'.route('home.dashboard').'">'.route('home.dashboard').'</a>';
            $title='If i were';
            $subject='Invitation Link';
            $messagenew='<html><head><body>';
            $messagenew.='<p>Hello,</p><p>Please join our community for exploring new things</p><p>Click on the link for more info</p><p>'.$invitation.'</p><p>Best Wishes!</p><p>Thank you</p>';
                $messagenew.='</body></html>';          
            $to=$request->email;
            $sendemail=\Helper::sendemail($subject,$title,$messagenew,$to);
            return redirect()->back()->with('success','Invitation sent successfully on email');
        }else
        {
            return view('user.invite_friends');
        }
    }

    public function changepassword(Request $request,$id)
    {
        
        if($request->isMethod('post'))
        {
            // dd($request->all());

            $email=decrypt($request->email);
            $validated = $request->validate([
            'password' => 'required',
            'confirm_password' => 'required',
            ]);
            $check=User::where('email',$email)->first();
            if(!Hash::check($request->oldpassword,$check->password))
            { 
                return redirect()->back()->with('error','Old Password not matched');
            }
            if($request->password!=$request->confirm_password)
            {
                return redirect()->back()->with('error','Password and confirm password not matched');
            }
            $password=\Hash::make($request->password);
            User::where('email',$email)->update(['password'=>$password,'updated_at'=>\Carbon\Carbon::now(),'otp'=>NULL]);
            return redirect()->back()->with('success','Password changed successfully');
        }else
        {

            return view('user.change_password')->with(['email'=>$id]);
        }
    }

    public function forgotpassword(Request $request,$id)
    {
        
        if($request->isMethod('post'))
        {
            // dd($request->all());

            $email=decrypt($request->email);
            $validated = $request->validate([
            'password' => 'required',
            'confirm_password' => 'required',
            ]);
            if($request->password!=$request->confirm_password)
            {
                return redirect()->back()->with('error','Password and confirm password not matched');
            }
            $password=\Hash::make($request->password);
            User::where('email',$email)->update(['password'=>$password,'updated_at'=>\Carbon\Carbon::now(),'otp'=>NULL]);
            return redirect()->back()->with('success','Password changed successfully');
        }else
        {
            return view('user.forgot_password')->with(['email'=>$id]);
        }
    }
   
    public function confirmmail(Request $request,$id)
    {
        $email=decrypt($id);
        User::where('email',$email)->update(['email_verified_at'=>\Carbon\Carbon::now()]);
        return view('user.confirm_email');
        
    }

    public function user_message(Request $request)
    {

        $set_radio_valio       = $request->set_radio_valio;
					
        $category_continent    = $request->category_continent;
		$category_category     = $request->category_category;
					
        $subcategory_continent = $request->subcategory_continent;
		$subcategory_name      = $request->subcategory_name;
        $subcategory_name1     = $request->subcategory_name1;

        $dataadd = "";

        if($set_radio_valio == "category"){
            $dataadd=\DB::table('user_messages')->insert(
                [
                    'title'=>"NA",
                    'message'=>$request->message,
                    'user_id'=>empty(\Session::get('user')->id)?"":\Session::get('user')->id,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now(),
                    'continent_name' => $category_continent,
                    'category_name' => $category_category,
                    'subcategory_name' => $subcategory_name1
            ]);
        }elseif($set_radio_valio == "subcategory"){
            $category_res          = $request->category_res;

            $dataadd=\DB::table('user_messages')->insert(
                [
                    'title'=>"NA",
                    'message'=>$request->message,
                    'user_id'=>empty(\Session::get('user')->id)?"":\Session::get('user')->id,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now(),
                    'continent_name' => $subcategory_continent,
                    'category_name' => $category_res,
                    'subcategory_name' => $subcategory_name
            ]);
        }
        
        if($dataadd)
        {
            $response['status']='true';
            $response['msg']='Your request submitted successfully';
            return $response;
        }else{
            $response['status']='false';
            return $response;
        }
    }
}
