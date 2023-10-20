<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurveyCategory;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\Notification;
use App\Models\UserSurveyHistory;
use App\Models\UserQuestionAnswer;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use File;
use DB;

class SurveyController extends Controller
{
 
   //surver category lists
   public function surveyCategory(Request $request)
    {
          $categoryLists = SurveyCategory::whereStatus('active')->orderBy('id','DESC')->get();
          foreach($categoryLists as $result){
               $data[] = array(
                           "id"        => $result->id,
                           "name"      => $result->name,
                           "image"     => url('public/category').'/'.$result->image,            
               );
            }
          return response()->json([
                  'status' => 'success',
                  'status_code' => 200,
                  'msg' => 'Record fetched successfully',
                  'data' => !empty($data)? $data : array(),
 
          ]);
    }

   // //surver lists
   // public function surveyList(Request $request)
   // {
   //       $type= $request->type? $request->type:'new';

   //       $surveyLists = Survey::with('category')->where('status','active');

   //       if($type=='new'){
   //          $surveyLists= $surveyLists->where('status','active');
   //       }else{
   //          $surveyLists= $surveyLists->where('status','active');
   //       }

   //       $surveyLists=$surveyLists->get();

   //       return response()->json([
   //               'status' => 'success',
   //               'status_code' => 200,
   //               'msg' => 'Record fetched successfully',
   //               'data' => !empty($surveyLists)? $surveyLists : array(),

   //       ]);
   // }

   // //surver lists v1
   // public function surveyListV1(Request $request)
   // {
       
   //       $type= $request->type? $request->type:'new';

   //       $surveyLists = Survey::with('category')
   //          ->where('status','active')
   //          ->where('is_published','Yes');
            
   //       if($request->category_id){
   //          $surveyLists= $surveyLists->whereDate('published_date', '<', date('Y-m-d'))
   //          ->where('category_id',$request->category_id);
   //       }

   //       if($type=='new'){
          
   //          $surveyLists= $surveyLists->whereDate('published_date', '<', date('Y-m-d'))->OrderBy('id','DESC');
   //       }

   //       if($type=='upcoming'){
   //          $surveyLists= $surveyLists->whereDate('published_date', '>=', date('Y-m-d'))->OrderBy('id','DESC');
   //       }
         
   //       $surveyLists=$surveyLists->get();

   //       return response()->json([
   //               'status' => 'success',
   //               'status_code' => 200,
   //               'msg' => 'Record fetched successfully',
   //               'data' => !empty($surveyLists)? $surveyLists : array(),

   //       ]);
   // }

   //surver lists v1
   public function surveyListV2(Request $request)
   {

         $validator = Validator::make($request->all(),[
            'user_id' => 'required'
         ]);

         if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 422,
            ]);
        }

         $userId= $request->user_id;
         $type= $request->type? $request->type:'new';
         // $ComplatedSurveyId = UserSurveyHistory::where('status','completed')
         //    ->whereUserId($userId)
         //    ->pluck('survey_id')
         //    ->toarray();

         $ComplatedSurveyId = UserSurveyHistory::whereUserId($userId)->pluck('survey_id')->toarray();
      
         $surveyLists = Survey::with('category')
            ->where('status','active')
            ->where('is_published','Yes')
            ->whereNotIn('id',$ComplatedSurveyId);
            
         if($request->category_id){
            $surveyLists= $surveyLists->whereDate('published_date', '<=', date('Y-m-d'))->where('category_id',$request->category_id);
         }

         if($type=='new'){
            $surveyLists= $surveyLists->whereDate('published_date', '<=', date('Y-m-d'))->OrderBy('id','DESC');
         }

         if($type=='upcoming'){
            $surveyLists= $surveyLists->whereDate('published_date', '>', date('Y-m-d'))->OrderBy('id','DESC');
         }
         
         $surveyLists=$surveyLists->get();

         return response()->json([
                 'status' => 'success',
                 'status_code' => 200,
                 'msg' => 'Record fetched successfully',
                 'data' => !empty($surveyLists)? $surveyLists : array(),

         ]);
   }


    //surver question lists
    public function surveyQuestionList(Request $request)
    {
          $id= $request->survey_id? $request->survey_id:'new';
 
          $surveyQuestionLists = SurveyQuestion::with('option')
             ->where('status','active')
             ->where('survey_id',$id)
             ->get();

 
          return response()->json([
                  'status' => 'success',
                  'status_code' => 200,
                  'msg' => 'Record fetched successfully',
                  'data' => !empty($surveyQuestionLists)? $surveyQuestionLists : array(),
 
          ]);
    }
    
     //surver question lists V1
     public function surveyQuestionListV1(Request $request)
     {
      $userId=$request->user_id;
      $serveyId=$request->survey_id;

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'survey_id' => 'required'
        ]);
        
      //   $categoryCheck = UserSurveyHistory::whereUserId($userId)
      //   ->where('survey_id',$serveyId)
      //   ->where('status','completed')
      //   ->first();
      //   if( $categoryCheck){
      //          return response()->json([
      //             'status' => 'error',
      //             'status_code' => 403,
      //             'msg' => 'This survey already submited.'
      //          ]);
      //    }
  
           $surveyQuestionLists = SurveyQuestion::with('option')
              ->where('status','active')
              ->where('survey_id',$serveyId)
              ->get();

           
           return response()->json([
                   'status' => 'success',
                   'status_code' => 200,
                   'msg' => 'Record fetched successfully',
                   'data' => !empty($surveyQuestionLists)? $surveyQuestionLists : array(),
  
           ]);
     }


     public function surveyQuestionListV2(Request $request)
     {
      $userId=$request->user_id;
      $surveyId=$request->survey_id;

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'survey_id' => 'required'
        ]);

        if ($validator->fails()) {
         return response()->json([
             'errors' => $validator->errors(),
             'status' => 422,
         ]);
     }
        
      //   $categoryCheck = UserSurveyHistory::whereUserId($userId)
      //   ->where('survey_id',$surveyId)
      //   ->where('status','completed')
      //   ->first();
      //   if( $categoryCheck){
      //          return response()->json([
      //             'status' => 'error',
      //             'status_code' => 403,
      //             'msg' => 'This survey already submited.'
      //          ]);
      //    }
  
           $surveyQuestionLists = SurveyQuestion::with('option')
              ->where('status','active')
              ->where('survey_id',$surveyId)
              ->get();

              foreach($surveyQuestionLists as $surveyQuestionList){

                  if($surveyQuestionList->option){
                     $options=array();
                     foreach($surveyQuestionList->option as $option){
                     
                     
                     
                        $options[]=array(
                           'question_id'=>$option->question_id,
                           'id'=>$option->id,
                           'name'=>$option->name
                        );
                     }
                  }

                  $userAnswer=UserQuestionAnswer::select('question_option_ids','input','type','question_option_array_ids')
                        ->whereUserId($userId)
                        ->where('survey_id',$surveyId)
                        ->where('question_id',$surveyQuestionList->id)
                        ->first();
                        
                  $array=[];
                  
                  
                  if($userAnswer){
                     if($userAnswer->type=='checkbox'){
                        $array = explode(',', $userAnswer->question_option_ids);
                     }else{
                        $array = $array;
                     }
                     $userAnswer =  array('question_option_ids'=>$userAnswer->question_option_ids,'type'=>$userAnswer->type,'input'=>$userAnswer->input,'question_option_array_ids'=>$array);
                  }else{
                     $userAnswer=array('question_option_ids'=>null,'type'=>null,'input'=>null,'question_option_array_ids'=>null);
                  }

               $questions[]=array(
                   'id'=>$surveyQuestionList->id,
                   'name'=>$surveyQuestionList->name,
                   'type'=>$surveyQuestionList->type,
                   'created_at'=>$surveyQuestionList->created_at,
                   'option'=>$options ? $options :array(),
                   'user_answer'=>$userAnswer ? $userAnswer :null
                  );
            }
 
  
           return response()->json([
                   'status' => 'success',
                   'status_code' => 200,
                   'msg' => 'Question fetched successfully',
                   'data' => !empty($questions)? $questions : array(),
  
           ]);
     }

    //surver category lists
   public function notificationList(Request $request)
   {
         $userId=$request->user_id;
         $notificationLists =Notification::where('receiver_id',$userId)->get();
      
         return response()->json([
                 'status' => 'success',
                 'status_code' => 200,
                 'msg' => 'Record fetched successfully',
                 'data' => !empty($notificationLists)? $notificationLists : array(),

         ]);
   }

   //setting lists
   public function settings(Request $request)
   {
      
         $type=array('Overall Service','Customer Support','Speed and Efficiency','Repair Quality','Transperancy');
         $settingTypes =array('feedback_type'=>$type);
         
         return response()->json([
                 'status' => 'success',
                 'status_code' => 200,
                 'msg' => 'Record fetched successfully',
                 'data' => !empty($settingTypes)? $settingTypes : array(),

         ]);
   }




  

}