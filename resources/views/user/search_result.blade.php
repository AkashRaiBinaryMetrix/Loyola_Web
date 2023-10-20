@extends('user.layout.app')
@section('content')
<div class="main-wrapper">
   <div class="container">
	 
	   <div class="user-account-sec">
	   
	    <div class="accounts-btns">
		  <a href="javascript:void" class="accounts-active" id="postbtn"><div class="profile-ico"><i class="las la-edit"></i></div>Posts</a>
	      <a href="javascript:void" id="commbtn"><div class="profile-ico"><i class="las la-user-friends"></i></div>Communities</a>
		</div>
		   <input type="hidden" name="name" value="{{Request::get('name')}}" id="searchname">
		 <div class="inner-mypost" id="postdiv">
		 	
			@foreach($userpost as $post) 
			@php
			
			if(!empty($post->media))
			{
			   $extension=explode('.',$post->media);
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
	          }
	          $randnum=\Helper::RandNum('5').$post->id;
	          $totallikes=DB::table('posts_likes')->where('post_id',$post->id)->where('like',1)->count();
	          $comments=DB::table('user_comments')->where('post_id',$post->id)->count();
			@endphp
		   <div class="mypost-col">
			   <!-- <div class="mypost-pic"><a href="#"><img src="{{asset('public/images/gaming-post-1.jpg') }}" alt=""></a></div> -->
			  <div class="mypost-content">
			  	<a href="{{route('user.post.comments',[$post->community,$randnum,$post->slug])}}">
				  <div class="mypost-title">
				  	{{$post->title}}
				  	{{$post->question}}
				  </div>
				  	<div class="mypost-title">
				  	@if(!empty($post->media))
				    <div class="poll-pic">
				    @if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
						  	<img src="{{asset('public/post/'.$post->media)}}" class="img-responsive"  style="width: 200px;height150px;">
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
						  </div>
				    @else
				    @if(!empty($post->post))
				  	{!!$postdata!!}
				  	@endif
				  	@endif
				  </div>
				  
				  <div class="mypost-info">
					  <span class="mypost-community"><a href="javascript:void">{{$post->community}}</a></span>
					  <span class="mypost-user">Posted by {{$post->username}}</span>
					  <span class="mypost-time">{{\Carbon\Carbon::parse($post->created_at)->diffForhumans()}}</span>
				  </div>
				  
				  <div class="mypost-btns">
				  	
				    <div class="like-btn"><img src="{{asset('public/images/like-ico.png')}}" alt=""> @if($totallikes==1) {{$totallikes}} Like @elseif($totallikes>1) {{$totallikes}} Likes @else @endif</div>
					 <div class="comment-btn"><img src="{{asset('public/images/comment-ico.png')}}" alt=""> @if($comments==1) {{$comments}} Comment @elseif($comments>1) {{$comments}} Comments @else @endif</div>
					  <div class="share-btn"><a href="#"><img src="{{asset('public/images/share-ico.png')}}" alt=""> Share</a></div>
				  </div>
				  </a>
			  </div>
		   </div>
		   @endforeach
		</div>
		<div class="inner-mypost" id="communtydiv" style="display: none;">
		  
			@foreach($usercommunty as $communty) 
			@php 
			$members=DB::table('community_join')->where('community_id',$communty->id)->where('status',1)->count();
			@endphp
		   <div class="mypost-col" >
			   <div class="mypost-pic"><a href="{{route('community.info',$communty->title)}}">
			  	<img src="{{asset('public/community/'.$communty->image)}}" class="img-responsive"  style="">
			   </div>
			   
			  <div class="mypost-content">
				  <div class="mypost-title"><a href="#" class="blue-text">{{$communty->title}}</a> 
				  	<span></span></div>
				  <div class="mypost-info">
					  <span class=""><a href="javascript:void">{!!$communty->description!!}</a></span>
					  <span class="mypost-user"></span>
				  </div>
				  
				  <div class="mypost-btns">
				      <div class="rply-btn"><a href="#"><i class="las la-user-friends"></i>@if($members==1) {{$members}} Member @elseif($members>1) {{$members}} @else @endif</a></div>
					  
				  </div>
				  </a>
			  </div>
		   </div>
		   @endforeach
		</div>
		@if(count($userpost)==0 && count($usercommunty)==0)
		<div class="inner-mypost" id="noresdiv">
		   <div class="mypost-col">
		   	No Result Found
		   </div>
		</div>
		@endif
		<div class="inner-mypost" id="nodatadiv" style="display: none;">
		   <div class="mypost-col">
		   	No Result Found
		   </div>
		</div>
		  
		 </div>
	   </div>
	   
	</div>	   
</div>
@endsection