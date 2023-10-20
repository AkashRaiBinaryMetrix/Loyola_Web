<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SurveyCategory;
use App\Models\Survey;
use App\Models\User;
use App\Models\Notification;
use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionOption;
use File;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;

class SurveyController extends Controller
{

    public function index()
    {
        
      
        
    	$surveyLists=Survey::with('category')->orderBy('id','DESC')->get();
    	return view('admin.survey.index',[
             'surveyLists'=>$surveyLists
            ]);
    }


    public function surveyQuestionLists()
    {
    	$questionLists=SurveyQuestion::with('survey')->orderBy('id','DESC')->get();
        
    	return view('admin.survey.questionlists',[
             'questionLists'=>$questionLists
            ]);
    }

    public function surveyQuestionOptionsLists ()
    {
    	$optionLists=SurveyQuestionOption::with('question')->orderBy('id','DESC')->get();
    	return view('admin.survey.optionlists',[
             'optionLists'=>$optionLists
            ]);
    }


    public function create(Request $request)
    {
            $categoryLists=SurveyCategory::where('status','active')->get();
    	    return view('admin.survey.add',[
                'categoryLists'=>$categoryLists
               ]);
    }

    public function store(Request $request)
    {
       
           $check=Survey::where('heading',$request->heading)->first();
           if($check){
            return redirect('admin/survey')->with('error','Survey Already Exists.');
           }else{

    		$survey= new Survey;
        	$survey->heading=$request->heading ? ucfirst(strtolower($request->heading)) :null;
            $survey->description=$request->description ? ucfirst(strtolower($request->description)) :null;
        	$survey->status=$request->status;
            $survey->category_id=$request->category_id;
            $survey->published_date=$request->published_date;

            if($request->hasFile('image'))
            {
                $path=public_path('/survey/'.$survey->image);
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $name = str_slug($survey->heading).rand(111,999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/survey');
                $fullPathUrl=url('public/survey').'/'.$name;
                $image->move($destinationPath, $name);
                $survey->image=$fullPathUrl;
            }

        	$survey->save();
            if($survey){

        	return redirect('admin/survey')->with('success','Survey added successfully');
            }
        }
    	
    }


    public function edit(Request $request,$id)
    {
    		$survey= Survey::find($id);
            $categoryLists=SurveyCategory::get();
    	    return view('admin.survey.edit',
                [
                    'survey'=>$survey,
                    'categoryLists'=>$categoryLists
                ]);
    }


    public function published(Request $request,$id)
    {

           $checkPublished=SurveyQuestion::where('survey_id',$id)->first();
           if(empty($checkPublished)){
            return redirect('admin/survey')->with('error','Survey will not be published please add question.');
           }

    		$survey= Survey::find($id);
        	$survey->is_published="Yes";
            $survey->save();

            //manage notification 
            $users= User::where('status','active')->where('user_type','user')->get();
            dispatch(new SendEmailJob($users,$survey));
            foreach($users as $user){


                if($user->fcm_id!=''){
                $tittle= "New survey";
                $message= $survey->heading. " has been added.";
                $device_ids =  $user->fcm_id ? $user->fcm_id:null;
                $result=$this->sendNotification($device_ids,$tittle,$message,$id);
                
                $notification= new Notification;
        	    $notification->receiver_id=$user->id;
                $notification->survey_id=$id;
                $notification->message=$message;
                $notification->response=$result;
                $notification->save();

                }
            }

        	return redirect('admin/survey')->with('success','Survey published successfully');
    }
    	

    public function update(Request $request,$id)
    {
    		$survey= Survey::find($id);
        	$survey->heading=$request->heading ? ucfirst(strtolower($request->heading)) :null;
            $survey->description=$request->description ? ucfirst(strtolower($request->description)) :null;
        	$survey->status=$request->status;
            $survey->category_id=$request->category_id;
            $survey->published_date=$request->published_date;

            if($request->hasFile('image'))
            {
                $path=public_path('/survey/'.$survey->image);
                if(File::exists($path))
                {
                    File::delete($path);
                }
               $imgPathName=rand(111,999).str_slug($survey->heading);
               
                $image = $request->file('image');
                $name = $imgPathName.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/survey');
               
                $fullPathUrl=url('public/survey').'/'.$name;
        
                $image->move($destinationPath, $name);
            
                $survey->image=$fullPathUrl;
            }

        	$survey->save();
        	return redirect('admin/survey')->with('success','Survey updated successfully');
    	
    	
    }

    public function delete($id)
    {
    	$id=decrypt($id);
    	$category=Category::where('id',$id)->delete();
        \DB::table('subcategory')->where('cat_id',$id)->delete();
        \DB::table('community')->where('cat_id',$id)->delete();
    	return redirect()->back()->with('success','Category deleted successfully');
    }
    
    public function surveyQuestions(Request $request,$id)
    {
    		$survey= Survey::find($id);
            $questionLists=SurveyQuestion::where('survey_id',$survey->id)->get();
    	    return view('admin.survey.questions',
                [
                    'survey'=>$survey,
                    'questionLists'=>$questionLists
                ]);
    }

    public function saveSurveyQuestions(Request $request)
    {
           $checkPublished=Survey::where('id',$request->survey_id)->where('is_published','Yes')->first();
           if($checkPublished){
            return redirect()->back()->with('error','Survey has been Published. Question not added.');
           }
    		$surveyQuestion= new SurveyQuestion;
        	$surveyQuestion->survey_id=$request->survey_id ? $request->survey_id :null;
            $surveyQuestion->name=$request->name ? ucfirst(strtolower($request->name)) :null;
            $surveyQuestion->type=$request->type ? $request->type :null;
        	$surveyQuestion->save();

            if($surveyQuestion){
                foreach($request->options as $option){
                    if(!empty($option)){
                    $surveyQuestionOption= new SurveyQuestionOption;
        	        $surveyQuestionOption->question_id=$surveyQuestion->id;
                    $surveyQuestionOption->name=ucfirst(strtolower($option));
        	        $surveyQuestionOption->save();
                    }
                }
               
            }

            

        	return redirect()->back()->with('success','Survey Question added successfully');
    	
    }



    public function sendNotification($deviceId,$title,$message,$surveyId){
        $fcmServerKey = env('FCM_SERVER_KEY','');
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = array($deviceId);
        $serverKey = $fcmServerKey;
        $icon="https://binarymetrix-dev.com/loyola/public/images/favicon.png";
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => ucfirst(strtolower($title)),
                "body" => ucfirst(strtolower($message)),
                "survey_id" => $surveyId,
                "icon"=>$icon,
                "type"=> "incoming"  
            ]

        ];
        $encodedData = json_encode($data);
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        curl_close($ch);

        return $result;

}


}
