@extends('user.layout.app')
@section('content')
<div class="main-wrapper">
  <div class="container">
  	<div class="breadcrum">
			    <ol class="breadcrumb">
			    @if(!empty($continentname)) 
					<li class="breadcrumb-item"><a href="javascript:void">{{$continentname->name}}</a></li>
					@endif
					@if(!empty($categoryname)) 
					<li class="breadcrumb-item"><a href="javascript:void">{{$categoryname->title}}</a></li>
					@endif
					@if(!empty($subcategoryname)) 
					<li class="breadcrumb-item"><a href="javascript:void">{{$subcategoryname->name}}</a></li>
					@endif
					<li class="breadcrumb-item"><a href="javascript:void">{{$community->title}}</a></li>
			    </ol>
			</div>
	<div class="row flex-md-row-reverse">
	  
		<div class="col-md-4 custom-4col">
		  <div class="main-rightsec">
			  
			<div class="right-main-col">
			  <div class="right-main-title"><div class="leftsode-ico green-bg"><img src="{{asset('public/images/communities-ico.png')}}" alt=""></div>@if(!empty(\Session::get('user'))) My Communities @else Community @endif</div>  
			  
			  <div class="communties-thumb">
			    @if(count($mycommunity)>0)
				@foreach($mycommunity as $key=>$mycomm)
				@if($key!=8)
			    <a href="@if(!empty($mycomm->title)){{route('community.info',$mycomm->title)}}@endif"><span class="community-pic"><img src="{{asset('public/community/'.$mycomm->image)}}" alt=""><b>{{$mycomm->title}}</b></span></a>
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
			
			<div class="video-col">
			  <a href="{{route('user.video')}}"><img src="{{asset('public/images/video-ico.png')}}" alt=""> Explore Videos</a>  
			</div>  
			  
			<div class="create-community-col">
			  <a href="{{route('user.create.community')}}"><img src="{{asset('public/images/create-comunity-pic.png')}}" alt=""></a>  
			</div>  
			<div class="create-community-col">
			  <a href="javascript:void" data-toggle="modal" data-target="#Message-modal"><img src="{{asset('public/user/contact-category.jpg')}}" alt=""></a>  
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
					<button class="btn btn-success" type="button" id="subpoll" onclick="pollvotes('{{$poll->id}}','checkbox')">Submit</button>
					@else
					<button class="btn btn-success" type="button" id="subpoll" onclick="pollvotes('{{$poll->id}}','radio')">Submit</button>
					@endif
					<div class="poll-count">votes: <strong id="totalvote">{{$totalvotes}}</strong></div>  
				  </div>	
					
				</div>	
			  </div>
				
			</div>  
			  @if(count($category)>0)
			<div class="right-main-col">
			  <div class="right-main-title"><div class="leftsode-ico orange-bg"><img src="{{asset('public/images/communities-ico.png')}}" alt=""></div>Categories</div>  
			  <div class="category-thumb">
			  	@foreach($category as $key=>$cat)
			  	@if($key!=8)
				<a href="{{route('all.category')}}">{{$cat->title}}</a>
				@endif 
				@endforeach
			  </div>	
			<div class="view-btn"><a href="{{route('all.category')}}">View All</a></div>		
			</div> 
			@endif 
			  
			<div class="right-ad"><img src="{{asset('public/images/right-ad.jpg')}}" alt="" class="img-responsive"></div>  
			  
			  
		  </div><!--main-rightsec-->
		
		</div>
		
		<div class="col-md-8 custom-8col">
			
		  <div class="mainleft-sec">
			
			<div class="post-sec">
				
			  <div class="community-cover">
				<div class="community-coverpic">
					<img src="{{asset('public/community_image/'.$community->cover_image)}}" alt="" style="max-height: 300px;object-fit: cover;">
				</div>
				<div class="inner-community-cover">
				  <div class="row">
					<div class="col-sm-3"><div class="com-tmember">@if($totalmember==1) <strong id="totalmem{{$community->community_id}}">{{$totalmember}} Member </strong> @else <strong>{{$totalmember}}</strong> Members @endif</div></div>
					  
					<div class="col-sm-6 text-center">
						<div class="com-profile">
						  <div class="com-profilepic">
						  	<img src="{{asset('public/community_image/'.$community->image)}}" alt="" style="object-fit: cover;">
						  </div>
						  <div class="com-profilename">{{$community->title}}</div>	
						</div>
					</div>
					  @php
					$user=\Session::get('user');
					if(!empty($user)){
					$memberjoin=DB::table('community_join')->where('community_id',$community->community_id)->where('user_id',$user->id)->first();
				     }

					@endphp
					<div class="col-sm-3 text-sm-right">
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
					
				  <div class="cover-text">{!!$community->description!!}</div>	
				</div>  
			  </div>
			  @if(!empty(\Session::get('user')) && !empty($memberjoin) && $memberjoin->status==1)
				 <div class="create-post">
				  <a href="{{route('postcreate',$community->title)}}">
					<div class="userpic"><img src="{{asset('public/images/user-pic.jpg')}}" alt=""></div>
					<div class="create-homeform">
					<div class="create-pst">Create Post</div>
					<div class="create-ico">Add Media <img src="{{asset('public/images/add-media-icon.png')}}" alt=""></div>	
					</div>  
				  </a>  
				</div>
				@endif
			
				@if(count($userposts)>0)
				@foreach($userposts as $post)
				@php

				if(empty($post->user_id))
			   {
			   	$postlike=DB::table('posts_likes')->where('post_id',$post->id)->first();
			   	$userimage=null;
			   }else
			   {
			   	$postlike=DB::table('posts_likes')->where('post_id',$post->id)->where('user_id',$post->user_id)->first();
			   	$userimage=DB::table('user_detail')->where('user_id',$post->user_id)->first();
			   }
			     $totallikes=DB::table('posts_likes')->where('post_id',$post->id)->where('like',1)->count();
			     $communityid=str_replace(' ','',$community->title);
			     $totalcom=DB::table('user_comments')->where('post_id',$post->id)->where('community_id',$post->community_id)->count();
			     $username=DB::table('users')->where('id',$post->user_id)->first(); 
                 
			     @endphp
			  <div class="newsfeed-sec">  
			   <div class="newsfeed-top-sec">
				 <div class="left-newstop-col">  
			      <div class="news-userpic">
			      	<img src="@if(!empty($userimage->image)) {{asset('public/user/images/'.$userimage->image)}} @else {{asset('public/images/user.png')}} @endif"  alt="">
			      </div>
					 
				  <div class="newsfeed-grup">
					 <div class="newsfeed-grupname">
					    <h3><a href="#">@if(!empty($username->name)) {{$username->name}} @endif</a></h3> <img src="{{asset('public/images/solid-arrow.png')}}" alt="">
					    <h3><a href="#">{{$community->title}}</a></h3>
					  </div>	  
					<div class="newsfeed-time"><p>{{ date('M d, Y'),strtotime($post->created_at) }} at {{ date('h:m A'),strtotime($post->created_at) }}</p></div>
				  </div>
				   
				 </div><!--left-newstop-col-->
				   
				 <div class="right-newstop-col">
				     
				   <div class="post-dots">
					   <div class="dropdown">
						  <button type="button" class="dropdown-toggle" data-toggle="dropdown">
							 <i class="las la-ellipsis-h"></i>
						  </button>
						  <div class="dropdown-menu">
							<a class="dropdown-item" href="#"><i class="las la-eye-slash"></i> Hide</a>
							<a class="dropdown-item" href="#"><i class="las la-flag"></i> Report</a>
						  </div>
						</div>
				   </div>
				 </div> 
				   
			   </div>
				 <div class="newsfeed-title"><h3>{{ $post->title}}</h3></div> 
				<a href="javascript:void" class="d-block">  
				   <div class="newsfeed-mainpic">{!!$post->post!!}</div>
				   <div class="newsfeed-licosh-col">
				   	 @php
					     $randnum=\Helper::RandNum('5').$post->id;
		              @endphp
			     
				   	@if(empty($postlike))

				   	<div class="like-btn" id="unlikediv"><a href="{{route('user.post.comments',[$communityid,$randnum,$post->slug])}}" ><img src="{{ asset('public/images/like-ico.png') }}" alt=""></a>@if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</div>
				   	@elseif(empty($postlike) && !empty($totallikes))
				   	 <div class="like-btn" id="unlikediv"><a href="{{route('user.post.comments',[$communityid,$randnum,$post->slug])}}" ><img src="{{ asset('public/images/like-ico.png') }}" alt=""> @if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</a></div>
				   	@elseif($postlike->like==0)
			     <div class="like-btn" id="unlikediv"><a href="{{route('user.post.comments',[$communityid,$randnum,$post->slug])}}" ><img src="{{ asset('public/images/like-ico.png') }}" alt=""> @if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</a></div>
			     
			     @else
			     <div class="like-btn" id="likediv"><a href="{{route('user.post.comments',[$communityid,$randnum,$post->slug])}}" ><img src="{{ asset('public/images/like.png') }}" alt="" style="width:20px;height20px;">@if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</a></div>
			      
			     @endif
			    
				 <div class="comment-btn"><a href="{{route('user.post.comments',[$communityid,$randnum,$post->slug])}}"><img src="{{ asset('public/images/comment-ico.png') }}" alt=""> {{$totalcom}} Comments</a></div>
				 <div class="share-btn"><img src="{{ asset('public/images/share-ico.png') }}" alt=""> Share</div>  
		   </div>
		   	
			  
			</div> 
			@endforeach
		   @endif	 
			  
			<div class="full-adsec"><img src="{{asset('public/images/ad-banner.jpg')}}" alt=""></div> 
		  </div>
		</div>
		
	</div>
  </div>		
</div>
<div class="modal fade" id="Message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Write to us</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form">
        	<label data-error="wrong" data-success="right" for="form32">Category/Subcategory</label>
          <input type="text" id="user-subject" class="form-control validate">
          <span id="user-sub-error"></span>
        </div>

        <div class="md-form">
        	<label data-error="wrong" data-success="right" for="form8">Your message</label>
          <textarea type="text" id="user-message" class="md-textarea form-control" rows="4"></textarea>
          <span id="user-msg-error"></span>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-success" type="button" id="message-id">Send</i></button>
      </div>
    </div>
  </div>
</div>
@endsection