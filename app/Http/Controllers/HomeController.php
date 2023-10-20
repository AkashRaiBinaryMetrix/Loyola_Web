<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\UserPost;
use App\Models\Community;
use App\Models\Comment;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user=Session::get('user');
         

        return view('user.user_login')->with(['user'=>$user]);
    }

    public function getcategoryresult(Request $request){
        $continentId = $request->continentId;

          $html ="";

          //get all users list
          $categoryData = \DB::table('category')->where([['status',1],['continent_id',$continentId]])->get();

          $html .='<label data-error="wrong" data-success="right" for="form8" style="margin-top: 8px;">Select Category</label><select class="form-control" name="category_res" id="category_res" required="" onchange="displaySubCategoryRes();" style="margin-bottom: 12px;"><option value="">Select Category</option>';
          
          if(count($categoryData) == 0){
               $html .='<option value="">No Data Found</option>';
          }else{
              foreach($categoryData as $categoryDataResult){
                    $html .='<option value="'.$categoryDataResult->title.'">'.$categoryDataResult->title.'</option>';
              }  
          }
          
          $html .="</select>";

          echo $html;
    }

    public function logincheck(Request $request)
    {
        if($request->isMethod('post'))
        {
            if(empty(\Session::get('user')))
            {
                $res['status']='true';
                return $res;
            }else
            {
                $res['status']='false';
                return $res;
            }
        }else
        {
            $user=Session::get('user');
        $userpost=UserPost::
                 leftjoin('users','users.id','user_posts.user_id')
                 ->leftjoin('community','community.id','user_posts.community_id')
                 ->select('user_posts.*','users.name as username','users.email as useremail','community.title as community')
                 ->orderBy('id','Desc')
                 ->get();
         if(!empty($user))   
         {
            $mycommunity=\DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->where('community_join.user_id',$user->id)
                      ->where('community_join.status',1)
                      ->groupBy('community.id')
                      ->take(6)
                      ->get(); 
        }else
        {
            $mycommunity=\DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->groupBy('community.id')
                      ->take(6)
                      ->get(); 
        }  
        $trending= \DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->groupBy('community.id')
                      ->get();  
        $category=\DB::table('category')->take(6)->get();
         $poll=\DB::table('admin_poll')->where('status',1)->first();
         $poll_option= json_decode($poll->poll_options);
         $extension=explode('.',$poll->media);  
         $totalvotes=\DB::table('admin_poll_votes')->where('poll_id',$poll->id)->count();
         $category=\DB::table('category')->where('continent',1)->get(); 
         $url=$request->path();      
            return view('user.layout.authcheck')->with(['user'=>$user,'userpost'=>$userpost,'mycommunity'=>$mycommunity,'category'=>$category,'poll'=>$poll,'poll_option'=>$poll_option,'extension'=>$extension,'totalvotes'=>$totalvotes,'categoryall'=>$category,'url'=>$url,'trending'=>$trending]);
        }
        
    }

    public function searchnews(Request $request)
    {
        
        $user=Session::get('user');
        
        if($request->name)
        {
            $userpost=UserPost::
                     leftjoin('users','users.id','user_posts.user_id')
                    ->leftjoin('community','community.id','user_posts.community_id')
                    ->select('user_posts.*','users.name as username','users.email as useremail','community.title as community','community.image')
                    ->orWhere('user_posts.title', 'LIKE', "%{$request->name}%")
                    ->orWhere('user_posts.post', 'LIKE', "%{$request->name}%")
                    ->orWhere('user_posts.slug', 'LIKE', "%{$request->name}%")
                    ->orWhere('user_posts.question', 'LIKE', "%{$request->name}%")
                    ->get();
            $usercommunty=\DB::table('community')
                         ->orWhere('title', 'LIKE', "%{$request->name}%")
                         ->orWhere('description', 'LIKE', "%{$request->name}%")
                         ->get();        
        }else
        {
            $userpost=[];
            $usercommunty=[];
        }    
        if($request->isMethod('post'))
        {
                $res['post']=count($userpost);
                $res['community']=count($usercommunty);
                return $res;
        }else
        {
            return view('user.search_result')->with(['user'=>$user,'userpost'=>$userpost,'usercommunty'=>$usercommunty]);
        }
        
        
    }

    public function report(Request $request)
    {
        if(empty(\Session::get('user')))
            {
                $res['status']='false';
                return $res;
            }else
            {
                $res['status']='true';
                return $res;
            }
    }

    public function trending(Request $request)
    {
        
        $user=Session::get('user');
        $userpost=UserPost::
                 leftjoin('user_comments','user_comments.post_id','user_posts.id')
                 ->leftjoin('users','users.id','user_posts.user_id')
                 ->leftjoin('community','community.id','user_posts.community_id')
                 ->leftjoin('user_detail','user_detail.user_id','user_posts.user_id')
                 ->select('user_posts.*','users.name as username','users.email as useremail','community.title as community','user_detail.image as userimg',\DB::raw('count(user_comments.post_id) as post_count'))
                 ->groupBy('user_comments.post_id')
                 ->orderBy('user_posts.id','DESC')
                 ->get();

         if(!empty($user))   
         {
            $mycommunity=\DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->where('community_join.user_id',$user->id)
                      ->where('community_join.status',1)
                      ->groupBy('community.id')
                      ->take(6)
                      ->get(); 
        }else
        {
            $mycommunity=\DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->groupBy('community.id')
                      ->take(6)
                      ->get(); 
        }  
        $trending= \DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->groupBy('community.id')
                      ->get();  
        $categoryall=\DB::table('category')->take(6)->get();
         $poll=\DB::table('admin_poll')->where('status',1)->first();
         $poll_option= json_decode($poll->poll_options);
         $extension=explode('.',$poll->media);  
         $totalvotes=\DB::table('admin_poll_votes')->where('poll_id',$poll->id)->count();
         $category=\DB::table('category')->where('continent',1)->get(); 
         $url=$request->path();   
        return view('user.user_login')->with(['user'=>$user,'userpost'=>$userpost,'mycommunity'=>$mycommunity,'category'=>$categoryall,'poll'=>$poll,'poll_option'=>$poll_option,'extension'=>$extension,'totalvotes'=>$totalvotes,'categoryall'=>$category,'url'=>$url,'trending'=>$trending]);         
      
        
    }

    public function community_post(Request $request,$community)
    {
        $user=Session::get('user');
        $communityid=Community::where('title',$community)->first();
        $userpost=UserPost::
                 leftjoin('user_comments','user_comments.post_id','user_posts.id')
                 ->leftjoin('users','users.id','user_posts.user_id')
                 ->leftjoin('community','community.id','user_posts.community_id')
                 ->leftjoin('user_detail','user_detail.user_id','user_posts.user_id')
                 ->select('user_posts.*','users.name as username','users.email as useremail','community.title as community','user_detail.image as userimg')
                 ->where('user_posts.community_id',$communityid->id)
                 ->groupBy('user_comments.post_id')
                 ->orderBy('user_posts.id','DESC')
                 ->get();

         if(!empty($user))   
         {
            $mycommunity=\DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->where('community_join.user_id',$user->id)
                      ->where('community_join.status',1)
                      ->groupBy('community.id')
                      ->take(6)
                      ->get(); 
        }else
        {
            $mycommunity=\DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->groupBy('community.id')
                      ->take(6)
                      ->get(); 
        }  
        $trending= \DB::table('community')
                     ->leftjoin('community_join','community.id','community_join.community_id')
                      ->groupBy('community.id')
                      ->get();  
        $categoryall=\DB::table('category')->take(6)->get();
         $poll=\DB::table('admin_poll')->where('status',1)->first();
         $poll_option= json_decode($poll->poll_options);
         $extension=explode('.',$poll->media);  
         $totalvotes=\DB::table('admin_poll_votes')->where('poll_id',$poll->id)->count();
         $category=\DB::table('category')->where('continent',1)->get(); 
         $url=$request->path();   
        return view('user.user_login')->with(['user'=>$user,'userpost'=>$userpost,'mycommunity'=>$mycommunity,'category'=>$categoryall,'poll'=>$poll,'poll_option'=>$poll_option,'extension'=>$extension,'totalvotes'=>$totalvotes,'categoryall'=>$category,'url'=>$url,'trending'=>$trending]);

    }

    public function userip(Request $request)
    {
        $ip = $request->ip();
        $currentUserInfo = Location::get($ip);
        dd($currentUserInfo);
    }
}
