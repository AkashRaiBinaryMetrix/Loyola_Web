<!DOCTYPE HTML>

<html lang="en">

<head>

<meta charset="utf-8">

 <meta name="viewport" content="width=device-width, initial-scale=1">

 <meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{asset('public/images/favicon.png')}}">



<title>IF I WERE (Where your opinion matters)</title>	

<!-- <meta property="og:url"           content="{{route('home.dashboard')}}" />

<meta property="og:type"          content="IF I WERE...MAKING THE WORLD A BETTER PLACE" />

<meta property="og:title"         content="IF I WERE...MAKING THE WORLD A BETTER PLACE" />

<meta property="og:description"   content="IF I WERE...MAKING THE WORLD A BETTER PLACE" />

<meta property="og:image"         content="{{asset('public/images/logo.png')}}" /> -->

@php

$currentURL = Request::url();

$currentroute = \Request::route()->getName();

if($currentroute=='user.post.comments')

{

	$urlnew=explode('/',$currentURL);

	$id=substr($urlnew[6], 5, 6);

       $post=DB::table('user_posts')

             ->leftjoin('users','users.id','user_posts.user_id')

             ->leftjoin('community','community.id','user_posts.community_id')

             ->select('user_posts.*','users.name as username','community.title as community','community.id as community_id')

             ->where('user_posts.id',$id)

             ->first();

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



@php

}

@endphp

	

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

	

<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

	

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">	

	

<!-- Owl Stylesheets -->

<link rel="stylesheet" href="{{asset('public/css/owl.carousel.min.css')}}">

<link rel="stylesheet" href="{{asset('public/css/owl.theme.default.min.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	

	

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->

	

<link rel="stylesheet" href="{{asset('public/css/custom.css')}}" type="text/css" />

</head>

<body>

	<div id="jqxLoader">

@if(!empty(Session::get('user')) || Auth::user())

@php 

if(!empty(Session::get('user')))

{

	$user= Session::get('user');

	$username=DB::table('users')->where('id',$user->id)->first();

  $userimage=DB::table('user_detail')->where('user_id',$user->id)->first();

}else if(!empty(Auth::user()))

{

	$user=Auth::user();

}



 @endphp

<header class="main-header">

	<div class="container">

<div class="row align-items-center">

	

<div class="col-lg-9">	

	<div class="logo-search">

	<div class="main-logo">

		<a href="{{url('/')}}"><img src="{{asset('public/images/logo.png')}}" alt=""> <span>IF I WERE...<i>Where your opinion matters</i></span></a>

	</div>

	

	<div class="top-search">

		<form class="main-search-form" name="cform" method="get" action="{{route('search.news')}}">

			@csrf

			<div class="form-group">

			<input type="text" class="form-control" name="name" id="name" placeholder="Search..." required="">

			</div>

			<button type="submit" class="search-ico"><i class="la la-search"></i></button>	

		</form>

	</div>

	</div>

</div>

	@php

	if(!empty(Session::get('user')))

	{

		$notification=DB::table('user_notification')->where('user_id',Session::get('user')->id)->orderBY('id','DESC')->get();

		$totalnotification=DB::table('user_notification')->where('user_id',Session::get('user')->id)->where('final_status',1)->get();

	}

	@endphp

<div class="col-lg-3">

	<div class="top-noti-user">

		

	  <div class="top-create-icon">

		<a href="{{route('create.post')}}" data-toggle="tooltip" title="Create Post"><i class="las la-plus-circle"></i></a>

	   </div>	

		

	   <div class="top-commu-icon">

		<a href="{{route('all.community')}}" data-toggle="tooltip" title="All Communities"><i class="las la-user-friends"></i></a>

	   </div>

		<div class="top-notify"><i class="las la-bell"></i>@if(count($totalnotification)>0)<span id="notification-count">{{count($totalnotification)}}</span> @endif</div>

	  <div class="top-user-profile avtar-profile">

	 <a href="javascript:void" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="profile-pic" src="@if(!empty($userimage->image)) {{asset('public/user/images/'.$userimage->image)}} @else {{asset('public/images/user.png')}} @endif"  style="max-height: 50px;max-width: 50px;">

	 

	</a>

		

	 <ul class="dropdown-menu">

		  <li><a href="{{url('create-post')}}">Create Post</a></li>

		  <li><a href="{{route('user.create.community')}}">Create Community</a></li> 

		  <li><a href="{{route('my.community')}}">My Communities</a></li>

		  <li><a href="{{url('my-profile')}}">My Profile</a></li>

		  <li><a href="{{route('user.invite.friends')}}">Invite Friends</a></li>

		  @if(!empty(Session::get('user')))<li><a href="{{route('user.change.password',encrypt($user->email))}}">Change password</a></li>@endif

		  <li><a href="{{route('user.logout')}}">Logout</a></li>

		</ul>	

		

	</div>

	

   </div>	

</div>

	

</div>	

	

</div>

</header>

@else

<header class="main-header">

	<div class="container">

<div class="row align-items-center">

	

<div class="col-lg-9">	

	<div class="logo-search">

	<div class="main-logo">

		<a href="{{url('/')}}"><img src="{{asset('public/images/logo.png')}}" alt=""> <span>IF I WERE...<i>Where your opinion matters</i></span></a>

	</div>

	

	<div class="top-search">

		<form class="main-search-form" name="cform" method="get" action="{{route('search.news')}}">

			@csrf

			<div class="form-group">

			<input type="text" class="form-control" name="name" id="name" placeholder="Search..." required="">

			</div>

			<button type="submit" class="search-ico"><i class="la la-search"></i></button>	

		</form>

	</div>

	</div>

</div>

	

<div class="col-lg-3">

	<div class="top-noti-user">

	

	<div class="login-btns">

		<div class="common-btn common-btn-border login-btn" data-toggle="modal" data-target="#login-modal"><i class="las la-user"></i> Sign In</div>

		<div class="common-btn signup-btn" data-toggle="modal" data-target="#signup-modal"><i class="las la-user-plus"></i> Sign Up</div>

	</div>

	

   </div>	

</div>

	

</div>	

	

</div>



</header>

@endif





<div class="notification-wrapper">

  <div id="notification" class="notification-bar">

	<div class="noti-head"><h3>Notifications</h3> 

		<!-- <a href="#">Mark All As Read</a> -->

	</div>

	

	<div class="inner-noti-sec">

      @if(!empty($notification) && count($notification)>0)

		@foreach($notification as $notif)

		@php

		$time=\Carbon\Carbon::parse($notif->created_at)->diffForhumans();

		$post=DB::table('user_posts')->where('id',$notif->post_id)->first();

      	if(!empty($post))

        {

        if(is_numeric($post->community_id))

           {

              $community=str_replace(' ','',$post->community_id);

           }else

           {

              $usercommunity=DB::table('community')->where('title',$post->community_id)->first();

              $community=$usercommunity->title;

           }

           $randnum=\Helper::RandNum('5').$post->id;

        } 

		@endphp

      @if(!empty($post))

      @php

       $url=route('user.post.comments',[$community,$randnum,$post->slug]);

      @endphp

      @if($notif->final_status==0)

	  <div class="noti-col" style="background: aliceblue;">

		<div class="noti-ico"><img src="@if(!empty($notif->user_image)) {{asset('public/user/images/'.$notif->user_image)}} @else {{asset('public/images/user.png')}} @endif" alt=""></div>

		<a href="javascript:void" onclick="getnotification('{{$notif->id}}','{{$url}}')" style="display: block !important;">

		<p>{{$notif->status}}</p>

		<small>{{$time}}</small></a> 

	  </div>

	  @else

	  <div class="noti-col">

		<div class="noti-ico"><img src="@if(!empty($notif->user_image)) {{asset('public/user/images/'.$notif->user_image)}} @else {{asset('public/images/user.png')}} @endif" alt=""></div>

		<a href="javascript:void" onclick="getnotification('{{$notif->id}}','{{$url}}')" style="display: block !important;">

		<p>{{$notif->status}}</p>

		<small>{{$time}}</small></a> 

	  </div>

	  @endif

      @endif

	  @endforeach

      @else



	  <div class="noti-col">

	  	No Notification Found

	  </div>

      @endif

	</div>  

	  

  </div>	

</div><!--notification-wrapper-->	



	

@yield('content')	

	

	

<footer>

 <div class="container">

	<div class="row">

	  <div class="col-md-4">

		 <div class="footer-links">

		   <ul>

			<li><a href="{{url('about-us')}}">About Us</a></li>

			<li><a href="{{url('contact-us')}}">Contact Us</a></li> 

			<li><a href="javascript:void">Help</a></li> 

			<li><a href="{{url('faq')}}">FAQs</a></li> 

			<li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li> 

			<li><a href="{{url('terms-of-use')}}">Terms of Use</a></li>    

		   </ul> 

		  

		 </div>

	  </div>

		

	  <div class="col-md-4">

		<div class="footer-appcol">

		  <div class="footer-title">DOWNLOAD THE APP ON</div>

		  <div class="app-btns">

			  <a href="javascript:void"><img src="{{asset('public/images/app-apple-btn.png')}}" alt=""></a>

			  <a href="javascript:void"><img src="{{asset('public/images/app-play-btn.png')}}" alt=""></a>

			</div>

		</div>

	  </div>

		

	  <div class="col-md-4">

		<div class="footer-social">

		  <div class="footer-title">Follow Us</div>

		  <div class="social-icobtns">

			  <a href="javascript:void"><i class="lab la-facebook-f"></i></a>

			  <a href="javascript:void"><i class="lab la-twitter"></i></a>

			  <a href="javascript:void"><i class="lab la-instagram"></i></a>

			</div>

		</div>

	  </div>	

		

	 

	</div>

 </div>

	

<div class="copyright">

	<div class="container">

		<p>If I Were © {{date('Y')}} | All rights reserved <span>Site Developed by <a href="https://www.binarymetrix.com/" target="_blank" rel="nofollow">BinaryMetrix Technologies</a></span></p>

	</div>

</div>

</footer>	

	

	

<!--Modal: Name-->

    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

          <div class="modal-body mb-0 p-0">

            

             <div class="loginmodal-wrapper">

				 <button type="button" class="close" data-dismiss="modal"><i class="las la-times"></i></button>

			    <div class="row m-0">

				   

				   <div class="col-sm-7 p-0">

					 <div class="login-left">

					  <div class="login-text">

						<h2>Welcome Back,</h2>  

					    <p>Be part of the change your community deserves.</p>

					  </div>	  

					 </div>

				   </div>

				   

				   <div class="col-sm-5 p-0">

					 <div class="login-sec">

						@php

						 $result=app\Helpers\Helper::getCookie();

						 if(!empty($result['email']))

						 {

						 	 $useremail=$result['email'];

						 }else

						 {

						 	  $useremail='';

						 }



						  if(!empty($result['password']))

							{

							 	 $userpass=$result['password'];

							}else

							{

								 $userpass='';

							}

						 @endphp

						<h3>Sign In</h3>

						<div id="loginerror"></div>

						<form class="login-form"  id="loginform" >

							@csrf

						<div class="form-group">

							<input class="form-control" placeholder="Email Address" type="email" name="Email" id="emaillogin" value="{{$useremail}}" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">

							<div class="login-user-ico"><i class="las la-user"></i></div>

							<div id="emailloginerr"></div>

							<div id="emailerror"></div>

							<div id="erroremail"></div>

						</div>



						<div class="form-group">

							<input class="form-control" placeholder="Password" type="password" value="{{$userpass}}" name="password" id="passlogin" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">

							<div class="login-user-ico"><i class="las la-lock"></i></div>

							<div id="passlerr"></div>

							<div id="errorpass"></div>

								 

							

						</div>

						<div class="custom-checkbox mb-3">

								  <input type="checkbox" class="" onclick="myFunction()">

								  Show Password

						</div>



						<div class="form-group mb10 cust-box">

							<div class="row">

							  <div class="col-6">

								 <div class="custom-control custom-checkbox mb-3">

								  <input type="checkbox" class="custom-control-input" id="customCheck" name="example1" value="1"@if(!empty($useremail)) checked @endif    >

								  <label class="custom-control-label" for="customCheck">Remember Me</label>

								</div>   

							  </div>



							  <div class="col-6 text-right"><a href="javascript:void" class="forgt-pass" id="forgotbtn">Forgot password?</a></div>	

							</div>

						</div>	



						<div class="form-group mb-0"><button type="button" class="common-btn" id="loginbtn">Log In</button></div>



						</form>

						 

						<div class="orline"><img src="{{asset('public/images/or.png')}}" alt=""></div> 

						 

						<div class="login-social">

						  <a href="{{ url('/facebook/redirect') }}"><img src="{{asset('public/images/fb-ico.png')}}" alt=""></a>

						  <a href="{{ url('auth/google') }}"><img src="{{asset('public/images/google-ico.png')}}" alt=""></a> 

						  <a href="{{url('/twitter/redirect')}}"><img src="{{asset('public/images/twitter-ico.png')}}" alt=""></a> 	

						</div> 

						 

						<div class="signup-line">Don’t have an Account? <a href="#" id="signup">Sign Up</a></div> 

						 

					</div>

				   

				   </div>

			 </div>

			

          </div>

       </div>

      </div>

    </div>

	

</div>

<!--Modal: Name-->



<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

          <div class="modal-body mb-0 p-0">

            

             <div class="loginmodal-wrapper">

				 <button type="button" class="close" data-dismiss="modal"><i class="las la-times"></i></button>

			    <div class="row m-0">

				   

				   <div class="col-sm-7 p-0">

					 <div class="login-left">

					  <div class="login-text">

						<h2>Welcome Back,</h2>  

					    <p>Be part of the change your community deserves.</p>

					  </div>	  

					 </div>

				   </div>

				   

				   <div class="col-sm-5 p-0">

					 <div class="login-sec">

						<h3>Forgot Password</h3>

						<span id="loginerror"></span>

						<form class="login-form"  id="forgotform" >

							@csrf

						<div class="form-group">

							<input class="form-control" placeholder="Email Address" type="email" name="Email" id="emaillidf" value="{{$useremail}}" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">

							<div class="login-user-ico"><i class="las la-user"></i></div>

							<span id="emailidferr"></span>

							<span id="emailfperror"></span>

						</div>	



						<div class="form-group mb-0"><button type="button" class="common-btn" id="fpbtn">Submit</button></div>



						</form> 

						 

					</div>

				   

				   </div>

			 </div>

			

          </div>

       </div>

      </div>

    </div>

	

</div>



<div class="modal fade" id="otp-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

          <div class="modal-body mb-0 p-0">

            

             <div class="loginmodal-wrapper">

				 <button type="button" class="close" data-dismiss="modal"><i class="las la-times"></i></button>

			    <div class="row m-0">

				   

				   <div class="col-sm-7 p-0">

					 <div class="login-left">

					  <div class="login-text">

						<h2>Welcome Back,</h2>  

					    <p>Be part of the change your community deserves.</p>

					  </div>	  

					 </div>

				   </div>

				   

				   <div class="col-sm-5 p-0">

					 <div class="login-sec">

						<h3>Enter OTP</h3>

						<span id="loginerror"></span>

						<form class="login-form"  id="otpform" >

							@csrf

							<input type="hidden" name="" id="emailotp">

						<div class="form-group">

							<input class="form-control" placeholder="Enter OTP" type="number" name="otp" id="otp"  autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">

							<div class="login-user-ico"><i class="las la-user"></i></div>

							<span id="otpferr"></span>

						</div>	



						<div class="form-group mb-0"><button type="button" class="common-btn" id="otpbtn">Submit</button></div>



						</form> 

						 

					</div>

				   

				   </div>

			 </div>

			

          </div>

       </div>

      </div>

    </div>

	

</div>





	

<!--Modal: Name-->

    <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

          <div class="modal-body mb-0 p-0">

            

             <div class="loginmodal-wrapper">

				 <button type="button" class="close" data-dismiss="modal"><i class="las la-times"></i></button>

			    <div class="row m-0">

				   

				   <div class="col-sm-7 p-0">

					 <div class="login-left">

					  <div class="login-text">

						<h2>New on this,</h2>  

					    <p>Sign up to continue access pages</p>

					  </div>	  

					 </div>

				   </div>

				   

				   <div class="col-sm-5 p-0">

					 <div class="login-sec">

		

						<h3>Sign Up</h3>



						<form class="login-form" name="cform" method="post" id="registerform" action="{{route('user.register')}}">



							@csrf

						<div class="form-group">

							<input class="form-control" placeholder="Full Name" type="text" name="name" id="username" readonly onfocus="this.removeAttribute('readonly');">

							<div class="login-user-ico"><i class="las la-user"></i></div>

							<div id="snameerr"></div>

						</div>

							

						<div class="form-group">

							<input class="form-control" placeholder="Email Address" type="email" name="email" id="emailid" readonly onfocus="this.removeAttribute('readonly');">

							<div class="login-user-ico"><i class="las la-envelope"></i></div>

							<div id="semailerr"></div>

							<div id="erroremail"></div>

						</div>		

							

						<div class="form-group">

							<input class="form-control" placeholder="Password" type="password" name="password" id="spassword" readonly onfocus="this.removeAttribute('readonly');">

							<div class="login-user-ico"><i class="las la-lock"></i></div>

							<div id="spasserr"></div>

							<div id="passcheck"></div>

						</div>

							

						<div class="form-group">

							<input class="form-control" placeholder="Confirm Password" type="password" name="confirm_password"  id="scpassword" readonly onfocus="this.removeAttribute('readonly');">

							<div class="login-user-ico"><i class="las la-lock"></i></div>

							<div id="scpasserr"></div>

							<div id="errorshow"></div>

							<div id="passlength"></div>

						</div>		

						<div class="custom-checkbox" style="margin-bottom: 5px;!important">

								  <input type="checkbox" class="" onclick="checkpasssignup()">

								  Show Password

						</div>

								<span style="font-size: 11px;">* Password should contain at least one numeric digit and a special character and length between 7 to 15 characters</span>

						<div class="form-group mb-0"><button type="button" class="common-btn" id="register" style="    margin-top: 10px;">Submit</button></div>



						</form>

						 

						<div class="orline"><img src="{{asset('public/images/or.png')}}" alt=""></div>

						<div class="login-social">

						  <a href="{{ url('/facebook/redirect') }}"><img src="{{asset('public/images/fb-ico.png')}}" alt=""></a>

						  <a href="{{ url('auth/google') }}"><img src="{{asset('public/images/google-ico.png')}}" alt=""></a> 

						  <a href="{{url('/twitter/redirect')}}"><img src="{{asset('public/images/twitter-ico.png')}}" alt=""></a> 	

						</div> 

						<div class="signup-line">Don’t have an Account? <a href="#" id="loginid">Sign In</a></div>

					</di>

				   

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

              	<input type="hidden" name="" id="postid">



              	<div class="">

              	<input type="radio"  id="spamr" value="Spam" name="report" onchange="remove(this)">

              	<label for="spamr" class="" style="background-image: none;">Spam</label>

              	</div>

              	<div class="">

              	<input type="radio"  id="hater" value="Hate" name="report" onchange="remove(this)">

              	<label for="hater" class="" style="background-image: none;">Hate</label>

				</div>

              	<div class="">

              	<input type="radio"  id="interestedr" value="Not Interested" name="report" onchange="remove(this)">

              	<label for="interestedr" class="" style="background-image: none;">Not Interested</label>

              	</div>

              	<div class="">

              	<input type="radio"  id="misinformationr" value="Misinformation" name="report" onchange="remove(this)">

              	<label for="misinformationr" class="" style="background-image: none;">Misinformation</label>

              	</div>

              	<div class="">

              	<input type="radio"  id="likeitr" value="Don't Like It" name="report" onchange="remove(this)">

              	<label for="likeitr" class="" style="background-image: none;">Don't Like It</label>

              	</div>

              	<div class="">

              	<input type="radio"  id="fraudr" value="Fraud" name="report" onchange="remove(this)">

              	<label for="fraudr" class="" style="background-image: none;">Fraud</label>

              	</div>

              	<div class="">

              	<input type="radio" id="harassmentr" value="Bullying or harassment" name="report" onchange="remove(this)">

              	<label for="harassmentr" class="" style="background-image: none;">Bullying or harassment</label>

              	</div>

              	<div class="">

              	<input type="radio"  id="voilencer" value="Voilence" name="report" onchange="remove(this)">

              	<label for="voilencer" class="" style="background-image: none;">Voilence</label>

              	</div>	

              	<p id="reporterr"></p>

              	<div class="" style="text-align: right;">

                <button class="btn btn-success text-right" id="reportbtn" disabled="">Submit</button>

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



          



<!--Modal: Name-->	

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>	 -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="{{asset('public/js/owl.carousel.js')}}"></script>

<script src="{{asset('public/js/honey-custom.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>



<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>

@include('user.layout.script')

<div id="fb-root"></div>

<script type="text/javascript">

	$(".chosen-select").chosen({

  no_results_text: "Oops, nothing found!"

})

</script>

<script>(function(d, s, id) {

var js, fjs = d.getElementsByTagName(s)[0];

if (d.getElementById(id)) return;

js = d.createElement(s); js.id = id;

js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";

fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));</script>	

</body>

</html>

