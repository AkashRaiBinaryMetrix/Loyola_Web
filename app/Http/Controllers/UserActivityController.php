<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPost;
use DB;
use Sesssion;

class UserActivityController extends Controller
{
    public function user_activity(Request $request)
    {
    	$posts2=DB::table('user_activity')
    		   ->leftjoin('user_posts','user_posts.id','user_activity.post_id')
    		   ->leftjoin('community','community.id','user_posts.community_id')
    		   ->leftjoin('users','users.id','user_posts.user_id')
    		   ->leftjoin('posts_likes','posts_likes.post_id','user_activity.like_id')
    		   ->leftjoin('user_comments','user_comments.post_id','user_activity.comment_id')
               ->where('user_posts.user_id',\Session::get('user')->id)
               ->where('user_activity.user_id',\Session::get('user')->id)
    		   ->select('user_activity.*','users.name as username','posts_likes.like','user_comments.comment','user_activity.created_at as postdate','community.title as community','user_posts.media','user_posts.post','user_posts.title as posttitle','user_posts.slug','user_posts.id as postid','community.image as commimage')
    		   ->groupBy('user_activity.id')
               ->orderBy('user_activity.id','DESC')
    	       ->get()
               ->toArray();
        $posts1= DB::table('user_activity')
               ->leftjoin('community','community.id','user_activity.post_id')
               ->leftjoin('community_join','community.id','community_join.community_id')
               ->leftjoin('users','users.id','community_join.user_id')
               ->where('community_join.user_id',\Session::get('user')->id)
               ->where('user_activity.user_id',\Session::get('user')->id)
               ->select('user_activity.*','users.name as username','community.title as community','community.image as commimage','user_activity.created_at as postdate')
               ->groupBy('user_activity.id')
               ->orderBy('user_activity.id','DESC')
               ->get()
               ->toArray();   
        $posts=array_merge($posts1,$posts2);
       
    	return view('user.user_activity',['posts'=>$posts]);
    }
}
