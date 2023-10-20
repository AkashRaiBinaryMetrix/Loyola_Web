<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Comment;
use App\Models\UserPost;
use File;

class CommentController extends Controller
{
    public function comment_like(Request $request)
    {

    	if(empty(\Session::get('user')))
    	{
    		$res['status']='false';
    		return $res;
    	}
    	$checkcomment=\DB::table('comments_like')->where('comment_id',$request->commentid)->where('user_id',\Session::get('user')->id)->first();
    	if(empty($checkcomment))
    	{
    		$comment['community_id']=$request->communityid;
	    	$comment['post_id']=$request->postid;
	    	$comment['comment_id']=$request->commentid;
	    	$comment['user_id']=\Session::get('user')->id;
	    	$comment['like']=$request->status;
	    	$comment['created_at']=\Carbon\Carbon::now();
	    	$comment['updated_at']=\Carbon\Carbon::now();
	    	\DB::table('comments_like')->insert($comment);
    	}else
    	{
    		$comment['community_id']=$request->communityid;
	    	$comment['post_id']=$request->postid;
	    	$comment['comment_id']=$request->commentid;
	    	// $comment['sub_comm_id']=$request->reply_id;
	    	$comment['user_id']=\Session::get('user')->id;
	    	$comment['like']=$request->status;
	    	$comment['updated_at']=\Carbon\Carbon::now();
	    	\DB::table('comments_like')->where('comment_id',$request->commentid)->where('user_id',\Session::get('user')->id)->update($comment);
    	}
    	
    	$totalcommlike=\DB::table('comments_like')->where('comment_id',$request->commentid)->where('like',1)->count();
    	$res['status']='true';
    	$res['like']=$totalcommlike;
    	return $res;
    }

    public function comment_report(Request $request)
    {
    	$checkreport=DB::table('comment_report')->where('comment_id',$request->comment_id)->where('user_id',Session::get('user')->id)->first();
    	// dd($checkreport);
    	if(empty($checkreport))
    	{

    		$report['community_id']=$request->community_id;
	    	$report['post_id']=$request->post_id;
	    	$report['comment_id']=$request->comment_id;
	    	$report['user_id']=\Session::get('user')->id;
	    	$report['report']=$request->comment_report;
	    	$report['created_at']=\Carbon\Carbon::now();
	    	$report['updated_at']=\Carbon\Carbon::now();
	    	DB::table('comment_report')->insert($report);
    	}else
    	{
    		$report['community_id']=$request->community_id;
	    	$report['post_id']=$request->post_id;
	    	$report['comment_id']=$request->comment_id;
	    	$report['user_id']=\Session::get('user')->id;
	    	$report['report']=$request->comment_report;
	    	$report['updated_at']=\Carbon\Carbon::now();
	    	DB::table('comment_report')->where('comment_id',$request->comment_id)->where('user_id',Session::get('user')->id)->update($report);
    	}
    	
    	$res['status']='true';
    	return $res;
    }

    public function commentreply(Request $request)
    {
    	$checkuser=Session::get('user');
    	if(empty($checkuser))
    	{
    		return response()->json(['status'=>'false']);
    	}
    	$reply['community_id']=$request->community_id;
    	$reply['post_id']=$request->post_id;
    	$reply['comment_id']=$request->comment_id;
    	$reply['user_id']=\Session::get('user')->id;
    	$reply['reply']=strip_tags($request->reply);
    	$reply['created_at']=\Carbon\Carbon::now();
    	$reply['updated_at']=\Carbon\Carbon::now();
    	$replycom=DB::table('comment_reply')->insertGetId($reply);
    	$replyres=DB::table('comment_reply')
    			  ->leftjoin('users','users.id','comment_reply.user_id')
    			  ->leftjoin('user_detail','user_detail.user_id','users.id')
    			  ->leftjoin('community','community.id','comment_reply.community_id')
    			  ->select('user_detail.image','users.name as username','comment_reply.*')
    			  ->where('comment_reply.id',$replycom)
    			  ->first();
        if(!empty($replyres->image))
        {
           $userimage=$replyres->image; 
        }else
        {
            $userimage=null;
        }
        $details=DB::table('comment_reply')->where('id',$replycom)->first();	
        $time=\Carbon\Carbon::parse($details->created_at)->diffForhumans();	
        $name=$replyres->username;
        $userreply=$replyres->reply;	  
    	$res['status']='true';
    	$res['image']=$userimage;
    	$res['time']=$time;
    	$res['name']=$name;
    	$res['reply']=$userreply;
    	return $res;
    }

    public function sub_comment_like(Request $request)
    {

    	if(empty(\Session::get('user')))
    	{
    		$res['status']='false';
    		return $res;
    	}
    	$checkcomment=\DB::table('sub_comment_like')->where('comment_id',$request->commentid)->where('reply_id',$request->reply_id)->where('user_id',\Session::get('user')->id)->first();
    	if(empty($checkcomment))
    	{
    		$comment['community_id']=$request->communityid;
	    	$comment['post_id']=$request->postid;
	    	$comment['comment_id']=$request->commentid;
	    	$comment['user_id']=\Session::get('user')->id;
	    	$comment['like']=$request->status;
	    	$comment['reply_id']=$request->reply_id;
	    	$comment['created_at']=\Carbon\Carbon::now();
	    	$comment['updated_at']=\Carbon\Carbon::now();
	    	\DB::table('sub_comment_like')->insert($comment);
    	}else
    	{
    		$comment['community_id']=$request->communityid;
	    	$comment['post_id']=$request->postid;
	    	$comment['comment_id']=$request->commentid;
	    	$comment['reply_id']=$request->reply_id;
	    	$comment['user_id']=\Session::get('user')->id;
	    	$comment['like']=$request->status;
	    	$comment['updated_at']=\Carbon\Carbon::now();
	    	\DB::table('sub_comment_like')->where('comment_id',$request->commentid)->where('user_id',\Session::get('user')->id)->where('reply_id',$request->reply_id)->update($comment);
    	}
    	
    	$totalcommlike=\DB::table('sub_comment_like')->where('comment_id',$request->commentid)->where('reply_id',$request->reply_id)->where('like',1)->count();
    	$res['status']='true';
    	$res['like']=$totalcommlike;
    	return $res;
    }

    public function sub_comment_reply(Request $request)
    {
    	if(empty(\Session::get('user')))
    	{
    		$res['status']='false';
    		return $res;
    	}
    	$checkcomment=\DB::table('sub_comment_reply')->where('comment_id',$request->commentid)->where('reply_id',$request->reply_id)->where('user_id',\Session::get('user')->id)->first();
    	
    		$comment['community_id']=$request->community_id;
	    	$comment['post_id']=$request->post_id;
	    	$comment['comment_id']=$request->comment_id;
	    	$comment['user_id']=\Session::get('user')->id;
	    	$comment['reply']=strip_tags($request->reply);
	    	$comment['reply_id']=$request->replyid;
	    	$comment['created_at']=\Carbon\Carbon::now();
	    	$comment['updated_at']=\Carbon\Carbon::now();
	    	$replycom=DB::table('sub_comment_reply')->insertGetId($comment);
	    	$replyres=DB::table('sub_comment_reply')
	    			  ->leftjoin('users','users.id','sub_comment_reply.user_id')
	    			  ->leftjoin('user_detail','user_detail.user_id','users.id')
	    			  ->leftjoin('community','community.id','sub_comment_reply.community_id')
	    			  ->select('user_detail.image','users.name as username','sub_comment_reply.*')
	    			  ->where('sub_comment_reply.id',$replycom)
	    			  ->first();
	        if(!empty($replyres->image))
	        {
	           $userimage=$replyres->image; 
	        }else
	        {
	            $userimage=null;
	        }
	        $details=DB::table('sub_comment_reply')->where('id',$replycom)->first();	
	        $time=\Carbon\Carbon::parse($details->created_at)->diffForhumans();	
	        $name=$replyres->username;
	        $userreply=$replyres->reply;	  
	    	$res['status']='true';
	    	$res['image']=$userimage;
	    	$res['time']=$time;
	    	$res['name']=$name;
	    	$res['reply']=$userreply;
	    	return $res;
	    	
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $user=\Session::get('user');
           if(!empty($request->media))
            {
                $folderPath = public_path().'/comment/';
                 if (! File::exists($folderPath))
                    {
                        File::makeDirectory($originalPath, 0777, true, true);
                    }
                $rand=rand(1111,9999);
                $base64Image = explode(";base64,", $request->media);
                if($request->imagetype=='image')
                {
                    $explodeImage = explode("image/", $base64Image[0]);
                    $imageType = $explodeImage[1];
                    $image_base64 = base64_decode($base64Image[1]);
                }else
                {
                    $imageType = 'mp4';
                    $image_base64 = base64_decode($base64Image[1]);
                }
                
                
                $name= 'comments'.'-'.$rand.'.'.$imageType;
                $file = $folderPath . $name;
                file_put_contents($file, $image_base64);
                $comment->media=$name;
            }
        if($request->hasFile('media'))
        {
            $image = $request->file('media');
            $bytes=$request->file('media')->getSize();
            if ($bytes >= 1073741824)
            {
                $bytes = number_format($bytes / 1073741824, 2) . 'GB';
            }
            elseif ($bytes >= 1048576)
            {
                $bytes = number_format($bytes / 1048576, 2) . 'MB';
            }
            elseif ($bytes >= 1024)
            {
                $bytes = number_format($bytes / 1024, 2) . 'KB';
            }
            elseif ($bytes > 1)
            {
                $bytes = $bytes . 'bytes';
            }
            elseif ($bytes == 1)
            {
                $bytes = $bytes . 'byte';
            }
            else
            {
                $bytes = '0bytes';
            }
            
            if($bytes=='MB' && $bytes>'3MB')
            {
                return redirect()->back()->with('error','File Size too large');
                // return 2;
            }
            $rand=rand(1111,9999);
            $name = 'comments'.'-'.$rand.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/comment');
            $image->move($destinationPath, $name,75);
            $comment->media=$name;
        }
        $comment->community_id = $request->community_id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->title = $request->title;
        $comment->user()->associate($user->id);
        $post = UserPost::find($request->get('post_id'));
        $check=$post->comments()->save($comment);

        $userpost=UserPost::where('id',$request->post_id)->first();
        $username=DB::table('users')->where('id',$user->id)->first();
        $userimg=DB::table('user_detail')->where('user_id',$user->id)->first();
        if($userpost->user_id!=$user->id)
        {
          DB::table('user_notification')->insert(['post_id'=>$request->post_id,'user_id'=>$userpost->user_id,'tagged_user'=>$user->id,'status'=>$username->name.' commented on your post','created_at'=>\Carbon\Carbon::now(),'user_image'=>$userimg->image ?? '']);
        }

        $userpost=UserPost::leftjoin('users','users.id','user_posts.user_id')->where('user_posts.id',$request->post_id)->select('user_posts.*','users.name as username')->first();
                if($userpost->user_id==$user->id)
                {
                    $users='your';
                }else
                {
                    $users=$userpost->username."'s";
                }
        $activity['post_id']=$request->post_id;
        $activity['comment_id']=$check->id;
        $activity['type']='post';
        $activity['user_id']=\Session::get('user')->id;
        $activity['status']='You commented on '.$users.' post';
        $activity['created_at']=\Carbon\Carbon::now();
        $activity['updated_at']=\Carbon\Carbon::now();
        DB::table('user_activity')->insert($activity);

        $details=DB::table('user_comments')->where('id',$check->id)->first();
        // $time=$details->created_at->diffForHumans();
        $time=\Carbon\Carbon::parse($details->created_at)->diffForhumans();
        if(!empty($user))
        {
           $userimg=DB::table('user_detail')->where('user_id',$user->id)->first(); 
            // $userimage=public_path('/user/images/'.$userimg);
        }
        if(!empty($userimg))
        {
           $userimage=$userimg->image; 
        }else
        {
            $userimage=null;
        }
        if(!empty($request->comment))
        {
            $comment=strip_tags($request->comment);
            $title='';
        }else if(!empty($request->media))
        {
            $comment=$name;
            $title=$request->title;
        }
       if($check)
       {
        $res['comment']=$comment;
        $res['community_id']=$request->community_id;
        $res['post_id']=$request->post_id;
        $res['comment_id']=$check->id;
        $res['title']=$title;
        $res['status']=1;
        $res['time']=$time;
        $res['name']=$user->name;
        $res['image']=$userimage;
        return $res; 
       }
        return back();
    }

    public function replyStore(Request $request)
    {
    	// dd($request->all());
        $checkcomm=Comment::where('post_id',$request->post_id)->where('id',$request->comment_id)->whereNull('parent_id')->first();
        if(!empty($checkcomm))
        {
            $maincommid=$checkcomm->id;
        }else
        {
            $mainid=Comment::where('post_id',$request->post_id)->where('id',$request->comment_id)->whereNotNull('parent_id')->first();
            $maincommid=$mainid->main_comment_id;
        }
        // dd($checkcomm,$request->comment_id,$maincommid);
    	$user = \Session::get('user');
        $reply = new Comment();
        $reply->comment = $request->comment;
        $reply->community_id = $request->community_id;
        $reply->post_id = $request->post_id;
        $reply->user()->associate($user->id);
        $reply->parent_id = $request->comment_id;
        $reply->main_comment_id = $maincommid ?? '';
        // dd($reply);
        $post = UserPost::find($request->post_id);
        // dd($post);
        $check=$post->comments()->save($reply);
        $userpost=UserPost::where('id',$request->post_id)->first();
        $username=DB::table('users')->where('id',$user->id)->first();
        $userimg=DB::table('user_detail')->where('user_id',$user->id)->first();
        if($userpost->user_id!=$user->id)
        {
          DB::table('user_notification')->insert(['post_id'=>$request->post_id,'user_id'=>$userpost->user_id,'tagged_user'=>$user->id,'status'=>$username->name.' replied on your comment','created_at'=>\Carbon\Carbon::now(),'user_image'=>$userimg->image ?? '']);
        }
        $userpost=UserPost::leftjoin('users','users.id','user_posts.user_id')->where('user_posts.id',$request->post_id)->select('user_posts.*','users.name as username')->first();
        if($userpost->user_id==$user->id)
        {
            $users='your';
        }else
        {
            $users=$userpost->username."'s";
        }
        $activity['post_id']=$request->post_id;
        $activity['type']='post';
        $activity['comment_id']=$check->id;
        $activity['user_id']=\Session::get('user')->id;
        $activity['status']='You replied on '.$users.' post';
        $activity['created_at']=\Carbon\Carbon::now();
        $activity['updated_at']=\Carbon\Carbon::now();
        DB::table('user_activity')->insert($activity);

        $details=DB::table('user_comments')->where('id',$check->id)->first();
        // $time=$details->created_at->diffForHumans();
        $time=\Carbon\Carbon::parse($details->created_at)->diffForhumans();
        if(!empty($user))
        {
           $userimg=DB::table('user_detail')->where('user_id',$user->id)->first(); 
            // $userimage=public_path('/user/images/'.$userimg);
        }
        if(!empty($userimg))
        {
           $userimage=$userimg->image; 
        }else
        {
            $userimage=null;
        }
        
            $comment=strip_tags($request->comment);
            
        $res['comment']=$comment;
        $res['community_id']=$request->community_id;
        $res['post_id']=$request->post_id;
        $res['comment_id']=$check->id;
        $res['status']='true';
        $res['time']=$time;
        $res['name']=$user->name;
        $res['image']=$userimage;
        return $res;
        // return back();
    }
}
