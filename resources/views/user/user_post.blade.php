@extends('user.layout.app')
@section('content')
<div class="main-wrapper">
   <div class="container">
	 
	   <div class="user-account-sec">
	   
	    <div class="accounts-btns">
		  <a href="{{url('my-profile')}}"><div class="profile-ico"><i class="las la-user"></i></div> My Profile</a>   
		  <a href="{{route('user.my.post')}}" class="accounts-active"><div class="profile-ico"><i class="las la-edit"></i></div> My Post</a>
		  <a href="{{route('user.activity')}}"><div class="profile-ico"><i class="las la-list-alt"></i></div> Activity Log</a>
	      <a href="{{route('my.community')}}"><div class="profile-ico"><i class="las la-user-friends"></i></div> My Communities</a>
		  <a href="{{route('user.invite.friends')}}"><div class="profile-ico"><i class="las la-user-plus"></i></div> Invite Friends</a>		
		</div>
		   
		 <div class="inner-mypost">
			 @foreach($userposts as $posts)
			 @php
			 $commuity=DB::table('community')->where('id',$posts->community_id)->first();
			 $comments=DB::table('user_comments')->where('post_id',$posts->id)->count();
			 $totallikes=DB::table('posts_likes')->where('post_id',$posts->id)->where('like',1)->count();
			 $posthide=DB::table('post_hide')->where('post_id',$posts->id)->where('user_id',\Session::get('user')->id)->where('status','1')->first();
			$date = Carbon\Carbon::parse($posts->created_at);
			$time = $date->diffForHumans(Carbon\Carbon::now());
			 $extension=explode('.',$posts->media);
			 $randnum=\Helper::RandNum('5').$posts->id;
			 if(!empty($posts->post))
	          {
	            if(strpos($posts->post, 'src="..') !== false)
	            {
	              $postdata=str_replace('src="..', 'src="'.route('home.dashboard'), $posts->post);
	              
	            }else
	            {
	              $postdata=$posts->post;
	            }
	          }
	          if(!empty($posts->queoption))
			     {
			     	$options=explode('-',$posts->queoption);
			     }else
			     {
			     	$options=array();
			     }
			     $totalvotes=DB::table('poll_votes')->where('post_id',$posts->id)->where('community_id',$posts->community_id)->select('post_id', DB::raw('count(*) as total'))->groupBy('user_id')->get();
			 @endphp
		   <div class="mypost-col" id="delete{{$posts->id}}">
			   <!-- <div class="mypost-pic"><a href="#"><img src="{{asset('public/images/gaming-post-1.jpg') }}" alt=""></a></div> -->
			  <div class="mypost-content">
			  	<a href="{{route('user.post.comments',[$commuity->title,$randnum,$posts->slug])}}">
				  <div class="mypost-title">
				  	{{$posts->title}}
				  </div>
				  @if(!empty($posts->type) && $posts->type=='post')
				  	<div class="mypost-title">
				  	@if(!empty($posts->media))
				    <div class="poll-pic">
				    @if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
						  	<img src="{{asset('public/post/'.$posts->media)}}" class="img-responsive"  style="max-height: 400px;">
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
				  @endif
				  @if(!empty($posts->queoption))
				  <div class="newsfeed-title" >
					  <h3>{{$posts->question}}</h3>
					</div>
					  
						@foreach($options as $key1=>$optn)
						
					  <div class="poll-fields">
					  	@if($posts->multiple==1)
					  	@if(!empty(\Session::get('user')))
					  	<input type="checkbox" class=""  name="pollnew[]" onchange="votes('{{$key1+9}}','{{$posts->id}}','{{$posts->community_id}}','checkbox')" value="{{$optn}}"@if(!empty($votesp) && in_array($optn,$votesp)) checked @endif> {{$optn}}
					  	@else
						<input type="checkbox" class=""  name="pollnew[]" onchange="votes('{{$key1+9}}','{{$posts->id}}','{{$posts->community_id}}','checkbox')" value="{{$optn}}"> {{$optn}}
						@endif
						@else
						<div class="custom-control custom-radio">
							@if(!empty(\Session::get('user')))
						  <input type="radio" class="custom-control-input" id="poll{{$key1+8}}" name="poll" onchange="votes('{{$key1+8}}','{{$posts->id}}','{{$posts->community_id}}','radio')" value="{{$optn}}"@if(!empty($votes) && $votes==$optn) checked @endif><label class="custom-control-label" for="poll{{$key1+8}}">{{$optn}}</label>
						  @else
						  <input type="radio" class="custom-control-input" id="poll{{$key1+8}}" name="poll" onchange="votes('{{$key1+8}}','{{$posts->id}}','{{$posts->community_id}}','radio')" value="{{$optn}}"><label class="custom-control-label" for="poll{{$key1+8}}">{{$optn}}</label>
						  @endif
						</div>
						 @endif
				      </div>
				      @endforeach	
					<div class="poll-count">votes: <strong id="uservote{{$posts->id}}">{{count($totalvotes)}}</strong></div>
					@endif
				
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
					  @if($posts->type=='post')
					   <div class="edit-btn"><a href="{{route('edit.post',$randnum)}}"><i class="las la-edit"></i> Edit</a>
					   </div>
					 @endif
					 @if($posts->type=='poll')
					   <div class="edit-btn"><a href="{{route('user.edit.poll',$randnum)}}"><i class="las la-edit"></i> Edit</a>
					   </div>
					 @endif

					 <div class="delete-btn"><a href="javascript:void"   onclick="deletepost('{{$posts->id}}')"><i class="las la-trash-alt"></i> Delete</a></div> 
				  </div>
			  </div>
		   </div>
		   @endforeach
		 </div>   
		 
	   </div>
	   
	</div>	   
</div>
@endsection