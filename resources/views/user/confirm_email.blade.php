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
	    
	   
		<div class="inner-createnow" style="text-align:center;">
		  <div class="top-innercreate" >
		  	<div class="card-body" style="min-height:300px;">
			 <div class="row" >
			  
				 <span style="text-align:center;padding: 86px;margin-left: 180px;font-size: 25px;">You have successfully confirmed your account. You will use this email id to log in.</span>
			  
			 </div>
			   </div>

			
			<!-- <div class="form-group mb-1 mt-4 submit-col text-md-right">
			  <button type="submit" class="common-btn">Submit</button>
			</div> -->
			  
		  </div>   
		   
		   
		</div>
	   </div>
	   
	</div>	   
</div>
@endsection