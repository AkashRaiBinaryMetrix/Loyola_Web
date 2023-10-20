<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('admin/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('admin/vendor/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65">
				@if ($message = Session::get('success'))
		    <div class="alert alert-success alert-block">
		        <button type="button" class="close" data-dismiss="alert">×</button> 
		            <strong>{{ $message }}</strong>
		    </div>
			@endif
			@if ($message = Session::get('error'))
			    <div class="alert alert-danger alert-block">
			        <button type="button" class="close" data-dismiss="alert">×</button> 
			            <strong>{{ $message }}</strong>
			    </div>
			@endif
				<form class="login100-form validate-form" method="post" action="{{route('admin.forgot.password')}}" id="otpform">
					<span class="login100-form-title p-b-49">
						Forgot Password
					</span>
					@csrf
					<input type="hidden" name="email" value="{{$email}}">
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Enter OTP</span>
						<input class="input100" type="number" name="otp" placeholder="Type your otp" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');" id="otp">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<span id="otperr"></span>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="button" id="otpbtn">
								Submit
							</button>
						</div>
					</div>

					
					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('admin/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('admin/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('admin/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('admin/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('admin/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('admin/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('admin/js/main.js') }}"></script>

</body>
@include('admin.layout.admin_script')
</html>