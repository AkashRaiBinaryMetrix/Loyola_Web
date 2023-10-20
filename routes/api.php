<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SurveyController;
use App\Http\Controllers\API\UserController;


Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();

});


Route::get('survey/category',[SurveyController::class, 'surveyCategory']);
Route::get('survey/list',[SurveyController::class, 'surveyList']);
Route::get('survey/question',[SurveyController::class, 'surveyQuestionList']);
Route::get('user/notification',[SurveyController::class, 'notificationList']);
Route::get('setting',[SurveyController::class, 'settings']);
Route::post('user/savefeedback',[UserController::class, 'saveFeedback']);

Route::post('user/userfeedback',[UserController::class, 'userFeedback']);

Route::post('user/dashboard',[UserController::class, 'dashboard']);
Route::get('user/survey_history',[UserController::class, 'surveyHistoryList']);
Route::post('user/save_survey',[UserController::class, 'saveSurvey']);

//V1 api
Route::post('user/save_survey_v1',[UserController::class, 'saveSurveyV1']);
Route::get('user/survey_history_v1',[UserController::class, 'surveyHistoryListV1']);
Route::post('user/dashboard_v1',[UserController::class, 'dashboardV1']);
Route::get('survey/list_v1',[SurveyController::class, 'surveyListV1']);
Route::get('survey/question_v1',[SurveyController::class, 'surveyQuestionListV1']);
Route::get('survey/question_v2',[SurveyController::class, 'surveyQuestionListV2']);

Route::get('survey/list_v2',[SurveyController::class, 'surveyListV2']);

//user
Route::post('user/signup',[UserController::class, 'signup']);
Route::post('user/login',[UserController::class, 'login']);
Route::post('user/logout',[UserController::class, 'logout']);
Route::post('user/profile',[UserController::class, 'profile']);
Route::post('user/change_password',[UserController::class, 'change_password']);
Route::post('user/updateprofile',[UserController::class, 'updateprofile']);
Route::post('cms/{slug}',[UserController::class, 'cms']);


//survey module 

Route::post('user/send_verify_email',[UserController::class, 'send_verify_email']);
Route::post('user/patient_resendotp',[UserController::class, 'patient_resendotp']);
Route::post('user/emailsend',[UserController::class, 'emailsend']);

Route::post('user/forgetpassword',[UserController::class, 'forgetpassword']);
Route::post('user/verifyotp',[UserController::class, 'verifyotp']);
Route::post('user/verifypassword',[UserController::class, 'verifypassword']);

Route::post('user/forgotpassword',[UserController::class, 'forgotpassword']);
Route::post('user/resetpassword',[UserController::class, 'resetpassword']);



