@extends('user.layout.app')
@section('content')
<div class="main-wrapper">
   <div class="container">
	 
	   <div class="user-account-sec">
	   
	    <div class="accounts-btns">
		  <a href="javascript:void"><div class="profile-ico"><i class="las la-user"></i></div> My Profile</a>   
		  <a href="{{route('user.my.post')}}" class="accounts-active"><div class="profile-ico"><i class="las la-edit"></i></div> My Post</a>
		  <a href="{{route('user.activity')}}"><div class="profile-ico"><i class="las la-list-alt"></i></div> Activity Log</a>
	      <a href="{{route('my.community')}}"><div class="profile-ico"><i class="las la-user-friends"></i></div> My Communities</a>
		  <a href="{{route('user.invite.friends')}}"><div class="profile-ico"><i class="las la-user-plus"></i></div> Invite Friends</a>		
		</div>
		   
		 <div class="inner-mypost">
		   <div class="mypost-col" id="delete{{$posts->id}}">
			   <!-- <div class="mypost-pic"><a href="#"><img src="{{asset('public/images/gaming-post-1.jpg') }}" alt=""></a></div> -->
			  <div class="mypost-content">
			  	<a href="{{route('user.post.comments',[$commuity->title,$randnum,$posts->slug])}}">
				  <div class="mypost-title">
				  	{{$posts->title}}
				  </div>
				  	<div class="mypost-title">
				  	@if(!empty($posts->media))
				    <div class="poll-pic">
				    @if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
						  	<img src="{{asset('public/post/'.$posts->media)}}" class="img-responsive"  style="">
						  	@elseif($extension[1]=='mp4')
						  		<video width="320" height="240" controls>
							  <source src="{{asset('public/post/'.$posts->media)}}" type="video/mp4">
							  <source src="{{asset('public/post/'.$posts->media)}}" type="video/ogg">
							Your browser does not support the video tag.
							</video> 
						  	@elseif($extension[1]=='ogg')
						  		<audio controls>
							  <source src="{{asset('public/post/'.$posts->media)}}" type="audio/ogg">
							  <source src="{{asset('public/post/'.$posts->media)}}" type="audio/mpeg">
							Your browser does not support the audio element.
							</audio> 
						  	@endif
						  </div>
				    @else
				  	{!!$postdata!!}
				  	@endif
				  </div>
				  </a>
				  <div class="mypost-info">
					  <span class="mypost-community"><a href="javascript:void">{{$commuity->title}}</a></span>
					  <span class="mypost-user">Posted by {{ \Session::get('user')->name }}</span>
					  <span class="mypost-time">{{ $time }}</span>
				  </div>
				  
				  <div class="mypost-btns">
				  	
				    <div class="like-btn"><img src="{{asset('public/images/like-ico.png')}}" alt=""> @if($totallikes==1) {{$totallikes}} Like @elseif($totallikes>1) {{$totallikes}} Likes @else @endif</div>
					 <div class="comment-btn"><img src="{{asset('public/images/comment-ico.png')}}" alt=""> @if($comments==1) {{$comments}} Comment @elseif($comments>1) {{$comments}} Comments @else @endif</div>
					  <div class="share-btn"><a href="#"><img src="{{asset('public/images/share-ico.png')}}" alt=""> Share</a></div>
					  @if(!empty($posthide))
					  <div class="share-btn"><a href="javascript:void" onclick="hidepost('{{$posts->id}}','0')"><i class="las la-eye-slash"></i>Unhide</a></div>
					  @endif
					 <div class="edit-btn"><a href="{{route('edit.post',$randnum)}}"><i class="las la-edit"></i> Edit</a></div>
					 <div class="delete-btn"><a href="javascript:void"   onclick="deletepost('{{$posts->id}}')"><i class="las la-trash-alt"></i> Delete</a></div> 
				  </div>
			  </div>
		   </div>
		 </div>   
		 
	   </div>
	   
	</div>	   
</div>
@endsection