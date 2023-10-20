<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\UserPost;
use File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function add(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validated = $request->validate([
            'community_id' => 'required|',
            'title' => 'required|',
        ]);
            
            $community=new Post;
            $community->title=$request->title;
            $community->description=$request->description;
            $community->community_id=$request->community_id;
            $community->created_at=\Carbon\Carbon::now();
            $community->updated_at=\Carbon\Carbon::now();
            if($request->hasFile('image'))
            {
                $fileextension=$request->file('image')->getClientOriginalExtension();
                
                    $originalImage= $request->file('image');
                    $thumbnailImage = Image::make($originalImage);
                    $thumbnailPath = public_path().'/post_image/';
                    if (! File::exists($thumbnailPath))
                    {
                        File::makeDirectory($thumbnailPath, 0777, true, true);
                    }
                    $rand=rand(1111,9999);
                    $originalPath = public_path().'/post/';
                    if (! File::exists($originalPath))
                    {
                        File::makeDirectory($originalPath, 0777, true, true);
                    }
                    $thumbnailImage->save($originalPath.'post'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());
                    $thumbnailImage->resize(800,350);
                    $thumbnailImage->save($thumbnailPath.'post'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());
                    $imagename='post'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension();
               
            }else
            {
                $imagename=NULL;
            }
            $community->image=$imagename;
            $community->save();
            $userid=\Session::get('admin');
            $userpost=new UserPost;
            $userpost->user_id=$userid->id;
            $userpost->admin_post=$community->id;
            $userpost->type='post';
            $userpost->title=$request->title;
            $userpost->slug=str_slug($request->title);
            $userpost->community_id=$request->community_id;
            $userpost->post=$request->description;
            $userpost->media=$imagename;
            $userpost->created_at=\Carbon\Carbon::now();
            $userpost->updated_at=\Carbon\Carbon::now();
            $userpost->save();
            return redirect()->route('admin.manage.post')->with('success','Post Created successfully!');
        }else
        {
            $community=\DB::table('community')->get();
            return view('admin.post.add',['community'=>$community]);
        }
    }

    public function manage()
    {
        $post=Post::all();
       return view('admin.post.manage')->with(['post'=>$post]);
    }

    public function edit(Request $request,$id)
    {
        if($request->isMethod('post'))
        {

            $community=Post::where('id',$request->id)->first();
            $community->title=$request->title;
            $community->description=$request->description;
            $community->community_id=$request->community_id;
            if($request->hasFile('image'))
            {
                $destinationPath = public_path('/post');
                $destinationPath1 = public_path('/post_image');
                $image_path=$destinationPath.'/'.$community->image;
                $image_path1=$destinationPath1.'/'.$community->image;
                if (File::exists($destinationPath)) 
                {
                    File::delete($image_path);
                }
                if (File::exists($destinationPath1)) 
                {
                    File::delete($image_path1);
                }
                $fileextension=$request->file('image')->getClientOriginalExtension();
                
                    $originalImage= $request->file('image');
                    $thumbnailImage = Image::make($originalImage);
                    $thumbnailPath = public_path().'/post_image/';
                    if (! File::exists($thumbnailPath))
                    {
                        File::makeDirectory($thumbnailPath, 0777, true, true);
                    }
                    $rand=rand(1111,9999);
                    $originalPath = public_path().'/post/';
                    if (! File::exists($originalPath))
                    {
                        File::makeDirectory($originalPath, 0777, true, true);
                    }
                    $thumbnailImage->save($originalPath.'post'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());
                    $thumbnailImage->resize(100,100);
                    $thumbnailImage->save($thumbnailPath.'post'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());
                    $imagename='post'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension();
               
            }else
            {
                $imagename=NULL;
            }
            $community->image=$imagename;
            $community->save();
            $useridad=\Session::get('admin');

            $userpost=UserPost::where('admin_post',$request->id)->first();
            $userpost->user_id=$useridad->id;
            $userpost->type='post';
            $userpost->title=$request->title;
            $userpost->slug=str_slug($request->title);
            $userpost->community_id=$request->community_id;
            $userpost->post=$request->description;
            $userpost->media=$imagename;
            $userpost->created_at=\Carbon\Carbon::now();
            $userpost->updated_at=\Carbon\Carbon::now();
            $userpost->save();
            return redirect()->back()->with('success','Post Edited successfully!');
        }else
        {
            $newid=decrypt($id);
            $post=Post::where('id',$newid)->first();
            $community=\DB::table('community')->get();
            return view('admin.post.edit')->with(['post'=>$post,'community'=>$community]);
        }
    }

    public function delete($id)
    {
        $newid=decrypt($id);
        Post::where('id',$newid)->delete();
        \DB::table('user_posts')->where('admin_post',$newid)->delete();
        $postid=\DB::table('user_posts')->where('admin_post',$newid)->first();
        \DB::table('user_post_reports')->where('post_id',$postid)->delete();
        \DB::table('user_comments')->where('post_id',$postid)->delete();
        \DB::table('user_activity')->where('post_id',$postid)->delete();
        \DB::table('post_hide')->where('post_id',$postid)->delete();
        \DB::table('posts_likes')->where('post_id',$postid)->delete();
        return redirect()->back()->with('success','Post deleted successfully');
    }

    public function posts_report(Request $request)
    {
        $post_report=\DB::table('user_post_reports')
                     ->leftjoin('user_posts','user_posts.id','user_post_reports.post_id')
                     ->leftjoin('users','users.id','user_post_reports.user_id')
                     ->select('user_post_reports.*','users.name','user_posts.user_id')
                     ->get();
        return view('admin.post.manage_posts_report')->with(['report'=>$post_report]);
    }

    public function deleteuserpost(Request $request,$id)
    {
        $newid=decrypt($id);
        \DB::table('user_posts')->where('id',$newid)->delete();
        \DB::table('user_post_reports')->where('post_id',$newid)->delete();
        \DB::table('user_comments')->where('post_id',$newid)->delete();
        \DB::table('user_activity')->where('post_id',$newid)->delete();
        \DB::table('post_hide')->where('post_id',$newid)->delete();
        \DB::table('posts_likes')->where('post_id',$newid)->delete();
        return redirect()->back()->with('success','Post deleted successfully');
    }

    public function user_post_details(Request $request,$id)
    {
        $newid=decrypt($id);
        $post=\DB::table('user_posts')
                     ->leftjoin('user_post_reports','user_posts.id','user_post_reports.post_id')
                     ->leftjoin('users','users.id','user_post_reports.user_id')
                     ->leftjoin('community','community.id','user_posts.community_id')
                     ->select('user_posts.*','users.name','user_post_reports.report','community.title')
                     ->where('user_posts.id',$newid)
                     ->first();
        $date = \Carbon\Carbon::parse($post->created_at);
        $time = $date->diffForHumans(\Carbon\Carbon::now());
         $extension=explode('.',$post->media);
         if(!empty($post->post))
          {
            if(strpos($post->post, 'src="..') !== false)
            {
              $postdata=str_replace('src="..', 'src="'.route('home.dashboard'), $post->post);
              
            }else
            {
              $postdata=$post->post;
            }
          }else{
            $postdata=null;
          }             
        return view('admin.post.view_post_details')->with(['posts'=>$post,'time'=>$time,'extension'=>$extension,'postdata'=>$postdata]);
    }

    public function comments_report(Request $request)
    {
        $report=\DB::table('comment_report')
                ->leftjoin('user_posts','user_posts.id','comment_report.post_id')
                ->leftjoin('users','users.id','comment_report.user_id')
                ->leftjoin('user_comments','user_comments.id','comment_report.comment_id')
                ->leftjoin('community','community.id','comment_report.community_id')
                ->select('comment_report.report','user_posts.user_id as post_user_id','users.name','user_comments.comment','community.title','comment_report.post_id','comment_report.comment_id')
                ->orderBy('comment_report.id','Desc')
                ->groupBy('comment_report.id')
                ->get();
        return view('admin.post.manage_comments_report')->with(['commentreport'=>$report]);
    }

    public function comment_delete(Request $request,$id)
    {
       $commentid=decrypt($id);
       $check=\DB::table('user_comments')->where('parent_id',$commentid)->get()->toArray();
       if(count($check))
       {
        $delete=\DB::table('user_comments')->where('post_id',$check[0]->post_id)->delete();
        \DB::table('comment_report')->where('post_id',$check[0]->post_id)->delete();
       }else
       {
        $delete=\DB::table('user_comments')->where('id',$commentid)->delete();
        \DB::table('comment_report')->where('comment_id',$commentid)->delete();
       }
       
       
            return redirect()->back()->with('success','Comment deleted successfully');
    }
}
