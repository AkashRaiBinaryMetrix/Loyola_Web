@extends('user.layout.app')
@section('content')
<div class="main-wrapper">
   <div class="container">
	 
	   <div class="user-account-sec">
	   
	    <div class="accounts-btns">
		  <a href="{{url('my-profile')}}"><div class="profile-ico"><i class="las la-user"></i></div> My Profile</a>   
		  <a href="{{route('user.my.post')}}" ><div class="profile-ico"><i class="las la-edit"></i></div> My Post</a>
		  <a href="{{route('user.activity')}}" class="accounts-active"><div class="profile-ico"><i class="las la-list-alt"></i></div> Activity Log</a>
	      <a href="{{route('my.community')}}"><div class="profile-ico"><i class="las la-user-friends"></i></div> My Communities</a>
		  <a href="{{route('user.invite.friends')}}"><div class="profile-ico"><i class="las la-user-plus"></i></div> Invite Friends</a>		
		</div>
		   
		 <div class="inner-mypost">
		 	@if(count($posts)>0)
			@foreach($posts as $post) 
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
	          if(!empty($post->postid))
	          {
	          	$randnum=\Helper::RandNum('5').$post->postid;
	          }
	          
			@endphp
		   <div class="mypost-col">
		   	

			   <div class="mypost-pic">
			   	@if($post->type=='post')
			   	<a href="{{route('user.post.comments',[$post->community,$randnum,$post->slug])}}">
			   	<!-- @if(!empty($post->media))
			   	@if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
			  	<img src="{{asset('public/post/'.$post->media)}}" class="img-responsive"  style="">
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
			  	@else
			  	<div>@if(!empty($postdata)) {!!$postdata!!} @endif</div>
			  	@endif -->
			   	<!-- <img src="{{asset('public/images/gaming-post-1.jpg')}}" alt=""> -->
			   	<img src="{{asset('public/community/'.$post->commimage)}}" alt="">
			   </a>
			   @endif
			   @if($post->type=='community')
			  
			   <img src="{{asset('public/community/'.$post->commimage)}}" alt="">
			   @endif
			</div>
			  <div class="mypost-content">
				  <div class="mypost-title">
				  	@if($post->type=='post')
				  	<a href="{{route('user.post.comments',[$post->community,$randnum,$post->slug])}}" class="blue-text" style="color: inherit;">
				  	@else
				  	<a href="{{route('community.info',$post->community)}}" class="blue-text" style="color: inherit;">
				  	@endif
				  		
				  	<span>{{$post->status}}</span></div></a>
				  <div class="mypost-info">
					  <span class="mypost-community"><a href="javascript:void">{{$post->community}}</a></span>
					  <span class="mypost-user"></span>
					  <span class="mypost-time">{{\Carbon\Carbon::parse($post->postdate)->diffForhumans()}}</span>
				  </div>
				  
				  <div class="activity-posttitle">@if($post->status!='like')  @endif</div>
				  
				  <!-- <div class="mypost-btns">
				      <div class="rply-btn"><a href="#"><i class="las la-reply"></i> Reply</a></div>
					  <div class="share-btn"><a href="#"><img src="{{asset('public/images/share-ico.png')}}" alt=""> Share</a></div>
					 <div class="edit-btn"><a href="#"><i class="las la-edit"></i> Edit</a></div>
					 <div class="delete-btn"><a href="#"><i class="las la-trash-alt"></i> Delete</a></div> 
				  </div> -->
			  </div>
		   </div>
		   @endforeach
		   @else
		   <div class="mypost-col">
		   	No Activity
		   </div>
		   @endif
				 
		  
		 </div>   
		 
	   </div>
	   
	</div>	   
</div>
@endsection