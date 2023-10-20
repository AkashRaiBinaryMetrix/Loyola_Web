@extends('user.layout.app')
@section('content')
<div class="main-wrapper">
   <div class="container">
	 
	   <div class="createnow-sec">
	            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($errors->any())
                 @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                	<button type="button" class="close" data-dismiss="alert">×</button> 
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                </div>
                @endforeach
                @endif
	    <div class="create-btns">
		  <a href="javascript:void" class="create-active">New Password</a>   
		</div>
	   <form method="post" action="{{route('user.forgot.change.password',$email)}}" id="changepassform">
	   	@csrf
	   	<input type="hidden" name="email" id="emailp" value="{{$email}}">
		<div class="inner-createnow">
		  <div class="top-innercreate">
			 <div class="row">

				 <div class="col-md-3 col-sm-6">
				   <div class="form-group createpost-field">
					<label>New Password</label>
					<input type="password" class="form-control" name="password" id="pass" placeholder="" >
					<span id="passerr"></span>
					<span id="passerrc"></span>
				  </div>
				 </div>
				 
				 <div class="col-md-3 col-sm-6">
				   <div class="form-group createpost-field">
					<label>Confirm Password</label>
					<input type="password" class="form-control" name="confirm_password" id="confpass" placeholder="" >
					<span id="confrmpasserr"></span>
				  </div>
				 </div>
				 
			 </div>
			 <div class="custom-checkbox mb-3">
				  <input type="checkbox" class="" onclick="showpass()">
				  Show Password
			</div>
			<span style="font-size: 14px;">* Password should contain at least one numeric digit and a special character and length between 7 to 15 characters</span>
			   
			<div class="form-group mb-1 mt-4 submit-col text-md-right">
			  <button type="submit" class="common-btn" id="changeuserpbtn">Submit</button>
			</div>
			  
		  </div>   
		   
		   
		</div>   
	   </form>
	   </div>
	   
	</div>	   
</div>
@endsection