@extends('user.layout.app')
@section('content')
@php
$currentURL = Request::url();
if(!empty($post->title))
{
	$title=$post->title;
}else
{
	$title=$post->question;
}
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
 	$postdata='description';
 }
 if(!empty($post->media))
 {
 	$image=asset('public/post/'.$post->media);
 }else
 {
 	$image='your image';
 }
@endphp
<meta property="og:title" content="{{$title}}" />
<meta property="og:image" content="{{$image}}" />
<meta property="og:url" content="{{$currentURL}}"/>
<meta property="og:description" content="{{$postdata}}"/>
<style type="text/css">
	.drop-zone {
  max-width: 800px;
  height: 200px;
  padding: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-family: "Quicksand", sans-serif;
  font-weight: 500;
  font-size: 20px;
  cursor: pointer;
  color: #cccccc;
  border: 4px dashed #009578;
  border-radius: 10px;
}

.drop-zone--over {
  border-style: solid;
}

.drop-zone__input {
  display: none;
}

.drop-zone__thumb {
  width: 100%;
  height: 100%;
  border-radius: 10px;
  overflow: hidden;
  background-color: #cccccc;
  background-size: cover;
  position: relative;
}

.drop-zone__thumb::after {
  content: attr(data-label);
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 5px 0;
  color: #ffffff;
  background: rgba(0, 0, 0, 0.75);
  font-size: 14px;
  text-align: center;
}
a, span {
    display: inline;
}

</style>
<div class="main-wrapper">
  <div class="container">
	<div class="row flex-md-row-reverse">
	  
		<div class="col-md-4 custom-4col">
		  <div class="main-rightsec">
			 
			<div class="right-main-col">
				<div class="community-coverpic"><img src="{{asset('public/community/'.$community->cover_image)}}" alt=""></div>
				
				<div class="inner-community-cover">
					<a href="{{route('community.info',$community->title)}}">
					<div class="text-center">
						<div class="com-profile">
						  <div class="com-profilepic"><img src="{{asset('public/community/'.$community->image)}}" alt=""></div>
						  <div class="com-profilename">{{$community->title}}</div>	
						</div>
					</div>
					</a> 
					
				  <div class="group-link">
				  	<!-- <a href="{{route('community.info',$community->title)}}">{{route('community.info',$community->title)}}</a> -->
				  </div>
					
				  <div class="row">
					<div class="col-sm-6"><div class="com-tmember">@if($member==1) <strong id="totalmem{{$community->id}}">{{$member}} Member </strong> @else <strong>{{$member}}</strong> Members @endif</div></div>
					  
					<div class="col-sm-6"><div class="com-tmember float-right"><strong>{{\Carbon\Carbon::parse($community->created_at)->format('M d, Y') }} </strong>Created date</div></div>
				  </div>	
					 @php
					$user=\Session::get('user');
					if(!empty($user)){
					$memberjoin=DB::table('community_join')->where('community_id',$community->id)->where('user_id',$user->id)->first();

				     }

					@endphp

				  <div class="com-btn">
					<div class="join-btn-col">
						@if(empty($user) || empty($memberjoin))
						  <button type="button" class="comjoin-btn comjoin-btn-active" onclick="join('{{ $community->id }}','1')" id="joinnew{{$community->id}}">Join</button>
						@elseif(!empty($user) && $memberjoin->status==0)
						  <button type="button" class="comjoin-btn comjoin-btn-active" onclick="join('{{ $community->id }}','1')" id="joinnew{{$community->id}}">Join</button>
						  @elseif(!empty($user) && $memberjoin->status==1)
						  <button type="button" class="comjoin-btn" onclick="join('{{ $community->id }}','0')" id="leaveidnew{{$community->id}}">Leave</button>
						  @endif
						   <button type="button" class="comjoin-btn comjoin-btn-active" onclick="join('{{ $community->id }}','1')" id="join{{$community->id}}" style="display: none;">Join</button>
						  <button type="button" class="comjoin-btn" onclick="join('{{ $community->id }}','0')" style="display: none;" id="leaveid{{$community->id}}">Leave</button> 
					</div>
				    </div>	
					
				</div>

			   
			</div>  
			  
			<div class="right-main-col">
			  <div class="right-main-title"><div class="leftsode-ico green-bg"><img src="{{asset('public/images/communities-ico.png')}}" alt=""></div>@if(!empty(\Session::get('user'))) My  Communities @else Community @endif</div>  
			  
			  <div class="communties-thumb">
			    @if(count($mycommunity)>0)
				@foreach($mycommunity as $key=>$mycomm)
				@if($key!=8)
			    <a href="{{route('community.info',$mycomm->title)}}"><span class="community-pic"><img src="{{asset('public/community/'.$mycomm->image)}}" alt=""><b>{{$mycomm->title}}</b></span></a>
			    @endif
			    @endforeach
			    @endif 
			  </div>	
				
			<div class="view-btn">
				@if(!empty(\Session::get('user')))
				<a href="{{route('my.community')}}">View All</a>
				@else
				<a href="{{route('all.community')}}">View All</a>
				@endif
			</div>	
				
			</div> 
			
			<div class="right-main-col poll-col">
			  <div class="right-main-title"><div class="leftsode-ico blue-bg"><img src="{{asset('public/images/poll-ico.png')}}" alt=""></div>Poll of the Month</div>
				
			  <div class="poll-inner">
			    <div class="poll-pic">
			    	@if(!empty($poll->media))
			    	 @if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
                      <img src="{{asset('public/poll/'.$poll->media)}}" id="imgcom" style="width:300px;height:150px;" class="img-responsive">
                      @elseif($extension[1]=='mp4')
                        <video width="100%" height="100%" controls>
                      <source src="{{asset('public/poll/'.$poll->media)}}" type="video/mp4">
                      <source src="{{asset('public/poll/'.$poll->media)}}" type="video/ogg">
                    Your browser does not support the video tag.
                    </video>
                    @endif
                    @endif 
			    </div>
				<div class="poll-text">  
				  <h3>{{($poll->question) ? $poll->question : ''}}</h3>
					
				  <div class="poll-fields">
				  	@foreach($poll_option as $key=>$polls)
				  	@if($poll->multiple==1)
				  	<div class="custom-control">
					  <input type="checkbox" class="custom-control-input" id="pollm{{$key}}" name="pollmnew[]"  value="{{$polls}}">
					  <label class="custom-control-label" for="pollm{{$key}}">{{$polls}}</label>
					</div>
				  	@else
					<div class="custom-control custom-radio">
					  <input type="radio" class="custom-control-input" id="pollm{{$key}}" name="poll"  value="{{$polls}}">
					  <label class="custom-control-label" for="pollm{{$key}}">{{$polls}}</label>
					</div>
					@endif
					@endforeach
					@if($poll->multiple==1)
					<button class="sub-btn" type="button" id="subpoll" onclick="pollvotes('{{$poll->id}}','checkbox')">Submit</button>
					@else
					<button class="sub-btn" type="button" id="subpoll" onclick="pollvotes('{{$poll->id}}','radio')">Submit</button>
					@endif
					<div class="poll-count">votes: <strong id="totalvote">{{$totalvotes}}</strong></div>  
				  </div>	
					
				</div>	
			  </div>
				
			</div>   
			    
			  
			<div class="right-ad"><img src="{{asset('public/images/right-ad.jpg')}}" alt="" class="img-responsive"></div>  
			  
			  
		  </div><!--main-rightsec-->
		
		</div>
		@php
		$randnum=\Helper::RandNum('5').$post->id;
		@endphp
		
		<div class="col-md-8 custom-8col">
		  <div class="mainleft-sec">
			
			<div class="post-sec">
				<div class="newsfeed-sec" id="no-comment" style="display: none;">
					Post Deleted Successfully
				</div>
			  <div class="newsfeed-sec" id="user-comment">
				  
			   <div class="newsfeed-top-sec">
				 <div class="left-newstop-col">  
			      <div class="news-userpic"><img src="@if(!empty($userimage->image)) {{asset('public/user/images/'.$userimage->image)}} @else {{asset('public/images/user.png')}} @endif" alt=""></div>
					 
				  <div class="newsfeed-grup">
					 <div class="newsfeed-grupname">
					    <h3><a href="#">{{$post->username}}</a></h3> <img src="{{asset('public/images/solid-arrow.png')}}" alt="">
					    <h3><a href="#">{{$community->title}}</a></h3>
					  </div>	  
					<div class="newsfeed-time"> <p>{{\Carbon\Carbon::parse($post->created_at)->format('M d, Y')}} at {{\Carbon\Carbon::parse($post->created_at)->format('h:m A')}}</p></div>
				  </div>
				   
				 </div><!--left-newstop-col-->
				   
				 <div class="right-newstop-col">
				   <div class="post-dots">
					   <div class="dropdown">
						  <button type="button" class="dropdown-toggle" data-toggle="dropdown">
							 <i class="las la-ellipsis-h"></i>
						  </button>
						  <div class="dropdown-menu">
						  	@if(!empty($posthide) && $posthide->status==1)
						  	<a class="dropdown-item" href="javascript:void" onclick="hidepost('{{$post->id}}','0','comment')"><i class="las la-eye"></i> Show</a>
						  	@else
							  <a class="dropdown-item" href="javascript:void" onclick="hidepost('{{$post->id}}','1','comment')"><i class="las la-eye-slash"></i> Hide</a>
							@endif
							<a class="dropdown-item" href="javascript:void" onclick="report('{{$post->id}}')"><i class="las la-flag"></i> Report</a>
							@if(!empty(\Session::get('user')) && \Session::get('user')->id==$post->user_id)
							@if($post->type=='post')
							   <div class="edit-btn"><a href="{{route('edit.post',$randnum)}}"><i class="las la-edit"></i> Edit</a>
							   </div>
							 @endif
							 @if($post->type=='poll')
							   <div class="edit-btn"><a href="{{route('user.edit.poll',$randnum)}}"><i class="las la-edit"></i> Edit</a>
							   </div>
							 @endif

							 <div class="delete-btn"><a href="javascript:void"   onclick="deletepost('{{$post->id}}')"><i class="las la-trash-alt"></i> Delete</a></div>
							 @endif
						  </div>
						</div>
				   </div>
				 </div> 
				   
			   </div>
			   @php
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
		          }
		          if(!empty($post->queoption))
			     {
			     	$options=explode('-',$post->queoption);
			     }else
			     {
			     	$options=array();
			     }
			     $totalvotes=DB::table('poll_votes')->where('post_id',$post->id)->where('community_id',$community->id)->select('post_id', DB::raw('count(*) as total'))->groupBy('user_id')->get();
			     if(!empty(\Session::get('user')))
			     {
			    	$uservotesingle=DB::table('poll_votes')->where('user_id',\Session::get('user')->id)->where('post_id',$post->id)->where('community_id',$community->id)->where('type','radio')->first();
			    	$uservotesmulti=DB::table('poll_votes')->where('user_id',\Session::get('user')->id)->where('post_id',$post->id)->where('community_id',$community->id)->where('type','checkbox')->pluck('votes')->toArray();
			    	if(!empty($uservotesingle))
			    	{
			    		$votes=$uservotesingle->votes;
			    	}
			    	if(!empty($uservotesmulti))
			    	{
			    		$votesp=$uservotesmulti;
			    	}
			     }

			   @endphp
				  
			   <div class="newsfeed-title"><h3>{{$post->title}}</h3></div>
			    @if(!empty($post->post))
				   	{!!$postdata!!}
				   	@endif 
				   	@php	
				      	$usertags=DB::table('posts_tags')->where('post_id',$post->id)->first();
				      	if(!empty($usertags->tag_users))
				      	{
				      		$taguser=explode('$-',$usertags->tag_users);
				      	}
				      @endphp
				      <div> 
				      @if(!empty($taguser))
				      @foreach($taguser as $user)
				      @php
				      $usertagname=DB::table('users')->where('id',$user)->first();
				      @endphp
				      <a href="javascript:void" style="color: #007bff !important;"><b>{{$usertagname->name}}</b></a>
				      
				      @endforeach
				      @endif
				      </div>
			   <div class="post-upload-pic">
			   	<!-- <img src="{{asset('public/images/gaming-post-1.jpg')}}" alt=""> -->
			      @if(!empty($post->media))
				   	@if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
						  	<img src="{{asset('public/post/'.$post->media)}}" id="imgcom" >
						  	@elseif($extension[1]=='mp4')
						  	<video width="100%" height="100%" controls>
							  <source src="{{asset('public/post/'.$post->media)}}" type="video/mp4">
							  <source src="{{asset('public/post/'.$post->media)}}" type="video/ogg">
							  Your browser does not support the video tag.
							</video> 
						  	@elseif($extension[1]=='ogg')
						  	 <audio controls>
							  <source src="{{asset('public/post/'.$post->media)}}" type="audio/ogg">
							  <source src="{{asset('public/post/'.$post->media)}}" type="audio/mpeg">
							Your browser does not support the audio element.
							</audio> 
						  	@endif
						  	@endif
				   </div>
				   	<div class="newsfeed-title" >
					  <h3>{{$post->question}}</h3>
					  </div>
						@foreach($options as $key1=>$optn)
					  <div class="poll-fields">
					  	@if($post->multiple==1)
					  	@if(!empty(\Session::get('user')))
					  	<input type="checkbox" class=""  name="pollnew{{$post->id}}[]" value="{{$optn}}"@if(!empty($votesp) && in_array($optn,$votesp)) checked @endif> <label>{{$optn}}</label>
					  	@else
						<input type="checkbox" class=""  name="pollnew{{$post->id}}[]" value="{{$optn}}"> <label>{{$optn}}</label>
						@endif
						@else
						<div class="custom-control custom-radio">
							@if(!empty(\Session::get('user')))
						  <input type="radio" class="custom-control-input" id="poll{{$key1+8}}" name="pollvote{{$post->id}}" value="{{$optn}}"@if(!empty($votes) && $votes==$optn) checked @endif><label class="custom-control-label" for="poll{{$key1+8}}">{{$optn}}</label>
						  @else
						  <input type="radio" class="custom-control-input" id="poll{{$key1+8}}" name="pollvote{{$post->id}}" value="{{$optn}}"><label class="custom-control-label" for="poll{{$key1+8}}">{{$optn}}</label>
						  @endif
						</div>
						 @endif
				      </div>
				      @endforeach

				      @if($post->type=='poll' && $post->multiple==1)
						<button class="sub-btn" type="button" id="subpollvote" onclick="votes('{{$post->id}}','{{$community->id}}','checkbox')">Submit</button>
						@elseif($post->type=='poll')
						<button class="sub-btn" type="button" id="subpollvote" onclick="votes('{{$post->id}}','{{$community->id}}','radio')">Submit</button>
						@endif
						@if($post->type=='poll')
					    <div class="poll-count">votes: <strong id="uservote{{$post->id}}">{{count($totalvotes)}}</strong></div>
					    
					    @endif
						
			   
			   			
			   <div class="newsfeed-licosh-col"

			   >
			     @if(empty($like))
				   	<div class="like-btn" id="unlikediv{{$post->id}}"><a href="javascript:void" onclick="unlikepost('{{$post->id}}')"><img src="{{ asset('public/images/like-ico.png') }}" alt=""></a>@if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</div>
				   	@elseif(empty($like) && !empty($totallikes))
				   	 <div class="like-btn" id="unlikediv{{$post->id}}"><a href="javascript:void" onclick="unlikepost('{{$post->id}}')"><img src="{{ asset('public/images/like-ico.png') }}" alt=""> @if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</a></div>
				   	@elseif($like->like==0)
			     <div class="like-btn" id="unlikediv{{$post->id}}"><a href="javascript:void" onclick="unlikepost('{{$post->id}}')"><img src="{{ asset('public/images/like-ico.png') }}" alt=""> @if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</a></div>
			     @else
			     <div class="like-btn" id="likediv{{$post->id}}"><a href="javascript:void" onclick="likepost('{{$post->id}}')"><img src="{{ asset('public/images/like.png') }}" alt="" style="width:20px;height20px;">@if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</a></div>
			      
			     @endif
			     	<div class="like-btn" id="unlikediv{{$post->id}}" style="display: none;"><a href="javascript:void" onclick="unlikepost('{{$post->id}}')"><img src="{{ asset('public/images/like-ico.png') }}" alt=""></a><span id="singleun{{$post->id}}"></span><span id="doubleun{{$post->id}}" ></span></div>
			     <div class="like-btn" id="likediv{{$post->id}}" style="display: none;"><a href="javascript:void" id="like" onclick="likepost('{{$post->id}}')"><img src="{{asset('public/images/like.png') }}" alt="" style="width:20px;height20px;"></a><span id="single{{$post->id}}"></span><span id="double{{$post->id}}"></span>
			     </div>
				 <div class="comment-btn"><img src="{{asset('public/images/comment-ico.png')}}" alt=""> {{count($allcomment)}} Comments</div>

				 <a href="javascript:void"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('public/images/share-ico.png') }}" alt=""> Share</a>
				  @php
				  
				  
				 if(!empty($post->title))
				 {
				 	$title=$post->title;
				 }else
				 {
				 	$title='IF I WERE...MAKING THE WORLD A BETTER PLACE';
				 }
				 
				 if(!empty($post->media))
				 {
				 	$media=asset('public/post/'.$post->media);
				 }else
				 {
				 	$media=asset('public/images/logo.png');
				 }
				 $url=route('user.post.comments',[$community->title,$randnum,$post->slug]);
				
				 $img=urlencode($media);

				 $titleweb=urlencode($title);
				 @endphp
				 <input type="hidden" id="url{{$post->id}}" style="display: none;" value="{{route('user.post.comments',[$community->title,$randnum,$post->slug])}}">
				 <ul class="dropdown-menu">
				  <li><a href="javascript:void" onclick="copyToClipboard('#url{{$post->id}}','{{$post->id}}')" class="copy-text" data-clipboard-target="#url{{$post->id}}"><i class="fa fa-link" style="padding-right: 5px;"></i>Copy Link</a></li>
				  <li><a href="http://www.facebook.com/sharer.php?s=100&p[url]=https://binarymetrix-dev.com/ifiwere&p[images][0]={{$img}}&p[title]={{$titleweb}}&p[summary]='If I Were'" target="_blank" target="_blank"><i class="fa fa-facebook-f" style="padding-right: 5px;"></i>Share on Facebook</a></li> 
				  <li><a href="https://twitter.com/share?url={{route('user.post.comments',[$community->title,$randnum,$post->slug])}}&text=IF I WERE...MAKING THE WORLD A BETTER PLACE check this post" target="_blank"><i class="fa fa-twitter" style="padding-right: 5px;"></i>Share on Twitter</a></li>
				  <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{route('user.post.comments',[$community->title,$randnum,$post->slug])}}&title=$post->slug&summary=IF I WERE...MAKING THE WORLD A BETTER PLACE check this post&source=IF I WERE...MAKING THE WORLD A BETTER PLACE"><i class="fa fa-linkedin" style="padding-right: 5px;"></i>Share on Linkedin</a></li>
				</ul>
				   
			   </div>
				  <form method="post" enctype="multipart/form-data" id="commform">
				  	@csrf
				  	<input type="hidden" name="community_id" value="{{$community->id}}">
				  	<input type="hidden" name="post_id" value="{{$post->id}}">
			  <div class="postcomment-sec">
			  					@if(!empty(Session::get('user')))
				
				@endif
				@if(!empty(Session::get('user')))
				
				<div class="col-12">
				  <div class="form-group media-profile">
				  	<div class="create-addpost">
					<h4>Add Media to your comment</h4> 
					<div class="create-media">
					  <a href="javascript:void(0)" onclick="openmedia('image')" style="margin-right: 0px !important"><img class="media-pic" src="{{asset('public/images/image-ico.png')}}" alt="" title="Add image"></a>
					  <a href="javascript:void(0)" onclick="openmedia('video')" style="margin-right: 0px !important"><img class="media-pic" src="{{asset('public/images/create-video-ico.png')}}" alt="" title="Add video"></a>
					  <img class="media-pic media-audio" src="{{asset('public/images/mic-ico.png')}}" alt="" title="Add audio">
					  <input class="file-upload" name="media" type="file" accept="audio/*" style="display: none;" id="file" onchange="previewimg(this)"/>	
					  <input type="hidden" name="media" value="" id="camera-snap">
					  <input type="hidden" name="" value="" id="video-snap">
					 
					</div> 
				   </div>
				 </div>
					
				  </div>
				</div>
				<div class="drop-zone" id="imgsec" style="display: none;">
				    <span class="drop-zone__prompt"></span>
				    <img id="blah" style="max-height: 150px;text-align: center;">
				    <a href="javascript:void" data-toggle="modal" data-target="#video-modal"><video style="max-width: 250px;text-align: center;display: none;" controls id="videoid"><source src="" type="video/mp4"></video></a>
				    <video style="max-height: 150px;text-align: center;display: none;" controls id="audid"><source src="" type="audio/ogg"></video>
				    <!-- <input type="file" name="myFile" class="drop-zone__input"> -->
				    
				    </div>
				<div class="editor-sec" id="titletxtsec" style="display: none;">
					<input type="text" class="form-control" placeholder="Add Caption" id="titletxt" style="display: none;margin-top: 5px;" name="title"> 
				</div>

				<div class="editor-sec" id="editor-sec">
				   <textarea class="form-control full-featured-non-premium" name="comment" id="user-comment" maxlength="35"></textarea> 
				</div>
				 <input type="hidden" name="imagetype" id="media-image-type">  
				  <span id="commac" style="margin-top: 5px;"></span>
				  <span id="comment-remaining" style="margin-top: 5px;color: red;display: none;">Maximum words can not be more than 400 words</span>
				  @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        
                        <span  style="margin-top: 5px;">{{ $message }}</span>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                        <span  style="margin-top: 5px;">{{ $message }}</span>
                </div>
                @endif
                <span id="postcontnt" style="float: right;"></span>
                <span id="words-max" style="margin-top: 5px;color: red;">Maximum words 400</span>
				 <div class="form-group mb-1 mt-4 submit-col text-md-right">

				 	<button class="common-btn" id="spinbtn" style="display: none;">
					  <span class="spinner-border spinner-border-sm"></span>

					</button>
				  

			        <button type="button" class="common-btn" id="commentbtn" >Post</button>
			        
			    </div>
			</form>

			    @else
			    <div class="login-btns" style="margin-bottom: 20px;text-align: center;">
			    	<p>Log in or sign up to leave a comment</p>
			   
					<div class="common-btn common-btn-border login-btn" data-toggle="modal" data-target="#login-modal"><i class="las la-user"></i> Sign In</div>
					<div class="common-btn signup-btn" data-toggle="modal" data-target="#signup-modal"><i class="las la-user-plus"></i> Sign Up</div>
				</div>
			    @endif 
				 
				 @if(!empty(Session::get('user')))
				 <div class="comments-sort">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="las la-sliders-h"></i> Sort By</a>
		
					<ul class="dropdown-menu">
					  <li><a href="javascript:void" onclick="sortcomments('{{$post->id}}','alpha')">Alphabetically</a></li>
					  <li><a href="javascript:void" onclick="sortcomments('{{$post->id}}','text')">By text only</a></li> 
					  <li><a href="javascript:void" onclick="sortcomments('{{$post->id}}','video')">By video only</a></li>
					  <li><a href="javascript:void" onclick="sortcomments('{{$post->id}}','video_text')">By video and text</a></li>
					</ul>  
				</div>
				
				
				 <input type="hidden" id="datenew" value="{{\Carbon\Carbon::now()}}">
				  <div class="usercomment-sec" id="commt-section">
				  </div>
				  <div class="usercomment-sec" id="commt-section-media">
				  </div>
				<div class="usercomment-sec">
					<div class="usercomment-col" style="display: none;" id="usercomsec">
					   <div class="usercomment-pic"><img src="" alt="" id="userimgda"></div>
					   <div class="usercomment-content">
						  <div class="usercomment-name" ><span id="username"></span> <span id="commenttime"></span></div> 
						 
						  <div class="usercomment-text">
						  	<img src="" id="imgcom" style="max-height:150px;display: none;">
						  	<video style="width:100%;text-align: center;display: none;" controls id="videosrccomm"><source src="" type="video/mp4"></video>
						  	<video style="max-width: 283;text-align: center;display: none;" controls id="audidcomm"><source src="" type="audio/ogg"></video>
						  </div>
						   <div class="usercomment-text" id="contentss"></div>
						 <div class="usercomment-btns">
						   <a href="#"><img src="{{asset('public/images/like-ico.png')}}" alt=""> 65</a>
						   <a href="#">Reply</a>
						   <a href="#">Report</a>	 
						 </div>   
					   </div>
				   </div>
				 @if(count($post->comments)>0)
				  @include('user.comment_reply', ['comments' => $postcomment, 'post_id' => $post->id])
				  @else
				    <p id="nocomment">No comments</p>
				  @endif	
				</div>  
				  @endif 
				  
			  </div>
				  
				  
		   </div><!--newsfeed-sec-->		
			  

			<!-- Modal -->
			<div id="video-modal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        
			      </div>
			      <div class="modal-body">
				    <video style="width:100%;text-align: center;display: none;" controls id="videosrc"><source src="" type="video/mp4"></video>
			      </div>
			      
			    </div>

			  </div>
			</div>
			</div>  
			  
			
		  </div>
		</div>
		
	</div>
  </div>		
</div>

<div class="modal fade common-modal" id="postvideoamodalTitle" tabindex="-1" role="dialog" aria-labelledby="postmediamodalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-align: right;
    margin: 10px;">
          <span aria-hidden="true"><i class="las la-times"></i></span>
        </button>
		
      <div class="modal-body p-0" id="media-modal-body">
         <div class="login-wrapper">
			<div class="login-form-col">
			 
		    <h1 style="margin-left: 15px;">Create Post</h1>
            <div class="postmedia-popcol">
              <div class="user-postmedia-head" style="text-align: center; margin-top: 10px;margin-bottom: 10px;">
              	<input type="hidden" name="type" id="modal-type">
									
                  <button type="button" onclick="opengallery('gallery')">Upload from Gallery</button> 
                  <button type="button" onclick="opencamera('camera')" id="start-camera">Start Camera</button> 
              </div>
                
              <div class="postmedia-inner">
              	<video autoplay="true" id="videoElement" class="w-100" style="display:none;"></video>
              <div class="postlive-popcol" id="video-open" style="display:none;">
              <!-- <video id="video" autoplay="true" class="w-100"></video> -->
              
              <!-- <canvas id="canvas" width="500" height="320" style="display: none;"></canvas> -->
              <div class="camera-snap">
              <button id="start-record">Start Recording</button>
              <canvas id="canvas-video" width="500" height="320" style="display: none;"></canvas>
							<button id="stop-record" style="display:none;">Stop Recording</button>
							<button style="display:none;" id="download-btn"><a id="download-video" download="{{time()}}.webm" >Download Video</a></button>
            </div>
            </div>

            <div class="postlive-popcol" id="image-snap" style="display:none;">
              
              
              <canvas id="canvas" width="500" height="320" style="display: none;"></canvas>
              <div class="camera-snap">
              <button id="click-photo">Take Snap</button>
            </div>
            </div>
					    <div class="file-loading drop-zone" id="file-vdo">
					    	<video width="240" height="160" controls style="display: none;" id="video-preview" style="display:none;">
							  <source src="" type="video/mp4">
							  <source src="" type="video/ogg">
							  	Your browser does not support the video tag.
							</video>
                   <input type="file" accept="video/*" id="vdofile" onchange="previewvideo(this)">
              </div>
               <div class="file-loading drop-zone" id="file-img">
					    	<img src="" id="flie-preview" style="width:300px;height:150px;display: none;">
                   <input type="file" accept="image/jpg, image/png, image/jpeg" name="media" class="file" data-overwrite-initial="false" data-min-file-count="2" id="file" onchange="previewimage(this)">
              </div>					
              </div>    
            </div>
               
           <div class="common-box" style="display:none" id="image-post">
              <button type="button" class="common-btn w-100" id="closemodal">Add to your post</button>
          </div> 
			     <div class="common-box" style="display:none" id="video-post">
              <button type="button" class="common-btn w-100" id="closevdomodal" disabled>Upload to your post</button>
          </div>   
		  </div>
		  </div>
      </div>
    </div>
  </div>
</div>


<div id="report-modal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
              	<span>Submit a Report</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="titlecom"></h4>
              </div>
              <div class="modal-body">
              	<input type="hidden" name="" id="comment-id">
              	<input type="hidden" name="" id="community-id">
              	<input type="hidden" name="" id="post-id">

              	<div class="">
              	<input type="radio"  id="spamr" value="Spam" name="report-comment" onchange="remove(this)">
              	<label for="spamr" class="" style="background-image: none;">Spam</label>
              	</div>
              	<div class="">
              	<input type="radio"  id="hater" value="Hate" name="report-comment" onchange="remove(this)">
              	<label for="hater" class="" style="background-image: none;">Hate</label>
				</div>
              	<div class="">
              	<input type="radio"  id="interestedr" value="Not Interested" name="report-comment" onchange="remove(this)">
              	<label for="interestedr" class="" style="background-image: none;">Not Interested</label>
              	</div>
              	<div class="">
              	<input type="radio"  id="misinformationr" value="Misinformation" name="report-comment" onchange="remove(this)">
              	<label for="misinformationr" class="" style="background-image: none;">Misinformation</label>
              	</div>
              	<div class="">
              	<input type="radio"  id="likeitr" value="Don't Like It" name="report-comment" onchange="remove(this)">
              	<label for="likeitr" class="" style="background-image: none;">Don't Like It</label>
              	</div>
              	<div class="">
              	<input type="radio"  id="fraudr" value="Fraud" name="report-comment" onchange="remove(this)">
              	<label for="fraudr" class="" style="background-image: none;">Fraud</label>
              	</div>
              	<div class="">
              	<input type="radio" id="harassmentr" value="Bullying or harassment" name="report-comment" onchange="remove(this)">
              	<label for="harassmentr" class="" style="background-image: none;">Bullying or harassment</label>
              	</div>
              	<div class="">
              	<input type="radio"  id="voilencer" value="Voilence" name="report-comment" onchange="remove(this)">
              	<label for="voilencer" class="" style="background-image: none;">Voilence</label>
              	</div>	
              	<p id="report-error"></p>
              	<div class="" style="text-align: right;">
                <button class="btn btn-success text-right" id="report-comment-btn" disabled="" type="button" onclick="commentreport()">Submit</button>
                </div>
              </div>
              
            </div>

          </div>
        </div>
         <div id="thanks-modal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
              	<span>Submit a Report</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">

              	<div class="">
              		<span>Thanks for your report </span>
                    <p>Your reporting helps make our website a better, safer, and more welcoming place for everyone; and it means a lot to us. </p>
                </div>
                <div class="" style="text-align: right;">
                <button class="btn btn-success text-right" id="thanksbtn">Done</button>
                </div>
              </div>
              
            </div>

          </div>
        </div>

@endsection