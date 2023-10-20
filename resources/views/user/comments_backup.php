@extends('user.layout.app')
@section('content')
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

</style>
<div class="main-wrapper">
  <div class="container">
	<div class="row flex-md-row-reverse">
	  
		<div class="col-md-4 custom-4col">
		  <div class="main-rightsec">
			 
			<div class="right-main-col">
				<div class="community-coverpic"><img src="{{asset('public/community/'.$community->image)}}" alt=""></div>
				<div class="inner-community-cover">
					
					<div class="text-center">
						<div class="com-profile">
						  <div class="com-profilepic"><img src="{{asset('public/community/'.$community->image)}}" alt=""></div>
						  <div class="com-profilename">{{$community->title}}</div>	
						</div>
					</div>
					
				  <div class="group-link"><a href="{{route('community.info',$community->title)}}">{{route('community.info',$community->title)}}</a></div>
					
				  <div class="row">
					<div class="col-sm-6"><div class="com-tmember">@if($member==1) <strong id="totalmem{{$community->id}}">{{$member}} Member </strong> @else <strong>{{$member}}</strong> Members @endif</div></div>
					  
					<div class="col-sm-6"><div class="com-tmember float-right"><strong>{{date('M, d Y'),strtotime($community->created_at)}}</strong>Created date</div></div>   
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
						  <button type="button" class="comjoin-btn" onclick="join('{{ $community->id }}','1')" id="joinnew{{$community->id}}">Join</button>
						@elseif(!empty($user) && $memberjoin->status==0)
						  <button type="button" class="comjoin-btn" onclick="join('{{ $community->id }}','1')" id="joinnew{{$community->id}}">Join</button>
						  @elseif(!empty($user) && $memberjoin->status==1)
						  <button type="button" class="comjoin-btn" onclick="join('{{ $community->id }}','0')" id="leaveidnew{{$community->id}}">Leave</button>
						  @endif
						   <button type="button" class="comjoin-btn" onclick="join('{{ $community->id }}','1')" id="join{{$community->id}}" style="display: none;">Join</button>
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
                        <video width="220" height="140" controls>
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
					  <input type="checkbox" class="custom-control-input" id="pollm{{$key}}" name="pollmnew[]" onchange="pollvotes('{{$key}}','{{$poll->id}}','checkbox')" value="{{$polls}}">
					  <label class="custom-control-label" for="pollm{{$key}}">{{$polls}}</label>
					</div>
				  	@else
					<div class="custom-control custom-radio">
					  <input type="radio" class="custom-control-input" id="pollm{{$key}}" name="poll" onchange="pollvotes('{{$key}}','{{$poll->id}}','radio')" value="{{$polls}}">
					  <label class="custom-control-label" for="pollm{{$key}}">{{$polls}}</label>
					</div>
					@endif
					@endforeach
					<div class="poll-count">votes: <strong id="totalvote">{{$totalvotes}}</strong></div>  
				  </div>	
					
				</div>	
			  </div>
				
			</div>   
			    
			  
			<div class="right-ad"><img src="{{asset('public/images/right-ad.jpg')}}" alt="" class="img-responsive"></div>  
			  
			  
		  </div><!--main-rightsec-->
		
		</div>
		
		<div class="col-md-8 custom-8col">
		  <div class="mainleft-sec">
			
			<div class="post-sec">
				
			  <div class="newsfeed-sec">
				  
			   <div class="newsfeed-top-sec">
				 <div class="left-newstop-col">  
			      <div class="news-userpic"><img src="@if(!empty($userimage->image)) {{asset('public/user/images/'.$userimage->image)}} @else {{asset('public/images/user.png')}} @endif" alt=""></div>
					 
				  <div class="newsfeed-grup">
					 <div class="newsfeed-grupname">
					    <h3><a href="#">{{$post->username}}</a></h3> <img src="{{asset('public/images/solid-arrow.png')}}" alt="">
					    <h3><a href="#">{{$post->community}}</a></h3>
					  </div>	  
					<div class="newsfeed-time"> <p>{{date('M d, Y'),strtotime($post->created_at)}} at {{date('h:m A'),strtotime($post->created_at)}}</p></div>
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
			     $totalvotes=DB::table('poll_votes')->where('post_id',$post->id)->where('community_id',$post->community_id)->select('post_id', DB::raw('count(*) as total'))->groupBy('user_id')->get();
			   @endphp
				<a href="javascript:void" class="d-block">  
			   <div class="newsfeed-title"><h3>{{$post->title}}</h3></div> 
			   <div class="">
			   	<!-- <img src="{{asset('public/images/gaming-post-1.jpg')}}" alt=""> -->
			      @if(!empty($post->media))
				   	@if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
						  	<img src="{{asset('public/post/'.$post->media)}}" id="imgcom" >
						  	@elseif($extension[1]=='mp4')
						  		<video width="320" height="240" controls>
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
				    @elseif(!empty($post->post))
				   	{!!$postdata!!}
				   	@endif
				   	<div class="newsfeed-title" >
					  <h3>{{$post->question}}</h3>
					  </div>
						@foreach($options as $key1=>$optn)
						
					  <div class="poll-fields">
					  	@if($post->multiple==1)
					  	@if(!empty(\Session::get('user')))
					  	<input type="checkbox" class=""  name="pollnew[]" onchange="votes('{{$key1+9}}','{{$post->id}}','{{$post->community_id}}','checkbox')" value="{{$optn}}"@if(!empty($votesp) && in_array($optn,$votesp)) checked @endif> <label>{{$optn}}</label>
					  	@else
						<input type="checkbox" class=""  name="pollnew[]" onchange="votes('{{$key1+9}}','{{$post->id}}','{{$post->community_id}}','checkbox')" value="{{$optn}}"> <label>{{$optn}}</label>
						@endif
						@else
						<div class="custom-control custom-radio">
							@if(!empty(\Session::get('user')))
						  <input type="radio" class="custom-control-input" id="poll{{$key1+8}}" name="poll" onchange="votes('{{$key1+8}}','{{$post->id}}','{{$post->community_id}}','radio')" value="{{$optn}}"@if(!empty($votes) && $votes==$optn) checked @endif><label class="custom-control-label" for="poll{{$key1+8}}">{{$optn}}</label>
						  @else
						  <input type="radio" class="custom-control-input" id="poll{{$key1+8}}" name="poll" onchange="votes('{{$key1+8}}','{{$post->id}}','{{$post->community_id}}','radio')" value="{{$optn}}"><label class="custom-control-label" for="poll{{$key1+8}}">{{$optn}}</label>
						  @endif
						</div>
						 @endif
				      </div>
				      @endforeach	
					<div class="poll-count">votes: <strong id="uservote{{$post->id}}">{{count($totalvotes)}}</strong></div>
				
			   </div>
			   <div class="newsfeed-licosh-col">
			     
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
				 <div class="comment-btn"><img src="{{asset('public/images/comment-ico.png')}}" alt=""> {{count($postcomment)}} Comments</div>
				 <div class="share-btn"><img src="{{asset('public/images/share-ico.png')}}" alt=""> Share</div>  
			   </div>
		     </a>
				  <form method="post" action="{{route('user.comments.post')}}" enctype="multipart/form-data" id="commform">
				  	@csrf
				  	<input type="hidden" name="community_id" value="{{$post->community_id}}">
				  	<input type="hidden" name="post_id" value="{{$post->id}}">
			  <div class="postcomment-sec">
			  					@if(!empty(Session::get('user')))
				<div class="username">Comment as <a href="#">{{Session::get('user')->name}}</a></div>  
				@endif
				@if(!empty(Session::get('user')))
				
				<div class="col-12">
				  <div class="form-group media-profile">
				  	<div class="create-addpost">
					<h4>Add Media to your comment</h4> 
					<div class="create-media">
					  <img class="media-pic" src="{{asset('public/images/image-ico.png')}}" alt="">
					  <img class="media-pic" src="{{asset('public/images/create-video-ico.png')}}" alt="">
					  <img class="media-pic" src="{{asset('public/images/mic-ico.png')}}" alt="">
					  <input class="file-upload" name="media" type="file" accept="audio/*,video/*,image/*" style="display: none;" id="file" onchange="previewimg(this)"/>	
					</div> 
				   </div>
				 </div>
					
				  </div>
				</div>
				<div class="drop-zone" id="imgsec" style="display: none;">
				    <span class="drop-zone__prompt"></span>
				    <img id="blah" style="max-height: 150px;text-align: center;">
				    <a href="javascript:void" data-toggle="modal" data-target="#video-modal"><video style="max-width: 100px;text-align: center;display: none;" controls id="videoid"><source src="" type="video/mp4"></video></a>
				    <video style="max-height: 150px;text-align: center;display: none;" controls id="audid"><source src="" type="audio/ogg"></video>
				    <!-- <input type="file" name="myFile" class="drop-zone__input"> -->
				    
				    </div>
				<div class="editor-sec" id="titletxtsec" style="display: none;">
					<input type="text" class="form-control" placeholder="Add Caption" id="titletxt" style="display: none;margin-top: 5px;" name="title"> 
				</div>

				<div class="editor-sec" id="editor-sec">
				   <textarea class="form-control full-featured-non-premium" name="comment" id=""></textarea> 
				 </div>  
				  <span id="commac" style="margin-top: 5px;"></span>
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
				 <div class="form-group mb-1 mt-4 submit-col text-md-right">
				 	<button class="common-btn" id="spinbtn" style="display: none;">
					  <span class="spinner-border spinner-border-sm"></span>
					</button>
			        <button type="submit" class="common-btn" id="commentbtn">Post</button>
			    </div>
			</form>

			    @else
			    <div class="login-btns" style="margin-bottom: 20px;text-align: center;">
			    	<p>Log in or sign up to leave a comment</p>
			   
					<div class="common-btn common-btn-border login-btn" data-toggle="modal" data-target="#login-modal"><i class="las la-user"></i> Sign In</div>
					<div class="common-btn signup-btn" data-toggle="modal" data-target="#signup-modal"><i class="las la-user-plus"></i> Sign Up</div>
				</div>
			    @endif 
				 
				 
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
				 
				  @foreach($postcomment as $key=>$comm)
				  @php

				  $time=\Carbon\Carbon::parse($comm->created_at)->diffForhumans();
				  $userimg=DB::table('user_detail')->where('user_id',$comm->user_id)->first();
				  if(!empty(\Session::get('user')))
				  {
				  $commlike=DB::table('comments_like')->where('comment_id',$comm->id)->where('user_id',\Session::get('user')->id)->first();
				  }
				  $totalcommlike=DB::table('comments_like')->where('comment_id',$comm->id)->where('like',1)->count();
				  $usercomment=DB::table('comment_reply')
				              ->leftjoin('users','users.id','comment_reply.user_id')
				              ->leftjoin('user_detail','user_detail.user_id','users.id')
				              ->select('comment_reply.*','users.name','user_detail.image')
				              ->where('comment_reply.community_id',$comm->community_id)
				              ->where('comment_reply.post_id',$comm->post_id)
				              ->where('comment_reply.comment_id',$comm->id)
				              ->orderBy('comment_reply.id','DESC')
				              ->groupBy('comment_reply.id')
				              ->get();
				              
				  @endphp
				  <div class="usercomment-col">
					   <div class="usercomment-pic"><img src="@if(!empty($userimg->image)) {{asset('public/user/images/'.$userimg->image)}} @else {{asset('public/images/user.png')}} @endif" alt="" ></div>
					   <div class="usercomment-content">
						  <div class="usercomment-name" ><span >{{$comm->username}}</span> <span >{{$time}}</span></div> 
						  <div class="usercomment-text" >
						  	
						  	@if(!empty($comm->comment))
						  	{!! $comm->comment!!}
						  	@elseif(!empty($comm->media))
						  		@php
						  		 $extension=explode('.',$comm->media);
						  		 
						  		@endphp
						  	@if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
						  	<img src="{{asset('public/comment/'.$comm->media)}}" id="imgcom" style="max-height:150px;margin-bottom: 10px;">
						  	@elseif($extension[1]=='mp4')
						  		<video width="220" height="140" controls style="margin-bottom: 10px;">
							  <source src="{{asset('public/comment/'.$comm->media)}}" type="video/mp4">
							  <source src="{{asset('public/comment/'.$comm->media)}}" type="video/ogg">
							Your browser does not support the video tag.
							</video> 
						  	@elseif($extension[1]=='ogg')
						  		<audio controls style="margin-bottom: 10px;">
							  <source src="{{asset('public/comment/'.$comm->media)}}" type="audio/ogg">
							  <source src="{{asset('public/comment/'.$comm->media)}}" type="audio/mpeg">
							Your browser does not support the audio element.
							</audio> 
						  	@endif
						  	
						  	@endif
						  	<p>{{$comm->title}}</p>
						  </div>
						 <div class="usercomment-btns">
						 	@if(empty($commlike))
						   <a href="javascript:void" onclick="likecomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','1')" id="like-comm-id{{$comm->id}}"><img src="{{asset('public/images/like-ico.png')}}" alt="" >@if($totalcommlike!=0) {{$totalcommlike}} @endif
						   	</a>
						   	@elseif(!empty($commlike) && $commlike->like==0)
						   	<a href="javascript:void" onclick="likecomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','1')" id="like-comm-id{{$comm->id}}"><img src="{{asset('public/images/like-ico.png') }}" alt="" style="width:20px;height:20px;">@if($totalcommlike!=0) {{$totalcommlike}} @endif</a>
						   	@elseif(!empty($commlike) && $commlike->like==1)
						   	<a href="javascript:void" onclick="likecomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','0')" id="unlike-comm-id{{$comm->id}}"><img src="{{asset('public/images/like.png') }}" alt="" style="width:20px;height:20px;">@if($totalcommlike!=0) {{$totalcommlike}} @endif</a>
						   	@endif
						   	 <a href="javascript:void" onclick="likecomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','1')" style="display: none;" id="like-comm-id{{$comm->id}}"><img src="{{asset('public/images/like-ico.png')}}" alt="" style="width:20px;height:20px;"><span id="total-count-unlike{{$comm->id}}"></span>
						   	</a>
						   	<a href="javascript:void" onclick="likecomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','0')" style="display: none;" id="unlike-comm-id{{$comm->id}}"><img src="{{asset('public/images/like.png') }}" alt="" style="width:20px;height:20px;"><span id="total-count-like{{$comm->id}}"></span></a>
						   <a href="javascript:void" onclick="replysec('{{$comm->id}}','{{$key}}')">Reply</a>
						   <a href="javascript:void" onclick="report('{{$comm->id}}','{{$comm->community_id}}','{{$post->id}}')">Report</a>	 
						 </div>  
							 <div class="editor-sec" id="reply-sec{{$key}}" style="margin-top: 15px;display: none;">
							   <textarea class="form-control full-featured-non-premium" name="comment" id="comment-reply-sec{{$key}}"></textarea>
							    
								 	<button class="common-btn" id="spin-reply-btn{{$key}}" style="display: none;float: right;margin-top: 10px;">
									  <span class="spinner-border spinner-border-sm"></span>
									</button>
							        <button type="button" class="common-btn" id="postbtn{{$key}}" style="float: right;margin-top: 10px;" onclick="postreply('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','{{$key+1}}','{{$key}}')">Post</button>
							   
							 </div> 
					   </div>
				   </div>
				   <div id="user-reply-sec{{$key}}">
				   </div>

				   @foreach($usercomment as $key1=>$usercomm)
				   @php
				   if(!empty(\Session::get('user')))
				   {
				      $likereply=DB::table('sub_comment_like')->where('comment_id',$comm->id)->where('reply_id',$usercomm->id)->where('user_id',\Session::get('user')->id)->first();
				   }
				   $totallikecomment=DB::table('sub_comment_like')->where('comment_id',$comm->id)->where('reply_id',$usercomm->id)->where('like',1)->count();
				   @endphp
				   <div class="usercomment-col" style="margin-left: 100px;">
					   <div class="usercomment-pic"><img src="@if(!empty($usercomm->image)) {{asset('public/user/images/'.$usercomm->image)}} @else {{asset('public/images/user.png')}} @endif" alt="" ></div>
					   <div class="usercomment-content">
						  <div class="usercomment-name"><span >{{$usercomm->name}}</span> <span >{{$time}}</span></div> 
						  <div class="usercomment-text">
						  	@if(!empty($usercomm->reply))
						  	{!! $usercomm->reply!!}
						  	@endif
						  </div>
						 <div class="usercomment-btns">
						 	@if(empty($likereply))
						   <a href="javascript:void" onclick="likesubcomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','1','{{$usercomm->id}}')" id="like-sub-comm-id{{$usercomm->id}}"><img src="{{asset('public/images/like-ico.png')}}" alt="" >@if($totallikecomment!=0) {{$totallikecomment}} @endif
						   	</a>
						   	@elseif(!empty($likereply) && $likereply->like==0)
						   	<a href="javascript:void" onclick="likesubcomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','1','{{$usercomm->id}}')" id="like-sub-comm-id{{$usercomm->id}}"><img src="{{asset('public/images/like-ico.png') }}" alt="" style="width:20px;height:20px;">@if($totallikecomment!=0) {{$totallikecomment}} @endif</a>
						   	@elseif(!empty($likereply) && $likereply->like==1)
						   	<a href="javascript:void" onclick="likesubcomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','0','{{$usercomm->id}}')" id="unlike-sub-comm-id{{$usercomm->id}}"><img src="{{asset('public/images/like.png') }}" alt="" style="width:20px;height:20px;">@if($totallikecomment!=0) {{$totallikecomment}} @endif</a>
						   	@endif
						   	 <a href="javascript:void" onclick="likesubcomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','1','{{$usercomm->id}}')" style="display: none;" id="like-sub-comm-id{{$usercomm->id}}"><img src="{{asset('public/images/like-ico.png')}}" alt="" style="width:20px;height:20px;"><span id="total-sub-count-unlike{{$usercomm->id}}" style="margin-left: 5px;"></span>
						   	</a>
						   	<a href="javascript:void" onclick="likesubcomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','0','{{$usercomm->id}}')" style="display: none;" id="unlike-sub-comm-id{{$usercomm->id}}"><img src="{{asset('public/images/like.png') }}" alt="" style="width:20px;height:20px;"><span id="total-sub-count-like{{$usercomm->id}}" style="margin-left: 5px;"></span></a>
						   <a href="javascript:void" onclick="replycommsec('{{$usercomm->id}}','{{$key}}')">Reply</a>
						   <a href="javascript:void" onclick="report('{{$comm->id}}','{{$comm->community_id}}','{{$post->id}}')">Report</a>	 
						 </div>  
							 <div class="editor-sec" id="comment-reply-sec{{$usercomm->id}}" style="margin-top: 15px;display: none;">
							   <textarea class="form-control full-featured-non-premium" name="comment" id="sub-comment-reply-sec{{$usercomm->id}}"></textarea>
							    
								 	<button class="common-btn" id="sub-spin-reply-btn{{$usercomm->id}}" style="display: none;float: right;margin-top: 10px;">
									  <span class="spinner-border spinner-border-sm"></span>
									</button>
							        <button type="button" class="common-btn" id="subpostbtn{{$usercomm->id}}" style="float: right;margin-top: 10px;" onclick="subpostreply('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','{{$key+1}}','{{$key}}','{{$usercomm->id}}')">Post</button>
							   
							 </div> 
					   </div>
				   </div>
				   <div id="user-sub-reply-sec{{$usercomm->id}}">
				   </div>
				   @endforeach
				   
				   @endforeach	

					
				</div>  
				  
				  
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