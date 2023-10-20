<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="images/favicon.png">

<title>IF I WERE (Making the world a better place)</title>	
	
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
	
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Owl Stylesheets -->
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">	
	
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
	
<link rel="stylesheet" href="css/custom.css" type="text/css" />
	
</head>
<body>

<header class="main-header">
	<div class="container">
<div class="row align-items-center">
	
<div class="col-lg-9">	
	<div class="logo-search">
	<div class="main-logo">
		<a href="{{url('/')}}"><img src="images/logo.png" alt=""> <span>IF YOU WERE...<i>MAKING THE WORLD A BETTER PLACE</i></span></a>
	</div>
	
	<div class="top-search">
		<form class="main-search-form" name="cform" method="post">
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
		
	  <div class="top-create-icon">
		<a href="create-post.html" data-toggle="tooltip" title="Create Post"><i class="las la-plus-circle"></i></a>
	   </div>	
		
	   <div class="top-commu-icon">
		<a href="all-communities.html" data-toggle="tooltip" title="All Communities"><i class="las la-user-friends"></i></a>
	   </div>
		
	  <div class="top-user-profile">
	 <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/user.png" alt="">
	 <p><small>Welcome</small> Eliya Jameson</p>	</a>
		
	 <ul class="dropdown-menu">
		  <li><a href="create-post.html">Create Post</a></li>
		  <li><a href="create-community.html">Create Community</a></li> 
		  <li><a href="user-community.html">My Communities</a></li>
		  <li><a href="my-setting.html">Setting</a></li>
		  <li><a href="invite-friends.html">Invite Friends</a></li>
		  <li><a href="#">Logout</a></li>
		</ul>	
		
	</div>
	
   </div>	
</div>
	
</div>	
	
</div>
</header>
	
@yield('content')	
	
	
<footer>
 <div class="container">
	<div class="row">
	  <div class="col-md-4">
		 <div class="footer-links">
		   <ul>
			<li><a href="about-us.html">About Us</a></li>
			<li><a href="contact-us.html">Contact Us</a></li> 
			<li><a href="help.html">Help</a></li> 
			<li><a href="faqs.html">FAQs</a></li> 
			<li><a href="privacy-policy.html">Privacy Policy</a></li> 
			<li><a href="terms.html">Terms of Use</a></li>    
		   </ul> 
		  
		 </div>
	  </div>
		
	  <div class="col-md-4">
		<div class="footer-appcol">
		  <div class="footer-title">DOWNLOAD THE APP ON</div>
		  <div class="app-btns">
			  <a href="#"><img src="images/app-apple-btn.png" alt=""></a>
			  <a href="#"><img src="images/app-play-btn.png" alt=""></a>
			</div>
		</div>
	  </div>
		
	  <div class="col-md-4">
		<div class="footer-social">
		  <div class="footer-title">Follow Us</div>
		  <div class="social-icobtns">
			  <a href="#"><i class="lab la-facebook-f"></i></a>
			  <a href="#"><i class="lab la-twitter"></i></a>
			  <a href="#"><i class="lab la-instagram"></i></a>
			</div>
		</div>
	  </div>	
		
	 
	</div>
 </div>
	
<div class="copyright">
	<div class="container">
		<p>TrendLiybia © 2021 | All rights reserved <span>Site Developed by <a href="https://www.binarymetrix.com/" target="_blank" rel="nofollow">BinaryMetrix Technologies</a></span></p>
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
		
						<h3>Sign In</h3>

						<form class="login-form" name="cform" method="post">

						<div class="form-group">
							<input class="form-control" placeholder="Email Address" type="email" name="Email" required="">
							<div class="login-user-ico"><i class="las la-user"></i></div>
						</div>

						<div class="form-group">
							<input class="form-control" placeholder="Password" type="password" name="password" required="">
							<div class="login-user-ico"><i class="las la-lock"></i></div>
						</div>

						<div class="form-group mb10 cust-box">
							<div class="row">
							  <div class="col-6">
								 <div class="custom-control custom-checkbox mb-3">
								  <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
								  <label class="custom-control-label" for="customCheck">Remember Me</label>
								</div>   
							  </div>

							  <div class="col-6 text-right"><a href="#" class="forgt-pass">Forgot password?</a></div>	
							</div>
						</div>	

						<div class="form-group mb-0"><button type="submit" class="common-btn">Log In</button></div>

						</form>
						 
						<div class="orline"><img src="images/or.png" alt=""></div> 
						 
						<div class="login-social">
						  <a href="#"><img src="images/fb-ico.png" alt=""></a>
						  <a href="#"><img src="images/google-ico.png" alt=""></a> 
						  <a href="#"><img src="images/twitter-ico.png" alt=""></a> 	
						</div> 
						 
						<div class="signup-line">Don’t have an Account? <a href="#">Sign Up</a></div> 
						 
					</div>
				   
				   </div>
			 </div>
			
          </div>
       </div>
      </div>
    </div>
	
</div>
<!--Modal: Name-->
	
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

						<form class="login-form" name="cform" method="post">

						<div class="form-group">
							<input class="form-control" placeholder="Full Name" type="text" name="name" required="">
							<div class="login-user-ico"><i class="las la-user"></i></div>
						</div>
							
						<div class="form-group">
							<input class="form-control" placeholder="Email Address" type="email" name="email" required="">
							<div class="login-user-ico"><i class="las la-envelope"></i></div>
						</div>		
							
						<div class="form-group">
							<input class="form-control" placeholder="Password" type="password" name="password" required="">
							<div class="login-user-ico"><i class="las la-lock"></i></div>
						</div>
							
						<div class="form-group">
							<input class="form-control" placeholder="Confirm Password" type="password" name="password" required="">
							<div class="login-user-ico"><i class="las la-lock"></i></div>
						</div>		

						<div class="form-group mb-0"><button type="submit" class="common-btn">Log In</button></div>

						</form>
						 
						<div class="orline"><img src="images/or.png" alt=""></div> 
						 
						<div class="login-social">
						  <a href="#"><img src="images/fb-ico.png" alt=""></a>
						  <a href="#"><img src="images/google-ico.png" alt=""></a> 
						  <a href="#"><img src="images/twitter-ico.png" alt=""></a> 	
						</div> 
						 
						<div class="signup-line">Don’t have an Account? <a href="#">Sign In</a></div> 
						 
					</div>
				   
				   </div>
			 </div>
			
          </div>
       </div>
      </div>
    </div>
	
</div>

<!--Modal: Name-->	
	
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/honey-custom.js"></script>
	
</body>
</html>
