<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Community;
use App\Models\Survey;
use App\Models\SurveyCategory;
use App\Models\UserFeedback;
use Str;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $totalUsers=User::where('user_type','user')->count();
        $totalCategory=SurveyCategory::count();
        $totalSurvey=Survey::count();
        $totalFeedbacks=UserFeedback::count();
        return view('admin.dashboard',[
            'totalUsers'=>$totalUsers,
            'totalCategory'=>$totalCategory,
            'totalSurvey'=>$totalSurvey,
            'totalFeedbacks'=>$totalFeedbacks
        ]);
    }
}

