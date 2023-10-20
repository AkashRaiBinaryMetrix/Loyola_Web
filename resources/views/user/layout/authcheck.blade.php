@extends('user.layout.app')
@section('content')
<div class="regions-sec">
  <div class="container">
	    <div class="regions-columns">
		 @foreach($categoryall as $cat) 
		 @php 
		 $arr = explode('-',trim($cat->slug)); 
		 if(!empty($arr[0]))
		 {
		 	$text=strtolower($arr[0]);
		 }else
		 {
		 	$text='asia';
		 }
		 @endphp
	    <div class="regions-col">
		  <a href="{{url($cat->slug)}}"><img src="{{asset('public/category/'.$cat->image)}}" alt=""><span class="{{$text}}-text">{{$cat->title}}</span></a>  
		</div>
	  	@endforeach
	  </div>
 </div>		
</div>
	
<div class="full-adsec">
 <div class="container">
   <img src="{{asset('public/images/ad-banner.jpg') }}" alt="">	
 </div>	
</div>	
	
<div class="categories-sec">
	  <div class="container">
		
		  <div id="categories-slider" class="owl-carousel">
           	@if(count($trending)>0)
			@foreach($trending as $key1=>$mycomm)
             <div class="item">
              <div class="catthum-col">
                 <div class="catthum-pic"> <img src="{{ asset('public/images/slide-1.jpg') }}" alt=""> </div>
                 <div class="catthum-name"><h3><a href="{{route('post.community.post',$mycomm->title)}}">{{$mycomm->title}}</a></h3><p><a href="javascript:void">@if(strlen(strip_tags($mycomm->description))>50) {{strip_tags(substr($mycomm->description,0,50))}}.... @else {{strip_tags($mycomm->description)}} @endif</a></p></div>
                </div>
              </div>
			@endforeach
			@endif
			  
          </div><!--owl slider--> 
		  
	  </div>
	</div>	
	
<div class="main-wrapper">
  <div class="container">
	<div class="row flex-md-row-reverse">
	  
		<div class="col-md-4 custom-4col">
		  <div class="main-rightsec">
			  
			<div class="right-main-col">
			  <div class="right-main-title"><div class="leftsode-ico green-bg"><img src="{{asset('public/images/communities-ico.png')}}" alt=""></div>@if(!empty(\Session::get('user'))) My  Communities @else Community @endif</div>  
			  
			  <div class="communties-thumb">
			@if(count($mycommunity)>0)
				@foreach($mycommunity as $key1=>$mycomm)
				
				@if($key1!=5)
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
			
			<div class="right-main-col poll-col">
			  <div class="right-main-title"><div class="leftsode-ico blue-bg"><img src="{{asset('public/images/poll-ico.png')}}" alt=""></div>Poll of the Month</div>
				
			  <div class="poll-inner">
			    <div class="poll-pic">
			    	@if(!empty($poll->media))
			    	 @if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
                      <img src="{{asset('public/poll/'.$poll->media)}}" id="imgcom" >
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
			
			<div class="create-post">
			  <a href="{{route('create.post')}}">
				<div class="userpic"><img src="{{asset('public/images/user-pic.jpg')}}" alt=""></div>
				<div class="create-homeform">
				<div class="create-pst">Create Post</div>
				<div class="create-ico">Add Media <img src="{{asset('public/images/add-media-icon.png')}}" alt=""></div>	
			
				</div>  
			  </a>  
			</div>  
			  
			<div class="trending-bar">
			  <div class="hot-box active-box"><a href="{{route('home.dashboard')}}"><i class="las la-burn"></i> Hot</a></div>
			  <!-- <div class="hot-box active-box">
				  <div class="dropdown">
				  <button class="location-box dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="las la-globe"></i> USA
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="javascript:void">Africa</a>
					<a class="dropdown-item" href="javascript:void">Asia</a>
					<a class="dropdown-item" href="javascript:void">Australia</a>
				  </div>
				   </div>
			  </div> -->
				
			  <div class="hot-box"><a href="{{route('home.dashboard')}}"><i class="lar la-star"></i> New</a></div>
			  <div class="hot-box"><a href="{{route('post.trending')}}"><i class="las la-arrow-up"></i> Trending</a></div>
			</div>
			<div class="post-sec">
			@if(count($userpost)>0)
				@foreach($userpost as $post)
				@php
			   $user=Session::get('user');
			   if(empty($user))
			   {
			   	$postlike=DB::table('posts_likes')->where('post_id',$post->id)->first();
			   	$userimage=null;
			   }else
			   {
			   	$postlike=DB::table('posts_likes')->where('post_id',$post->id)->where('user_id',$user->id)->first();
			   	$userimage=DB::table('user_detail')->where('user_id',$user->id)->first();
			   	$hidepost=DB::table('post_hide')->where('post_id',$post->id)->where('user_id',$user->id)->where('status',1)->first();
			   }
			     $totallikes=DB::table('posts_likes')->where('post_id',$post->id)->where('like',1)->count();
			     if(is_numeric($post->community_id))
			     {
			     	$community=str_replace(' ','',$post->community);
			     }else
			     {
			     	$usercommunity=DB::table('community')->where('title',$post->community_id)->first();
			     	$community=$usercommunity->title;
			     }

			     $totalcom=DB::table('user_comments')->where('post_id',$post->id)->where('community_id',$post->community_id)->count();
			     if(!empty($post->queoption))
			     {
			     	$options=explode('-',$post->queoption);
			     }else
			     {
			     	$options=array();
			     }
			     $randnum=\Helper::RandNum('5').$post->id;
			   @endphp
			   @if(empty($hidepost))
				<div class="newsfeed-sec" id="hide{{$post->id}}">
			   <div class="newsfeed-top-sec">
				 <div class="left-newstop-col">  
			      <div class="news-userpic"><img src="@if(!empty($post->userimg)) {{asset('public/user/images/'.$post->userimg)}} @else {{asset('public/images/user.png')}} @endif" alt=""></div>
					 
				  <div class="newsfeed-grup">
					 <div class="newsfeed-grupname">
					    <h3><a href="javascript:void">{{($post)?($post->username) ? $post->username:'':''}}</a></h3> <img src="{{ asset('public/images/solid-arrow.png') }}" alt="">
					    <h3><a href="javascript:void">{{$community}}</a></h3>
					  </div>	  
					<div class="newsfeed-time"> <p>{{date('M d, Y',strtotime($post->created_at))}} at {{date('h:m A',strtotime($post->created_at))}}</p></div>
				  </div>
				   
				 </div><!--left-newstop-col-->
				   
				 <div class="right-newstop-col">
				   <div class="post-dots">
					   <div class="dropdown">
						  <button type="button" class="dropdown-toggle" data-toggle="dropdown">
							 <i class="las la-ellipsis-h"></i>
						  </button>
						  <div class="dropdown-menu">
							<a class="dropdown-item" href="javascript:void" onclick="hidepost('{{$post->id}}','1')"><i class="las la-eye-slash"></i> Hide</a>
							<a class="dropdown-item" href="javascript:void"  onclick="report('{{$post->id}}')"><i class="las la-flag"></i> Report</a>
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
			    $totalvotes=DB::table('poll_votes')->where('post_id',$post->id)->where('community_id',$post->community_id)->select('post_id', DB::raw('count(*) as total'))->groupBy('user_id')->get();
			    
			    if(!empty(\Session::get('user')))
			    {
			    	$uservotesingle=DB::table('poll_votes')->where('user_id',\Session::get('user')->id)->where('post_id',$post->id)->where('community_id',$post->community_id)->where('type','radio')->first();
			    	$uservotesmulti=DB::table('poll_votes')->where('user_id',\Session::get('user')->id)->where('post_id',$post->id)->where('community_id',$post->community_id)->where('type','checkbox')->pluck('votes')->toArray();
			    	if(!empty($uservotesingle))
			    	{
			    		$votes=$uservotesingle->votes;
			    	}
			    	if(!empty($uservotesmulti))
			    	{
			    		$votesp=$uservotesmulti;
			    	}
			    }

			    if(!empty($post->post))
		          {
		          	if(strpos($post->post, 'src="..') !== false)
		            {
			          	if(strpos($post->post, '<p>') !== false)
			            {
			              $postdatanewp=str_replace('<p>', '<p style="text-align: center;">', $post->post);
			              
			            }else
			            {
			              $postdatanewp=$post->post;
			            }
			          	if(strpos($postdatanewp, 'class="img-responsive"') !== false)
			            {
			              $postdatanew=str_replace('class="img-responsive"', '', $postdatanewp);
			              
			            }else
			            {
			              $postdatanew=$postdatanewp;
			            }

			            if(strpos($postdatanew, 'src="..') !== false)
			            {
			              $postdata=str_replace('src="..', 'src="'.route('home.dashboard'), $postdatanew);
			              
			            }else
			            {
			              $postdata=$postdatanew;
			            }
			        }else
			        {
			        	$postdata=$post->post;
			        }
		            
		          }else
		          {
		          	$postdata='';
		          }
		          if(!empty($post->media))
		          {
		          	if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
				    {
				    	$media=asset('public/post/'.$post->media);

				    }else if($extension[1]=='mp4')
				    {
				    	$media=asset('public/post/'.$post->media);
				    }
				  }else
				  {
				  	$media=$postdata;
				  }
				  
		            $title=urlencode($post->title);
					$url= urlencode(route('home.dashboard'));
					
					$image='';

               @endphp
			   <input type="hidden" name="" id="post_id" value="{{$post->id}}">
			   <a href="{{route('user.post.comments',[$community,$randnum,$post->slug])}}" class="d-block">
			   <div class="newsfeed-title"><h3>{{ $post->title}}</h3></div> 
			   
			   	@if(!empty($post->post))
				   	{!!$postdata!!}
				   	@endif
				   <div class="newsfeed-mainpic">
				   	@if(!empty($post->type) && $post->type=='post')
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
				    
				   	@else
				   	<div class="poll-inner" style="text-align: left;">
				   	@if(!empty($post->media))
				    <div class="poll-pic"><img src="" alt="" >
				    @if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
						  	<img src="{{asset('public/post_image/'.$post->media)}}" >
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
						  </div>
				    @endif
					<div class="newsfeed-title" >
					  <h3>{{$post->question}}</h3>
					  </div>
						@foreach($options as $key1=>$optn)
						
					  <div class="poll-fields">
					  	@if($post->multiple==1)
					  	@if(!empty(\Session::get('user')))
					  	<input type="checkbox" class=""  name="pollnew{{$post->id}}[]"  value="{{$optn}}"@if(!empty($votesp) && in_array($optn,$votesp)) checked @endif> <label>{{$optn}}</label>
					  	@else
						<input type="checkbox" class=""  name="pollnew{{$post->id}}[]"  value="{{$optn}}"> <label>{{$optn}}</label>
						@endif
						@else
						<div class="custom-control custom-radio">
							@if(!empty(\Session::get('user')))
						  <input type="radio" class="custom-control-input" id="pollv{{$post->id}}" name="pollvote{{$post->id}}"  value="{{$optn}}"@if(!empty($votes) && $votes==$optn) checked @endif><label class="custom-control-label" for="poll{{$key1+80}}">{{$optn}}</label>
						  @else
						  <input type="radio" class="custom-control-input" id="pollv{{$post->id}}" name="pollvote{{$post->id}}"  value="{{$optn}}"><label class="custom-control-label" for="poll{{$key1+80}}">{{$optn}}</label>
						  @endif
						</div>
						 @endif
				      </div>
				      @endforeach
				      
				        @if($post->type=='poll' && $post->multiple==1)
						<button class="sub-btn" type="button" id="subpollvote" onclick="votes('{{$post->id}}','{{$post->community_id}}','checkbox')">Submit</button>
						@elseif($post->type=='poll')
						<button class="sub-btn" type="button" id="subpollvote" onclick="votes('{{$post->id}}','{{$post->community_id}}','radio')">Submit</button>
						@endif
					<div class="poll-count">votes: <strong id="uservote{{$post->id}}">{{count($totalvotes)}}</strong></div>
					
			  </div>
			  
			  @endif
				   </div>
				   <div class="newsfeed-licosh-col">
				   	@if(empty($postlike))
				   	<div class="like-btn" id="unlikediv{{$post->id}}"><a href="javascript:void" onclick="unlikepost('{{$post->id}}')"><img src="{{ asset('public/images/like-ico.png') }}" alt=""></a>@if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</div>
				   	@elseif(empty($postlike) && !empty($totallikes))
				   	 <div class="like-btn" id="unlikediv{{$post->id}}"><a href="javascript:void" onclick="unlikepost('{{$post->id}}')"><img src="{{ asset('public/images/like-ico.png') }}" alt=""> @if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</a></div>
				   	@elseif($postlike->like==0)
			     <div class="like-btn" id="unlikediv{{$post->id}}"><a href="javascript:void" onclick="unlikepost('{{$post->id}}')"><img src="{{ asset('public/images/like-ico.png') }}" alt=""> @if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</a></div>
			     
			     @else
			     <div class="like-btn" id="likediv{{$post->id}}"><a href="javascript:void" onclick="likepost('{{$post->id}}')"><img src="{{ asset('public/images/like.png') }}" alt="" style="width:20px;height20px;">@if($totallikes==1)<span >{{$totallikes}} Like</span>@elseif($totallikes>1)<span >{{$totallikes}} Likes</span>@else @endif</a></div>
			      
			     @endif
			     
			     <div class="like-btn" id="unlikediv{{$post->id}}" style="display: none;"><a href="javascript:void" onclick="unlikepost('{{$post->id}}')"><img src="{{ asset('public/images/like-ico.png') }}" alt=""></a><span id="singleun{{$post->id}}"></span><span id="doubleun{{$post->id}}" ></span></div>
			     <div class="like-btn" id="likediv{{$post->id}}" style="display: none;"><a href="javascript:void" id="like" onclick="likepost('{{$post->id}}')"><img src="{{asset('public/images/like.png') }}" alt="" style="width:20px;height20px;"></a><span id="single{{$post->id}}"></span><span id="double{{$post->id}}"></span></div>
				 <div class="comment-btn"><a href="{{route('user.post.comments',[$community,$randnum,$post->slug])}}"><img src="{{ asset('public/images/comment-ico.png') }}" alt=""> {{$totalcom}} Comments</a></div>
				 <input type="hidden" id="url{{$post->id}}" style="display: none;" value="{{route('user.post.comments',[$community,$randnum,$post->slug])}}">
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
				 $url=route('user.post.comments',[$community,$randnum,$post->slug]);
				
				 $img=urlencode($media);

				 $titleweb=urlencode($title);
				 
				 $shareButtons = \Share::page(
		            route('user.post.comments',[$community,$randnum,$post->slug]),
		            'What you are writing, just share to world to learn!!',
		        )
		        ->facebook()
		        ->twitter()
		        ->linkedin()
		        ->telegram()
		        ->whatsapp()        
		        ->reddit();
				 @endphp
				 <ul class="dropdown-menu">
				  <li><a href="javascript:void" onclick="copyToClipboard('#url{{$post->id}}','{{$post->id}}')" class="copy-text" data-clipboard-target="#url{{$post->id}}"><i class="fa fa-link" style="padding-right: 5px;"></i>Copy Link</a></li>
				  <li><a href="http://www.facebook.com/sharer.php?s=100&p[url]=https://binarymetrix-dev.com/ifiwere&p[images][0]={{$img}}&p[title]={{$titleweb}}&p[summary]='If I Were'" target="_blank" target="_blank"><i class="fa fa-facebook-f" style="padding-right: 5px;"></i>Share on Facebook</a></li> 
				  <li><a href="https://twitter.com/share?url={{route('user.post.comments',[$community,$randnum,$post->slug])}}&text=IF I WERE...MAKING THE WORLD A BETTER PLACE check this post" target="_blank"><i class="fa fa-twitter" style="padding-right: 5px;"></i>Share on Twitter</a></li>
				  <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{route('user.post.comments',[$community,$randnum,$post->slug])}}&title=$post->slug&summary=IF I WERE...MAKING THE WORLD A BETTER PLACE check this post&source=IF I WERE...MAKING THE WORLD A BETTER PLACE"><i class="fa fa-linkedin" style="padding-right: 5px;"></i>Share on Linkedin</a></li>
				</ul>
				</a>	
			       <div class="social-icobtns">
			       	  <!-- <div class="fb-share-button" 
						data-href="{{route('home.dashboard')}}" 
						data-layout="button_count">
					   </div> -->
					  
					  <!-- <a onClick="window.open('https://www.facebook.com/sharer.php?u=link','sharer','toolbar=0,status=0,width=550,height=300');" href="javascript: void(0)">
					  	<i class="lab la-facebook-f"></i>
					  </a> -->
					  
					</div>
			   </div>
		     
		   </div>
		   @endif
		   @endforeach
		   @endif	
			  
			</div>  
			  
			
		  </div>
		</div>
		
	</div>
  </div>		
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">

	$(document).ready(function() {
		$.ajax({
	           headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
	            url: "{{route('logincheck')}}",
	            type: 'POST', 
		           data: {data:'user'},
		           success: function( data ) 
		           {
		           	   if(data.status=='true')
		           	   {
			                $('#login-modal').modal();  
		           	   }else if(data.status=='false')
		           	   {
		           	   		
		           	   }
		               
		           }
		       });
    });
</script>

@endsection