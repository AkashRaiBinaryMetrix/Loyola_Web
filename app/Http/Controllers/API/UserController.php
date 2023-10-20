<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFeedback;
use App\Models\Survey;
use App\Models\UserSurveyHistory;
use App\Models\UserQuestionAnswer;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use File;
use DB;
use Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //feedback send user
    public function cms(Request $request,$slug)
    {
        $data=DB::table('cms')->where('slug',$slug)->first();
            return response()->json([
                            'status' => 'success',
                            'status_code' => 200,
                            'msg' => 'CMS show successfully',
                            'data' => !empty($data)? $data : array(),
                    ]);
    }


    //feedback
    public function userFeedback(Request $request)
    {
      $userId=$request->user_id;

      $validator = Validator::make($request->all(),[
          'user_id' => 'required'
      ]);
      
      if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors(),
              'status' => 422,
          ]);
      }

    $data['feedback'] = UserFeedback::where('user_id',$userId)->orderBy('id','DESC')->first();
    if($data['feedback']){
    $data['type'] =explode(',', $data['feedback']['type']);
    }else{
        $data['type']=array();
    }

     return response()->json([
             'status' => 'success',
             'status_code' => 200,
             'msg' => 'User feedback show',
             'data' => !empty($data)? $data : array(),

     ]);

    }

   
    //feedback send user
    public function saveFeedback(Request $request)
    {
            $validator = Validator::make($request->all(),[
                'user_id' => 'required',
                'rate' => 'numeric',
                'type' => 'nullable',
                'message' => 'nullable','max:500'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                    'status' => 422,
                ]);
            }
            if(!empty($request->type))
            {
                $type = implode(',', $request->type);
            }else{
                $type=null;
            }
            $feedback= new UserFeedback();
            $feedback->user_id= $request->user_id;
            $feedback->type= $type ? $type :null;
            $feedback->rate= $request->rate;
            $feedback->created_at= $request->dateTime ? $request->dateTime : date('Y-m-d-H:i:s');
            $feedback->message= $request->message;
            $feedback->save();
        
            return response()->json([
                            'status' => 'success',
                            'status_code' => 200,
                            'msg' => 'Feedback saved successfully',
                    ]);
    }

    //dashboard
     public function dashboard(Request $request)
     {
        $userId=$request->user_id;

        $validator = Validator::make($request->all(),[
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $totalComplate=24;
        $totalPending=3;
        $totalIncomplate=4;

        $surveyLists = Survey::with('category')
          ->where('status','active')
          ->orderBy('id','DESC')
          ->get();

        $data[] = array(
                         "totalComplate" => $totalComplate,
                         "totalPending" => $totalPending,
                         "totalIncomplate" => $totalIncomplate,
                         "recently_added" =>  $surveyLists                                  
            );

         return response()->json([
                 'status' => 'success',
                 'status_code' => 200,
                 'msg' => 'dashboard fetched successfully',
                 'data' => !empty($data)? $data : array(),

         ]);

     }

     //survey history
     public function surveyHistoryList(Request $request)
     {
        $userId=$request->user_id;

        $validator = Validator::make($request->all(),[
            'user_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 422,
            ]);
        }
        
        $surveyIds=UserQuestionAnswer::select('survey_id')
            ->where('user_id',$userId)
            ->groupBy('survey_id')
            ->get();
        
        $surveyLists = Survey::where('status','active')
          ->whereIn('id',$surveyIds)
          ->get();

         return response()->json([
                 'status' => 'success',
                 'status_code' => 200,
                 'msg' => 'survey histrory fetched successfully',
                 'data' => !empty($surveyLists)? $surveyLists : array(),

         ]);

     }

    //survey save user
    public function saveSurvey(Request $request)
    {
        
            $userId=$request->user_id;
            $surveyId=$request->survey_id;
            $questionIds=$request->questions;
            $validator = Validator::make($request->all(),[
                'user_id' => 'numeric',
                'survey_id' => 'numeric'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                    'status' => 422,
                ]);
            }

            if($questionIds){
               
                $questionIdwithcomma=null;
                foreach($questionIds as $value)
                {
                   
                   if($value['type']=='input'){
                    $questionIdwithcomma=null;
                   }else{
                            $optionIdsarray=$value['option'];
                           // dd($optionIdsarray);
                            if($optionIdsarray){
                                $opArray=array();
                                foreach($optionIdsarray as $optionId){
                                    $opArray[]=$optionId['id'];
                                }
                            $questionIdwithcomma = implode(',', $opArray);
                            }
                    }
                    $userAnswer = new UserQuestionAnswer();
                    $userAnswer->user_id= $userId;
                    $userAnswer->survey_id= $surveyId;
                    $userAnswer->question_id= $value['id'];
                    $userAnswer->question_option_ids= $questionIdwithcomma ? $questionIdwithcomma :null;
                    $userAnswer->type= $value['type'];
                    $userAnswer->input= $value['input'] ? $value['input'] :null;
                    $userAnswer->save();
                }
            }
           
        
            return response()->json([
                            'status' => 'success',
                            'status_code' => 200,
                            'msg' => 'Survey saved successfully',
                    ]);
    }


    //survey save user V1
    public function saveSurveyV1(Request $request)
    {
            $userId=$request->user_id;
            $surveyId=$request->survey_id;
            $status=$request->status;
            $questionIds=$request->questions;
            $validator = Validator::make($request->all(),[
                'user_id' => 'numeric',
                'survey_id' => 'numeric',
                'status' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                    'status' => 422,
                ]);
            }
            
            if($questionIds){   
                $questionIdwithcomma=null;
                foreach($questionIds as $value)
                {

                   if($value['type']=='input'){
                    $questionIdwithcomma=null;
                   }else{
                            $optionIdsarray=$value['option'];
                            if($optionIdsarray){
                                $opArray=array();
                                foreach($optionIdsarray as $optionId){
                                    $opArray[]=$optionId['id'];
                                }
                            $questionIdwithcomma = implode(',', $opArray);
                            }
                    }
                    $alreadyExit= UserQuestionAnswer::where('user_id',$userId)
                    ->where('survey_id',$surveyId)
                    ->where('question_id',$value['id'])
                    ->first();

                    
                    if($alreadyExit){
                    $userAnswer = UserQuestionAnswer::find($alreadyExit->id);
                    }else{
                    $userAnswer = new UserQuestionAnswer();  
                    }
                    $userAnswer->user_id= $userId;
                    $userAnswer->survey_id= $surveyId;
                    $userAnswer->question_id= $value['id'];
                    $userAnswer->question_option_ids= $questionIdwithcomma ? $questionIdwithcomma :null;
                    $userAnswer->question_option_array_ids= null;
                    $userAnswer->type= $value['type'];
                    $userAnswer->input= $value['input'] ? $value['input'] :null;
                    $userAnswer->created_at= $request->dateTime ? $request->dateTime : date('Y-m-d h:i:s');
                    $userAnswer->updated_at= $request->dateTime ? $request->dateTime : date('Y-m-d h:i:s');
                    $userAnswer->save();
                }
            }

            if($userAnswer){
                $data = UserSurveyHistory::updateOrCreate(
                    ['user_id' => $userId, 'survey_id' => $surveyId],
                    ['status' =>$status,
                     'created_at'=>$request->dateTime ? $request->dateTime : date('Y-m-d h:i:s'),
                     'updated_at'=>$request->dateTime ? $request->dateTime : date('Y-m-d h:i:s')
                    ]
                );
            }
           
            return response()->json([
                            'status' => 'success',
                            'status_code' => 200,
                            'msg' => 'Survey saved successfully',
                    ]);
    }

    //survey history v1
    public function surveyHistoryListV1(Request $request)
    {
       $userId=$request->user_id;
       $status=$request->status;

       $validator = Validator::make($request->all(),[
           'user_id' => 'required',
           'status' => 'required'
       ]);
       
       if ($validator->fails()) {
           return response()->json([
               'errors' => $validator->errors(),
               'status' => 422,
           ]);
       }

       
       $surveyLists = UserSurveyHistory::with('survey')
          ->whereUserId($userId)
          ->where('status',$status)
          ->orderBy('updated_at','DESC')
          ->get();

        return response()->json([
                'status' => 'success',
                'status_code' => 200,
                'msg' => 'survey histrory fetched successfully',
                'data' => !empty($surveyLists)? $surveyLists : array(),

        ]);

    }
    

    //dashboard v1
    public function dashboardV1(Request $request)
    {
       $userId=$request->user_id;

       $validator = Validator::make($request->all(),[
           'user_id' => 'required'
       ]);

       if ($validator->fails()) {
           return response()->json([
               'errors' => $validator->errors(),
               'status' => 422,
           ]);
       }
       
       $totalSurvey = Survey::where('status','active')->whereDate('published_date', '<=', date('Y-m-d'))->where('is_published','Yes')->count();
       $totalComplatedSurvey = UserSurveyHistory::where('status','completed')->whereUserId($userId)->count();
       $totalIncomplatedSurvey = UserSurveyHistory::where('status','incompleted')->whereUserId($userId)->count();

       $totalPending=$totalSurvey-($totalComplatedSurvey+$totalIncomplatedSurvey);
       
      // $ComplatedSurveyId = UserSurveyHistory::where('status','completed')->whereUserId($userId)->pluck('survey_id')->toarray();
      
       $ComplatedSurveyId = UserSurveyHistory::whereUserId($userId)->pluck('survey_id')->toarray();
       $surveyLists = Survey::with('category')
         ->where('status','active')
         ->whereDate('published_date', '<=', date('Y-m-d'))
         ->where('is_published','Yes')
         ->orderBy('id','DESC')
         ->whereNotIn('id',$ComplatedSurveyId)
         ->get();

       $data[] = array(
                        "totalSurvey" => $totalSurvey ? $totalSurvey :0,
                        "totalComplate" => $totalComplatedSurvey ? $totalComplatedSurvey :0,
                        "totalPending" => $totalPending ? $totalPending :0,
                        "totalIncomplate" => $totalIncomplatedSurvey ? $totalIncomplatedSurvey :0,
                        "recently_added" =>  $surveyLists                                  
           );

        return response()->json([
                'status' => 'success',
                'status_code' => 200,
                'msg' => 'dashboard fetched successfully',
                'data' => !empty($data)? $data : array(),

        ]);

    }

    // signup
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'email' => 
            'required|string|email|max:255|unique:users,email',
            'phone' => 'required|digits:10|numeric|unique:users,phone',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $user = new User();
        $user->name= $request->name ? ucfirst(strtolower($request->name)) :null;
        $user->email= $request->email;
        $user->phone= $request->phone;
        $user->password= Hash::make($request->password);
        $user->save();       

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'msg' => 'User registered successfully',
            'data' => !empty($data)? $data : array(),
        ]);

    }

    //login
    public function login(Request $request)
      {
          $token=$request->access_token ? $request->access_token :null;
          $validator = Validator::make($request->all(),[
              'email' => 'required|email',
              'password' => 'required'
          ]);

          if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 422,
            ]);
        }

          $credentials = [
            'email' => $request->email,
            'password' => $request->password
          ];
           
          $checkEmail=User::where('email',$request->email)->first();
          if(!$checkEmail)
          {
              return response()->json([
                  'status' => 'errors',
                  'status_code' => 403,
                  'msg' => 'Invalid Email ID.'
              ]);
          }
 
          if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
          {
              return response()->json([
                  'status' => 'errors',
                  'status_code' => 403,
                  'msg' => 'credentials does not matched'
              ]);
          }
  
          return $this->respondWithToken($token,$request->email);

      }

      // Get Profile Loyola
      public function profile(Request $request)
      {
        $userId=$request->user_id;

        $validator = Validator::make($request->all(),[
            'user_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 422,
            ]);
        }

         $user = User::find($userId);

          $data[] = array(
                       "name" => $user->name,
                       "email" =>  $user->email,
                       "phone" => $user->phone,
                       "dob" => $user->dob,                             
               );

       return response()->json([
               'status' => 'success',
               'status_code' => 200,
               'msg' => 'user profile fetched successfully',
               'data' => !empty($data)? $data : array(),

       ]);

      }

    // change password
    public function change_password(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'old_password' => 'required',
            'new_password' => 'required|min:8|max:12',
            'confirm_password' => 'required_with:new_password|same:new_password|min:8|max:12'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 'success',
                'status_code' => 422
            ]);
        }
        
        $user_id           = $request->user_id;
        $old_password      = $request->old_password;
        $new_password      = $request->new_password;
        $confirm_password  = $request->confirm_password;
        
        $check=DB::table('users')->where('id',$user_id)->first();
        if(!Hash::check($old_password,$check->password))
        {
            return response()->json([
                'status' => 'success',
                'status_code' => 422,
                'passworderrors' => 'Old Password does not matched',
            ]);        
        }else{            
           
                DB::table('users')->where('id', $user_id)->update(array('password' => Hash::make($new_password)));

                return response()->json([
                    'status' => 'success',
                    'status_code' => 200,
                    'msg' => 'Password changed successfully',
                    'data' => "",
                ]);
              
        }       
    }


    // Get Profile Loyola
    public function updateprofile(Request $request)
    {
      $userId=$request->user_id;

      $validator = Validator::make($request->all(),[
          'user_id' => 'required'
      ]);
      
      if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors(),
              'status' => 422,
          ]);
      }

       $user = User::find($userId);
       if($user){
       $user->name = ucfirst(strtolower($request->name));
       $user->phone = $request->phone;
       $user->dob = $request->dob;
       $user->save();
       }

     return response()->json([
             'status' => 'success',
             'status_code' => 200,
             'msg' => 'User profile changed successfully',
             'data' => !empty($user)? $user : array(),

     ]);

    }


      protected function respondWithToken($token,$email)
      {   
         $userId=auth()->user()->id;
         $userFeedback = UserFeedback::where('user_id',$userId)->orderBy('id','DESC')->first();
         $data = array(
            'fcm_id' => $token,
            'token_type' => 'Bearer',
            'user_Details' => auth()->user(),
            'feedback' =>$userFeedback
            );

        
        $user = User::find($userId);
        if($user){
        $user->fcm_id = $token;
        $user->save();
        }       

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'msg' => 'Logged-in successfully',
            'data' => $data
            ]);

        }
  
      
    //logout---------------
    public function logout(Request $request)
    {       
            $userId=$request->user_id;  
            $user = User::find($userId);
            if($user){
            $user->fcm_id = null;
            $user->save();
            }   
            return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'msg' => 'Users logged out successfully',
            'data' => ""
        ]);
    }




    //forgetpassword ---------------

    public function forgetpassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors(),
              'status' => 422,
          ]);
      }

         $email = $request->email;
         $user = User::where('email', $email)->first();
         if(empty($user)){
             return response()->json([
                 'status' => 'error',
                 'status_code' => 403,
                 'msg' => 'Email Id does not exist'
             ]);
         }

                 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                 $pwd = substr(str_shuffle($chars),0,8);
                 
                 DB::table('users')->where('email', $email)->update(array('password' => Hash::make($pwd)));  
                 Mail::send('mail_template.forgetpassword', ['password' => $pwd,'name' => $user->name], function ($message) use ($email) {
                    $message->to($email)
                      ->subject("Loyola | Password")
                      ->from('noreply@gmail.com');
                });

                 return response()->json([
                     'status' => 'success',
                     'status_code' => 200,
                     'msg' => 'Password has been changed successfully. Please check your email ID : '.$email,
                     'data' => $pwd
                 ]);
        
    }


   public function verifypassword(Request $request)
   {
        $email = $request->email;
        $otp = $request->otp;

        //check if user exists with this email
        $user_id = DB::table('users')->where('email', $email)->orWhere('otp',$otp)->get();
        if($user_id->count() == 0){
            return response()->json([
                'status' => 'error',
                'status_code' => 403,
                'msg' => 'Otp does not match'
            ]);
        }else{
           //update status
           DB::table('users')->where('email', $email)->orWhere('otp',$otp)->update(array('otp' => $otp));  

           return response()->json([
                    'status' => 'success',
                    'status_code' => 200,
                    'msg' => 'New Password Sent Successfully on your Email'
            ]);
        }        
   }

   
   public function resetpassword(Request $request)
   {
        $email = $request->email;
        $otp = $request->otp;

        //check if user exists with this email
        $user_id = DB::table('users')->where('email', $email)->orWhere('mobile_no',$email)->get();

        if($user_id->count() == 0){
            return response()->json([
                'status' => 'error',
                'status_code' => 403,
                'msg' => 'Email or Mobile No. does not exist'
            ]);
        }else{
            //check if otp entered is valid
            $user = User::where('email', '=', $email)->orWhere('mobile_no',"=",$email)->first();

            if(!$user) {
                // handle the case if no user is found
                return response()->json([
                    'status' => 'error',
                    'status_code' => 403,
                    'msg' => 'Email or Mobile No. does not exist'
                ]);
            }else{
                if($user->otp != $otp){
                    return response()->json([
                        'status' => 'error',
                        'status_code' => 403,
                        'msg' => 'Invalid otp'
                    ]);
            }else{
                //update status
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $pwd = substr(str_shuffle($chars),0,10);
                
                DB::table('users')->where('email', $email)->orWhere('mobile_no',"=",$email)->update(array('password' => Hash::make($pwd)));  

                return response()->json([
                    'status' => 'success',
                    'status_code' => 200,
                    'msg' => 'Password reset successfully',
                    'data' => $pwd
                ]);
            }
         }
        }        
   }


}