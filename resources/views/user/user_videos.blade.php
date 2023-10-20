@extends('user.layout.app')
@section('content')
<div class="main-wrapper">
  <div class="container">
	<div class="row flex-md-row-reverse">
	  
		<div class="col-md-4 custom-4col">
		 <div class="main-rightsec">
			  
			<div class="right-main-col">
			  <div class="right-main-title"><div class="leftsode-ico green-bg"><img src="{{asset('public/images/communities-ico.png')}}" alt=""></div>@if(!empty(\Session::get('user'))) My  Communities @else Community @endif</div>  
			  
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
			  @if(count($category)>0)
			<div class="right-main-col">
			  <div class="right-main-title"><div class="leftsode-ico orange-bg"><img src="{{asset('public/images/communities-ico.png')}}" alt=""></div>Categories</div>  
			  <div class="category-thumb">
			  	@foreach($category as $cat)
				<a href="javascript:void">{{$cat->title}}</a> 
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
			
			<div class="communities-wrapper">
				
			  <div class="title-col"><h2 class="title">Our Videos</h2></div>	
				
			 <div class="videos-page">
			   <div class="row">
			   	@if(count($videos)>0)
				 @foreach($videos as $vdo)
				 @php
				 $oldurl=explode('/', $vdo->url);
				 $oldurl1=explode('=', $vdo->url);
                 $newurl='https://www.youtube.com/embed/'.end($oldurl1);
				 @endphp
				   <div class="col-md-6 col-sm-6">
					  <div class="videos-col"> 
				     <iframe height="220" src="{{$newurl}}" title="{{$vdo->title}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					  </div>	  
				   </div>
				   @endforeach
				   @endif
				 
			   </div>	
			 </div>
				
				
			</div>  
			  
			<div class="full-adsec"><img src="{{asset('public/images/ad-banner.jpg')}}" alt=""></div> 
			  
			
		  </div>
		</div>
		
	</div>
  </div>		
</div>
@endsection