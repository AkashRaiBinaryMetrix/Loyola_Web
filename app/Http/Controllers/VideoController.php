<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
	public function video(Request $request)
	{
		
        $user=\Session::get('user');
        $videos=\DB::table('videos')->get();
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
        $categoryall=\DB::table('category')->take(6)->get();
         $poll=\DB::table('admin_poll')->where('status',1)->first();
         $poll_option= json_decode($poll->poll_options);
         $extension=explode('.',$poll->media);  
         $totalvotes=\DB::table('admin_poll_votes')->where('poll_id',$poll->id)->count();
         $category=\DB::table('category')->where('continent',1)->get(); 
         $url=$request->path();     
        return view('user.user_videos')->with(['user'=>$user,'videos'=>$videos,'mycommunity'=>$mycommunity,'category'=>$categoryall,'poll'=>$poll,'poll_option'=>$poll_option,'extension'=>$extension,'totalvotes'=>$totalvotes,'categoryall'=>$category,'url'=>$url]);
        }
}
