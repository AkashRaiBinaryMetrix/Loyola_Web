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

			  <a href="{{route('user.video')}}"><img src="{{asset('public/images/video-ico.png')}}" alt="">Explore Videos</a>  

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

					  <input type="checkbox" class="custom-control-input" id="pollm{{$key}}" name="pollmnew[]" value="{{$polls}}">

					  <label class="custom-control-label" for="pollm{{$key}}">{{$polls}}</label>

					</div>

				  	@else

					<div class="custom-control custom-radio">

					  <input type="radio" class="custom-control-input" id="pollm{{$key}}" name="poll" value="{{$polls}}">

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

			  	@foreach($category as $cat)

				<a href="{{route('all.category')}}">{{$cat->title}}</a> 

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

			<div class="alert alert-success" style="display: none" id="join-community">

		  <strong>Success!</strong> Community joined successfully.

			</div>

			<div class="alert alert-success" style="display: none" id="left-community">

			  <strong>Success!</strong> Community left successfully.

			</div>

			<div class="communities-wrapper">

			  <div class="title-col"><h2 class="title">Discover Communities</h2>

			  <div class="search-inner">

				

					<div class="form-group">

					<input type="text" class="form-control" name="name" id="community" placeholder="Search..." required="">

					</div>

					<button type="button" class="search-ico" onclick="communitydata()"><i class="la la-search"></i></button>	

				

			    </div>

			    </div>

			    <div class="community-columns" id="other-community">

				</div>

			  	<div class="community-columns" id="my-community">

				  <div class="row">

					@foreach($community as $comm)

					@php

					$user=\Session::get('user');

					$member=DB::table('community_join')->where('community_id',$comm->id)->where('status',1)->count();

					if(!empty($user)){

					$memberjoin=DB::table('community_join')->where('community_id',$comm->id)->where('user_id',$user->id)->first();

				     }

					@endphp

					<div class="col-md-4 col-xl-3 col-6">

					  <div class="community-col"><a href="{{route('community.info',$comm->title)}}">

						<div class="community-fig"><img src="{{asset('public/community/'.$comm->image)}}" alt=""></div>

						<div class="community-text">

						  <h4>{{ $comm->title }}</h4></a>

						  <p id="totalmem{{$comm->id}}">@if($member==1) {{$member}} Member @else {{$member}} Members @endif</p>

						  @if(empty($user) || empty($memberjoin))

						  <button type="button" class="comjoin-btn comjoin-btn-active" onclick="join('{{ $comm->id }}','1')" id="joinnew{{$comm->id}}">Join</button>

						  @elseif(!empty($user))

						  @if(!empty($memberjoin) && $memberjoin->status==0)

						  <button type="button" class="comjoin-btn comjoin-btn-active" onclick="join('{{ $comm->id }}','1')" id="joinnew{{$comm->id}}">Join</button>

						  @elseif(!empty($memberjoin) && $memberjoin->status==1)

						  <button type="button" class="comjoin-btn" onclick="join('{{ $comm->id }}','0')" id="leaveidnew{{$comm->id}}">Leave</button>

						  @endif

						  @endif

						   <button type="button" class="comjoin-btn comjoin-btn-active" onclick="join('{{ $comm->id }}','1')" id="join{{$comm->id}}" style="display: none;">Join</button>

						  <button type="button" class="comjoin-btn" onclick="join('{{ $comm->id }}','0')" style="display: none;" id="leaveid{{$comm->id}}">Leave</button>

						</div>

					  </div>  

					</div>  

					@endforeach

					@if(count($community)==0)

					<p>No Community Found</p>

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