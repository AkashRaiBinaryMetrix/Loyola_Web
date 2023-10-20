<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Community;

use App\Models\UserPost;

use App\Models\PostLikes;

use App\Models\UserPoll;

use App\Models\User;

use File;

use DB;

use Intervention\Image\Facades\Image;



class PostController extends Controller

{

    public function create_post(Request $request)

    {



        $userid=\Session::get('user');



        if($request->isMethod('post'))

        {

         // dd($request->all());

         

            date_default_timezone_set('UTC');

            $userpost=new UserPost;

            $userpost->user_id=$userid->id;

            $userpost->type='post';

            $userpost->title=$request->title;

            $userpost->slug=str_slug($request->title);

            $userpost->community_id=$request->community_id;

            $userpost->continent_id = $request->continent; 
				    $userpost->cat_id = $request->category_res;
				    $userpost->subcat_id = $request->subcategory_res;

            $userpost->post=$request->post ?? NULL;

            if(!empty($request->media))

            {

                $folderPath = public_path().'/post/';

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

                

                

                $medianame= 'post'.'-'.$rand.'.'.$imageType;

                $file = $folderPath . $medianame;

                file_put_contents($file, $image_base64);

                $userpost->media=$medianame;

            }

            if($request->hasFile('media'))

            {

                $fileextension=$request->file('media')->getClientOriginalExtension();

                if($fileextension=='jpg' || $fileextension=='jpeg' || $fileextension=='png')

                {

                  

                    $originalImage= $request->file('media');

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

                    // $thumbnailImage->resize(100,100);

                    $thumbnailImage->save($thumbnailPath.'post'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension());

                    $userpost->media='post'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension();

                }else

                {

                    $image = $request->file('media');

                    $name = 'post'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();

                    $destinationPath = public_path('/post');

                    $image->move($destinationPath, $name);

                    $userpost->media=$name;

                }

                

            } 

            $userpost->created_at=\Carbon\Carbon::now();

            $userpost->updated_at=\Carbon\Carbon::now();

            $userpost->save();

            if(!empty($request->tags))

            {

              $tagsusers=implode('$-', $request->tags);

              foreach ($request->tags as $key => $value)

              {

                $username=DB::table('users')->where('id',$userid->id)->first();

                $userimg=DB::table('user_detail')->where('user_id',$userid->id)->first();

                DB::table('user_notification')->insert(['post_id'=>$userpost->id,'user_id'=>$value,'tagged_user'=>$userid->id,'status'=>$username->name.' tag you in a post','created_at'=>\Carbon\Carbon::now(),'user_image'=>$userimg->image ?? '']);

              }

              DB::table('posts_tags')->insert(['post_id'=>$userpost->id,'user_id'=>$userid->id,'tag_users'=>$tagsusers,'created_at'=>\Carbon\Carbon::now(),'updated_at'=>\Carbon\Carbon::now()]);

            }

            

            $check=DB::table('user_activity')->where('post_id',$userpost->id)->where('user_id',\Session::get('user')->id)->first();

                if(empty($check))

                {

                  $activity['post_id']=$userpost->id;

                  $activity['like_id']='';

                  $activity['user_id']=\Session::get('user')->id;

                  $activity['type']='post';

                  $activity['status']='You created a post';

                  $activity['created_at']=\Carbon\Carbon::now();

                  $activity['updated_at']=\Carbon\Carbon::now();

                  DB::table('user_activity')->insert($activity);

                }

            $randnum=\Helper::RandNum('5').$userpost->id;

            $community=DB::table('community')->where('id',$request->community_id)->first();

            return redirect()->route('user.post.comments',[$community->title,$randnum,str_slug($request->title)]);

        }else

        {

            if(!empty($userid))

            {

               $community=Community::

                        leftjoin('community_join','community_join.community_id','community.id')

                        ->where('community_join.user_id',$userid->id)

                        ->where('community_join.status',1)

                        ->select('community.*','community_join.status','community_join.user_id')

                        ->groupBy('community.id')

                        ->get(); 

            }else

            {

                $community=[];

            }



            //get continent details
            $continentsList = DB::table('continents')->get();

            $allusers=User::leftjoin('user_detail','user_detail.user_id','users.id')->where('users.id','!=',$userid->id)->select('users.*','user_detail.image')->groupBy('users.id')->get();

            return view('user.create_post')->with(['community'=>$community,'alluser'=>$allusers,'continentsList'=>$continentsList]);

        }

        

    }



    public function postcreate(Request $request,$comm)

    {

      $userid=\Session::get('user');

      if(!empty($comm))

      {

        $commtitle=Community::where('title',$comm)->first();

      }else

      {

        $commtitle=null;

      }

      if(!empty($userid))

            {

               $community=Community::

                        leftjoin('community_join','community_join.community_id','community.id')

                        ->where('community_join.user_id',$userid->id)

                        ->where('community_join.status',1)

                        ->select('community.*','community_join.status','community_join.user_id')

                        ->groupBy('community.id')

                        ->get(); 

            }else

            {

                $community=[];

            }

            



            return view('user.create_post')->with(['community'=>$community,'comm'=>$comm,'commtitle'=>$commtitle]);

    }



    public function create_community()

    {

        return view('user.create_community');

    }



    public function create_poll(Request $request)

    { 

     $userid=\Session::get('user');

     if($request->isMethod('post'))

        {

            // dd($request->all());

            date_default_timezone_set('UTC');



            $userpost=new UserPost;

            $userpost->user_id=$userid->id;

            $userpost->type='poll';

            $userpost->slug=str_slug($request->question);

            $userpost->community_id=$request->community_id;

            $userpost->continent_id = $request->continent; 
				    $userpost->cat_id = $request->category_res;
				    $userpost->subcat_id = $request->subcategory_res;

            $userpost->question=$request->question;

            $userpost->queoption=implode('-',$request->option);

            $userpost->multiple=$request->multiple;

            if($request->hasFile('media'))

            {

                $image = $request->file('media');

                $name = 'post'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();

                $destinationPath = public_path('/post');

                $image->move($destinationPath, $name);

                $userpost->media=$name;

            }

            $userpost->created_at=\Carbon\Carbon::now();

            $userpost->updated_at=\Carbon\Carbon::now();

            $userpost->save();



            if(!empty($request->tags))

            {

              $tagsusers=implode('$-', $request->tags);

              foreach ($request->tags as $key => $value)

              {

                $username=DB::table('users')->where('id',$userid->id)->first();

                $userimg=DB::table('user_detail')->where('user_id',$userid->id)->first();

                DB::table('user_notification')->insert(['post_id'=>$userpost->id,'user_id'=>$value,'tagged_user'=>$userid->id,'status'=>$username->name.' tag you in a poll','created_at'=>\Carbon\Carbon::now(),'user_image'=>$userimg->image ?? '']);

              }

              DB::table('posts_tags')->insert(['post_id'=>$userpost->id,'user_id'=>$userid->id,'tag_users'=>$tagsusers,'created_at'=>\Carbon\Carbon::now(),'updated_at'=>\Carbon\Carbon::now()]);

            }

              $activity['post_id']=$userpost->id;

              $activity['like_id']='';

              $activity['user_id']=\Session::get('user')->id;

              $activity['status']='You created a poll';

              $activity['type']='post';

              $activity['created_at']=\Carbon\Carbon::now();

              $activity['updated_at']=\Carbon\Carbon::now();

              DB::table('user_activity')->insert($activity);



            return redirect()->back()->with('success','Your Poll submitted successfully');

        }else

        {

          if(!empty($userid))

          {

            $community=Community::

                        leftjoin('community_join','community_join.community_id','community.id')

                        ->where('community_join.user_id',$userid->id)

                        ->where('community_join.status',1)

                        ->select('community.*','community_join.status','community_join.user_id')

                        ->groupBy('community.id')

                        ->get();

            }else

            {

              $community=[];

            }

            $allusers=User::leftjoin('user_detail','user_detail.user_id','users.id')->where('users.id','!=',$userid->id)->select('users.*','user_detail.image')->groupBy('users.id')->get();

           //get continent details
           $continentsList = DB::table('continents')->get();

           return view('user.create_poll')->with(['community'=>$community,'alluser'=>$allusers, "continentsList"=>$continentsList]);

        }

    }



    public function community()

    {

        return view('user.community');

    }



    public function posts_comment(Request $request,$comm,$id,$slug)

    {



        $id=substr($id, 5, 6);



       $post=UserPost::

             leftjoin('users','users.id','user_posts.user_id')

             ->leftjoin('community','community.id','user_posts.community_id')

             ->select('user_posts.*','users.name as username','community.title as community','community.id as community_id')

             ->where('user_posts.id',$id)

             ->first();

       $newpost=UserPost::where('user_posts.id',$id)->first();

        $user=\Session::get('user');

       if(empty($user))

       {

        $postlike=PostLikes::where('post_id',$post->id)->first();

        $userimage=null;

       }else

       {

        $postlike=PostLikes::where('post_id',$post->id)->where('user_id',$user->id)->where('like',1)->first();

        $userimage=DB::table('user_detail')->where('user_id',$user->id)->first();

       }



       $totallikes=PostLikes::where('post_id',$post->id)->where('like',1)->count();

       $postcomment=DB::table('user_comments')

                    ->leftjoin('users','users.id','user_comments.user_id')

                    ->select('user_comments.*','users.name as username')

                    ->where('post_id',$post->id)

                    ->where('community_id',$post->community_id)

                    ->whereNull('main_comment_id')

                    ->orderBy('user_comments.id','DESC')

                    ->groupBy('user_comments.id')

                    ->get();

        $allcomment=DB::table('user_comments')

                  ->leftjoin('users','users.id','user_comments.user_id')

                  ->select('user_comments.*','users.name as username')

                  ->where('post_id',$post->id)

                  ->where('community_id',$post->community_id)

                  ->groupBy('user_comments.id')

                  ->get();

                

       if(!empty(\Session::get('user')))

        {

            $mycommunity=\DB::table('community')

                     ->leftjoin('community_join','community.id','community_join.community_id')

                      ->where('community_join.user_id',\Session::get('user')->id)

                      ->where('community_join.status',1)

                      ->groupBy('community.id')

                      ->take(6)

                      ->get(); 

        }else{

            $mycommunity=\DB::table('community')

                     ->leftjoin('community_join','community.id','community_join.community_id')

                      ->groupBy('community.id')

                      ->take(6)

                      ->get(); 

        } 

        if($post->community_id!=null)

        {

          $community=DB::table('community')->where('id',$post->community_id)->first();

        }else

        {

          $community=DB::table('community')->where('title',$newpost->community_id)->first();

        }

                      

        $members=DB::table('community_join')->where('community_id',$post->community_id)->where('status',1)->count(); 

        $poll=\DB::table('admin_poll')->where('status',1)->first();

         $poll_option= json_decode($poll->poll_options);

         $extension=explode('.',$poll->media);  

         $totalvotes=\DB::table('admin_poll_votes')->where('poll_id',$poll->id)->count();

         if(!empty(\Session::get('user')))

         {

            $posthide=DB::table('post_hide')->where('post_id',$id)->where('user_id',\Session::get('user')->id)->first();

         }else

         {

            $posthide='';

         }

                      

       return view('user.post_comment')->with(['slug'=>$slug,'post'=>$post,'like'=>$postlike,'totallikes'=>$totallikes,'userimage'=>$userimage,'postcomment'=>$postcomment,'mycommunity'=>$mycommunity,'community'=>$community,'member'=>$members,'poll'=>$poll,'poll_option'=>$poll_option,'extension'=>$extension,'totalvotes'=>$totalvotes,'posthide'=>$posthide,'allcomment'=>$allcomment]);

    }



    public function user_likes(Request $request)

    {

        $user=\Session::get('user');

        if($user)

        {   

            $check=PostLikes::where('post_id',$request->postid)->where('user_id',\Session::get('user')->id)->first();

            if(!empty($check))

            {



                date_default_timezone_set('UTC');

                $postlike=PostLikes::where('post_id',$request->postid)->where('user_id',\Session::get('user')->id)->first();

                $postlike->like=$request->like;

                $postlike->updated_at=\Carbon\Carbon::now();

                $postlike->save(); 

                

                    $userpost=UserPost::leftjoin('users','users.id','user_posts.user_id')->where('user_posts.id',$request->postid)->select('user_posts.*','users.name as username')->first();

                     if($userpost->user_id==$user->id)

                     {

                        $user='your';

                     }else

                     {

                        $user=$userpost->username."'s";

                     }

                     if($request->like==1)

                     {

                        $like='liked';

                     }else if($request->like==0)

                     {

                        $like='unliked';

                     }

                  $activity['post_id']=$request->postid;

                  $activity['like_id']=$postlike->id;

                  $activity['user_id']=\Session::get('user')->id;

                  $activity['type']='post';

                  $activity['status']='You '.$like.' '.$user.' post';

                  $activity['created_at']=\Carbon\Carbon::now();

                  $activity['updated_at']=\Carbon\Carbon::now();

                  DB::table('user_activity')->insert($activity);

                

            }else

            {

              $userpost=UserPost::where('id',$request->postid)->first();



                date_default_timezone_set('UTC');

                $postlike=new PostLikes;

                $postlike->post_id=$request->postid;

                $postlike->user_id=\Session::get('user')->id;

                $postlike->like=$request->like;

                $postlike->created_at=\Carbon\Carbon::now();

                $postlike->updated_at=\Carbon\Carbon::now();

                $postlike->save();



                $username=DB::table('users')->where('id',\Session::get('user')->id)->first();

                $userimg=DB::table('user_detail')->where('user_id',\Session::get('user')->id)->first();

                if($userpost->user_id!=\Session::get('user')->id)

                {

                  DB::table('user_notification')->insert(['post_id'=>$request->postid,'user_id'=>$userpost->user_id,'tagged_user'=>\Session::get('user')->id,'status'=>$username->name.' liked your post','created_at'=>\Carbon\Carbon::now(),'user_image'=>$userimg->image ?? '']);

                }

                



                $userpost=UserPost::leftjoin('users','users.id','user_posts.user_id')->where('user_posts.id',$request->postid)->select('user_posts.*','users.name as username')->first();

                     if($userpost->user_id==$user->id)

                     {

                        $user='your';

                     }else

                     {

                        $user=$userpost->username."'s";

                     }

                     if($request->like==1)

                     {

                        $like='liked';

                     }else if($request->like==0)

                     {

                        $like='unliked';

                     }



                $activity['post_id']=$request->postid;

                $activity['like_id']=$postlike->id;

                $activity['user_id']=\Session::get('user')->id;

                $activity['type']='post';

                $activity['status']='You '.$like.' ' .$user.' post';

                $activity['created_at']=\Carbon\Carbon::now();

                $activity['updated_at']=\Carbon\Carbon::now();

                DB::table('user_activity')->insert($activity);

            }

            $totallike= PostLikes::where('post_id',$request->postid)->where('like',1)->count();

            $res['like']=$totallike;

            $res['status']=1;

            return $res;

        }else

        {

            return 2;

        }

    }



    public function user_posts(Request $request)

    {



        $userposts=UserPost::where('user_id',\Session::get('user')->id)->get();

        return view('user.user_post')->with(['userposts'=>$userposts]);  

    }



    public function user_post_comments(Request $request)

    {

        // dd($request->all());

        date_default_timezone_set('UTC');

        // date_default_timezone_set('Asia/Kolkata');

        $data=$request->all();

        unset($data['_token']);

        $user=\Session::get('user');

        if(!empty($user))

        {

           $data['user_id']=$user->id;

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

        

        $data['user_id']=$user->id;

        $data['created_at']=\Carbon\Carbon::now();

        $data['updated_at']=\Carbon\Carbon::now();



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

            $name = 'comments'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/comment');

            $image->move($destinationPath, $name,75);

            $data['media']=$name;

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

        $check= DB::table('user_comments')->insertGetId($data);

        $userpost=UserPost::leftjoin('users','users.id','user_posts.user_id')->where('user_posts.id',$request->post_id)->select('user_posts.*','users.name as username')->first();

        if($userpost->user_id==$user->id)

        {

            $user='your';

        }else

        {

            $user=$userpost->username."'s";

        }

        $activity['post_id']=$request->post_id;

        $activity['comment_id']=$check;

        $activity['user_id']=\Session::get('user')->id;

        $activity['type']='post';

        $activity['status']='You commented on '.$user.' post';

        $activity['created_at']=\Carbon\Carbon::now();

        $activity['updated_at']=\Carbon\Carbon::now();

        DB::table('user_activity')->insert($activity);



        $details=DB::table('user_comments')->where('id',$check)->first();

        // $time=$details->created_at->diffForHumans();

        $time=\Carbon\Carbon::parse($details->created_at)->diffForhumans();

       if($check)

       {

        $res['comment']=$comment;

        $res['title']=$title;

        $res['status']=1;

        $res['time']=$time;

        $res['name']=$user->name;

        $res['image']=$userimage;

        // return $res;

        return redirect()->back();

       }

    }



    public function upload(Request $request)

    {

        $destinationPath = public_path('/post');

        if(!File::isDirectory($destinationPath)){

                    File::makeDirectory($destinationPath, 0777, true, true);

                }

        $image = $request->file('file');

        $fileName=$request->file('file')->getClientOriginalName();

        // $path=$request->file('file')->storeAs('post', $fileName, $destinationPath);

        

        // $name = 'community'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();

        $image->move($destinationPath, $fileName);

        // dd($destinationPath.'/'.$fileName);

        dd($fileName);

        return response()->json(['location'=>$destinationPath.$fileName]); 

        

        /*$imgpath = request()->file('file')->store('uploads', 'public'); 

        return response()->json(['location' => "/storage/$imgpath"]);*/



    }



    public function poll_votes(Request $request)

    {

       // dd($request->all());

        if(empty(\Session::get('user')))

        {

            return 2;

        }

       $check=DB::table('poll_votes')->where('user_id',\Session::get('user')->id)->where('post_id',$request->postid)->where('community_id',$request->commid)->first();

       if(empty($check))

       {

             if($request->type=='radio')

              {

                $datain['votes']=$request->votes;

                $datain['user_id']=\Session::get('user')->id;

                $datain['community_id']=$request->commid;

                $datain['post_id']=$request->postid;

                $datain['type']=$request->type;

                $datain['created_at']=\Carbon\Carbon::now();

                $datain['updated_at']=\Carbon\Carbon::now();

                DB::table('poll_votes')->insert($datain);

              }

        }else

       {

        if($request->type=='radio')

          {

            $votes=$request->votes;

            DB::table('poll_votes')->where('user_id',\Session::get('user')->id)->where('post_id',$request->postid)->where('community_id',$request->commid)->update(['votes'=>$votes,'updated_at'=>\Carbon\Carbon::now()]);

        }

       }

       if($request->type=='checkbox')

       {

            DB::table('poll_votes')->where('user_id',\Session::get('user')->id)->where('post_id',$request->postid)->where('community_id',$request->commid)->where('type','checkbox')->delete();

            foreach ($request->votes as $key => $value) 

            {

                

                  $datain['user_id']=\Session::get('user')->id;

                  $datain['community_id']=$request->commid;

                  $datain['post_id']=$request->postid;

                  $datain['type']=$request->type;

                  $datain['votes']=$value;

                  $datain['created_at']=\Carbon\Carbon::now();

                  $datain['updated_at']=\Carbon\Carbon::now();

                  DB::table('poll_votes')->insert($datain);

            }

          }

        

          $totalv=DB::table('poll_votes')->where('post_id',$request->postid)->where('community_id',$request->commid)->select('post_id', DB::raw('count(*) as total'))->groupBy('user_id')->get();

       $votes=count($totalv);

        $res['status']='true';

        $res['votes']=$votes;

        return $res;

    }



    public function poll_month_votes(Request $request)

    {

        if(empty(\Session::get('user')))

        {

            return 2;

        }

       $check=DB::table('admin_poll_votes')->where('user_id',\Session::get('user')->id)->where('poll_id',$request->pollid)->first();

       if(empty($check))

       {

             if($request->type=='radio')

              {

                $datain['votes']=$request->votes;

                $datain['user_id']=\Session::get('user')->id;

                $datain['poll_id']=$request->pollid;

                $datain['type']=$request->type;

                $datain['created_at']=\Carbon\Carbon::now();

                $datain['updated_at']=\Carbon\Carbon::now();

                $admin=DB::table('admin_poll_votes')->insertGetId($datain);

                $activity['post_id']=$admin;

              $activity['like_id']='';

              $activity['user_id']=\Session::get('user')->id;

              $activity['status']='admin-poll-votes';

              $activity['created_at']=\Carbon\Carbon::now();

              $activity['updated_at']=\Carbon\Carbon::now();

              DB::table('user_activity')->insert($activity);

              }

              

        }else

       {

        if($request->type=='radio')

          {

            $votes=$request->votes;

            DB::table('admin_poll_votes')->where('user_id',\Session::get('user')->id)->where('poll_id',$request->pollid)->update(['votes'=>$votes,'updated_at'=>\Carbon\Carbon::now()]);

        }

       }

       if($request->type=='checkbox')

       {

            DB::table('admin_poll_votes')->where('user_id',\Session::get('user')->id)->where('poll_id',$request->pollid)->where('type','checkbox')->delete();

            foreach ($request->votes as $key => $value) 

            {

                

                  $datain['user_id']=\Session::get('user')->id;

                  $datain['poll_id']=$request->pollid;

                  $datain['type']=$request->type;

                  $datain['votes']=$value;

                  $datain['created_at']=\Carbon\Carbon::now();

                  $datain['updated_at']=\Carbon\Carbon::now();

                  $admivote=DB::table('admin_poll_votes')->insertGetId($datain);

                  $activity['post_id']=$admivote;

              $activity['like_id']='';

              $activity['user_id']=\Session::get('user')->id;

              $activity['status']='admin-poll-votes';

              $activity['created_at']=\Carbon\Carbon::now();

              $activity['updated_at']=\Carbon\Carbon::now();

              DB::table('user_activity')->insert($activity);



            }

            

          }

        

        $totalv=DB::table('admin_poll_votes')->where('poll_id',$request->pollid)->select('poll_id', DB::raw('count(*) as total'))->groupBy('user_id')->get();

        $votes=count($totalv);

        $res['status']='true';

        $res['votes']=$votes;

        return $res;

    

    }



    public function hidepost(Request $request)

    {

       if(empty(\Session::get('user')))

       {

         $res['status']='false';

         return $res;

       }else

       {

          $check=DB::table('post_hide')->where('post_id',$request->postid)->where('user_id',\Session::get('user')->id)->first();

          if(!empty($check))

          {

            DB::table('post_hide')->where('post_id',$request->postid)->where('user_id',\Session::get('user')->id)->update(['status'=>$request->status]);

            $userpost=UserPost::leftjoin('users','users.id','user_posts.user_id')->where('user_posts.id',$request->postid)->select('user_posts.*','users.name as username')->first();

               if($userpost->user_id==\Session::get('user')->id)

                {

                    $user='your';

                }else

                {

                    $user=$userpost->username."'s";

                }

                  if($request->status==1)

                  {

                    $status='You hide '.$user.' post';

                  }else if($request->status==0)

                  {

                    $status='You unhide '.$user.' post';

                  }

                  $activity['post_id']=$request->postid;

                  $activity['like_id']='';

                  $activity['user_id']=\Session::get('user')->id;

                  $activity['status']=$status;

                  $activity['type']='post';

                  $activity['created_at']=\Carbon\Carbon::now();

                  $activity['updated_at']=\Carbon\Carbon::now();

                  DB::table('user_activity')->insert($activity);

                

          }else

          {

            $hide['user_id']=\Session::get('user')->id;

            $hide['post_id']=$request->postid;

            $hide['status']=$request->status;

            $hide['created_at']=\Carbon\Carbon::now();

            $hide['updated_at']=\Carbon\Carbon::now();

            DB::table('post_hide')->insert($hide);

                $userpost=UserPost::leftjoin('users','users.id','user_posts.user_id')->where('user_posts.id',$request->postid)->select('user_posts.*','users.name as username')->first();

                    if($userpost->user_id==\Session::get('user')->id)

                    {

                        $user='your';

                    }else

                    {

                        $user=$userpost->username."'s";

                    }

                  if($request->status==1)

                  {

                    $status='You hide '.$user.' post';

                  }else if($request->status==0)

                  {

                    $status='You unhide '.$user.' post';

                  }

                  $activity['post_id']=$request->postid;

                  $activity['like_id']='';

                  $activity['user_id']=\Session::get('user')->id;

                  $activity['status']=$status;

                  $activity['type']='post';

                  $activity['created_at']=\Carbon\Carbon::now();

                  $activity['updated_at']=\Carbon\Carbon::now();

                  DB::table('user_activity')->insert($activity);

               

          }

          

          $res['status']='true';

          return $res;

       }

    }



    public function deletepost(Request $request)

    {



       if(empty(\Session::get('user')))

       {

         $res['status']='false';

         return $res;

       }else

       {

          $check=UserPost::where('id',$request->postid)->where('user_id',\Session::get('user')->id)->delete();

          \DB::table('user_post_reports')->where('post_id',$request->postid)->delete();

          \DB::table('user_comments')->where('post_id',$request->postid)->delete();

          \DB::table('user_activity')->where('post_id',$request->postid)->delete();

          \DB::table('post_hide')->where('post_id',$request->postid)->delete();

          \DB::table('posts_likes')->where('post_id',$request->postid)->delete();

          \DB::table('user_notification')->where('post_id',$request->postid)->delete();

          if($check)

          {

            $res['status']='true';

            return $res;

          }

       }

    }



    public function editpost(Request $request,$id)

    {

        $newid=substr($id, 5, 6);

        $userid=\Session::get('user');

        if($request->isMethod('post'))

        {

            $userpost=UserPost::where('id',$newid)->first();

            $userpost->title=$request->title;

            $userpost->slug=str_slug($request->title);

            $userpost->community_id=$request->community_id;

            $userpost->post=$request->post;

            if(!empty($request->media))

            {

                $folderPath = public_path().'/post/';

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

                

                

                $medianame= 'post'.'-'.$rand.'.'.$imageType;

                $file = $folderPath . $medianame;

                file_put_contents($file, $image_base64);

                $userpost->media=$medianame;

            }

            if(!empty($userpost->media))

            {

              $userpost->media=$userpost->media;

            }

            if($request->hasFile('media'))

            {

                $path= public_path('/post/'.$userpost->media);

                if(\File::exists($path))

                {

                  \File::delete($path);

                }

                $fileextension=$request->file('media')->getClientOriginalExtension();

                if($fileextension=='jpg' || $fileextension=='jpeg' || $fileextension=='png')

                {

                    $originalImage= $request->file('media');

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

                    $userpost->media='post'.'-'.$rand.'.'.$originalImage->getClientOriginalExtension();

                }else

                {

                    $image = $request->file('media');

                    $name = 'post'.'-'.rand(1111,9999).'.'.$image->getClientOriginalExtension();

                    $destinationPath = public_path('/post');

                    $image->move($destinationPath, $name);

                    $userpost->media=$name;

                }

            }

             

            $userpost->updated_at=\Carbon\Carbon::now();

            $userpost->save();

            $usercommunity=DB::table('community')->where('id',$userpost->community_id)->first();

            $community=$usercommunity->title;

            $randnum=\Helper::RandNum('5').$userpost->id;

            $urllink=route('user.post.comments',[$community,$randnum,$userpost->slug]);

            return redirect()->to($urllink);

        }else

        {

          $post=UserPost::where('id',$newid)->first();

          $extension=explode('.', $post->media);

          if(!empty($post->post))

          {

            if(strpos($post->post, 'src="..') !== false)

            {

              $postdata=str_replace('src="..', 'src="'.route('home.dashboard'), $post->post);

              

            }else

            {

              $postdata=$post->post;

            }

          }else

          {

            $postdata=NULL;

          }

          

          if(!empty($userid))

            {

               $community=Community::

                        leftjoin('community_join','community_join.community_id','community.id')

                        ->where('community_join.user_id',$userid->id)

                        ->where('community_join.status',1)

                        ->select('community.*','community_join.status','community_join.user_id')

                        ->groupBy('community.id')

                        ->get(); 

            }else

            {

                $community=[];

            }

          return view('user.edit_user_post',['id'=>$id,'post'=>$post,'community'=>$community,'extension'=>$extension,'postdata'=>$postdata]);

        }

    }



    public function report_post(Request $request)

    {

       

       if(empty(\Session::get('user')))

       {

        $res['status']='false';

        return $res;

       }

       date_default_timezone_set('UTC');

       $check=DB::table('user_post_reports')->where('user_id',\Session::get('user')->id)->first();

       if(empty($check))

       {

        DB::table('user_post_reports')->insert(['user_id'=>\Session::get('user')->id,'post_id'=>$request->postid,'report'=>$request->report,'created_at'=>\Carbon\Carbon::now(),'updated_at'=>\Carbon\Carbon::now()]);

            $checkpost=DB::table('user_activity')->where('post_id',$request->postid)->where('user_id',\Session::get('user')->id)->first();

                if(empty($checkpost))

                {

                    $userpost=UserPost::leftjoin('users','users.id','user_posts.user_id')->where('user_posts.id',$request->postid)->select('user_posts.*','users.name as username')->first();

                   if($userpost->user_id==\Session::get('user')->id)

                    {

                        $user='your';

                    }else

                    {

                        $user=$userpost->username."'s";

                    }

                  $activity['post_id']=$request->postid;

                  $activity['like_id']='';

                  $activity['user_id']=\Session::get('user')->id;

                  $activity['type']='post';

                  $activity['status']='You reported on '.$user.' post';

                  $activity['created_at']=\Carbon\Carbon::now();

                  $activity['updated_at']=\Carbon\Carbon::now();

                  DB::table('user_activity')->insert($activity);

                }

       }else

       {

        DB::table('user_post_reports')->where('user_id',\Session::get('user')->id)->update(['report'=>$request->report,'post_id'=>$request->postid,'updated_at'=>\Carbon\Carbon::now()]);

        $checkpost=DB::table('user_activity')->where('post_id',$request->postid)->where('user_id',\Session::get('user')->id)->first();

                if(empty($checkpost))

                {

                    $userpost=UserPost::leftjoin('users','users.id','user_posts.user_id')->where('user_posts.id',$request->postid)->select('user_posts.*','users.name as username')->first();

                   if($userpost->user_id==\Session::get('user')->id)

                    {

                        $user='your';

                    }else

                    {

                        $user=$userpost->username."'s";

                    }

                  $activity['post_id']=$request->postid;

                  $activity['like_id']='';

                  $activity['user_id']=\Session::get('user')->id;

                  $activity['type']='post';

                  $activity['status']='You reported on '.$user.' post';

                  $activity['created_at']=\Carbon\Carbon::now();

                  $activity['updated_at']=\Carbon\Carbon::now();

                  DB::table('user_activity')->insert($activity);

                }

       }

       $res['status']='true';

       return $res;

    }



    public function sortcomments(Request $request)

    {

       $query=DB::table('user_comments')

                 ->leftjoin('users','users.id','user_comments.user_id')

                 ->leftjoin('user_detail','user_detail.user_id','user_comments.user_id')

                 ->select('user_comments.*','users.name','user_detail.image')

                 ->where('user_comments.post_id',$request->postid);

                 if($request->type=='alpha')

                 {

                  $query->orderBy('user_comments.comment','ASC');

                  $query->whereNotNull('user_comments.comment');

                 }

                 if($request->type=='text')

                 {

                  $query->whereNotNull('user_comments.comment');

                 }

                 if($request->type=='video')

                 {

                  $query->whereNotNull('user_comments.media');

                  $query->whereNull('user_comments.title');

                 }

                 if($request->type=='video_text')

                 {

                  $query->whereNotNull('user_comments.media');

                  $query->whereNotNull('user_comments.title');

                 }

                 

          $comments=$query->groupBy('user_comments.id')

                 ->get();

       $res['comment']=$comments;

       $res['total']=count($comments);

       return $res;          

      // dd($comments);           



    }



    public function sharepost(Request $request)

    {

        dd($request->all());

       // $post=\DB::table('user_posts')->where('id',)

    }



    public function editpoll(Request $request,$id)

    {

      $newid=substr($id, 5, 6);

      $userid=\Session::get('user');

      if($request->isMethod('post'))

      {

            $userpost=UserPost::where('id',$newid)->first();

            $userpost->question=$request->question;

            $userpost->slug=str_slug($request->question);

            $userpost->multiple=$request->multiple;

            $userpost->queoption=implode('-', $request->option);

            $userpost->updated_at=\Carbon\Carbon::now();

            $userpost->save();

            return redirect()->back()->with('success','Poll edited successfully');

      }else

      {

          $post=UserPost::where('id',$newid)->first();

          $option=explode('-', $post->queoption);

          

               $community=Community::

                        select('community.*')

                        ->get(); 

          return view('user.edit_poll',['id'=>$id,'poll'=>$post,'community'=>$community,'option'=>$option]);

      }

    }



    public function getnotification(Request $request)

    {

       DB::table('user_notification')->where('id',$request->notification_id)->update(['final_status'=>0]);

       $response['status']='true';

       return $response;

    }

}

