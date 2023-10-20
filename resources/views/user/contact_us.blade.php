@extends('user.layout.app')
@section('content')
<div class="static-banner">
 <div class="static-pic"><img src="{{asset('public/images/contact-banner.jpg')}}" alt=""></div>
 <div class="static-title">Contact Us</div>	
</div>	
	
<div class="static-wrapper">
  <div class="container">
	
	  <div class="contact-texts mt-0">
		  <div class="static-titlecol"><h2 class="static-maintitle">Need Any Help</h2></div>
			
		<div class="contact-form">
			@if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block" style="text-align:center;">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
        </div>
      @endif
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block" style="text-align:center;">
          <button type="button" class="close" data-dismiss="alert">×</button> 
              <strong>{{ $message }}</strong>
        </div>
      @endif
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="alert alert-danger alert-block">
      	<button type="button" class="close" data-dismiss="alert">×</button> 
          <ul>
              <li>{{ $error }}</li>
          </ul>
      </div>
       @endforeach
      @endif
		  <form class="query-form" name="cform" method="post" action="{{route('enquiry')}}" id="enquiryform">
				 @csrf
				 <div class="row">
				 
				<div class="col-sm-6">
				  <div class="form-group">
				  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" readonly onfocus="this.removeAttribute('readonly');" value="{{ old('first_name') }}">
				  <span id="firstname"></span>
				  </div>
				</div>
					 
				<div class="col-sm-6">
				  <div class="form-group">
				  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" readonly onfocus="this.removeAttribute('readonly');" value="{{ old('last_name') }}">
				  <span id="lastname"></span>
				  </div>
				</div>	 
				 
				<div class="col-sm-6">	 
				 <div class="form-group">
				<input type="text" class="form-control" name="email" id="email" placeholder="Email ID" readonly onfocus="this.removeAttribute('readonly');" value="{{ old('email') }}">
				<span id="email_id"></span>
				<span id="emailinval"></span>
				</div>
				</div>	
				 
				<div class="col-sm-6">	 
				<div class="form-group">
				<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone No." readonly onfocus="this.removeAttribute('readonly');" value="{{ old('phone') }}">
				<span id="contact"></span>
				</div>
				</div>	 
			 
				<div class="col-sm-12">	 
				<div class="form-group">
				<textarea class="form-control" id="message" name="message" placeholder="Write your message..." rows="4"></textarea>
				<span id="msgs"></span>
				</div>
				</div>	
			 	
				<div class="col-sm-12 mt-2">	 	 
				 <div class="form-group text-center">
				<button type="submit" class="common-btn" id="enquirybtn">Submit</button>
				</div>
				</div>
					 
			</div>

				</form>	
			
		</div>	
			
		</div>
	
  </div>		
</div>
@endsection