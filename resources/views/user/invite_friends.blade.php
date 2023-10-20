@extends('user.layout.app')
@section('content')
<div class="main-wrapper">
   <div class="container">
	 
	   <div class="user-account-sec">
	   
	    <div class="accounts-btns">
		  <a href="{{url('my-profile')}}"><div class="profile-ico"><i class="las la-user"></i></div> My Profile</a>   
		  <a href="{{route('user.my.post')}}"><div class="profile-ico"><i class="las la-edit"></i></div> My Post</a>
		  <a href="{{route('user.activity')}}"><div class="profile-ico"><i class="las la-list-alt"></i></div> Activity Log</a> 	
		  <a href="{{route('my.community')}}" ><div class="profile-ico"><i class="las la-user-friends"></i></div> My Communities</a>
		  <a href="{{route('user.invite.friends')}}" class="accounts-active" class="accounts-active"><div class="profile-ico"><i class="las la-user-plus"></i></div> Invite Friends</a>	
		</div>
		   
		 <div class="inner-accountsnow">
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
		   <form class="common-form" id="inviteform" method="post" action="{{route('user.invite.friends')}}">
		   	@csrf
						<fieldset>
						<div class="row">
						<div class="col-12 col-sm-6 col-xl-4">
						  <div class="form-group">
							<label>First Name</label>
							<input class="form-control" name="first_name" type="text" value="" id="first_name">
							<span id="firstname"></span>
						  </div>
						</div>
							
					    <div class="col-12 col-sm-6 col-xl-4">
						  <div class="form-group">
							<label>Last Name</label>
							<input class="form-control" name="last_name" type="text" value="" id="last_name">
							<span id="lastname"></span>
						  </div>
						</div>		
						 
						<div class="col-12 col-sm-12 col-xl-4">
						  <div class="form-group">
							<label>Email</label>
							<input class="form-control" name="email" type="email" value="" id="email">
							<span id="emailinvite"></span>
						  </div>
						</div> 
						 
						</div>
							
						<div class="mt-2 mb-2 submit-col">
						<button type="submit" class="btn common-btn" id="invitebtn">Invite</button>
						</div>	
							
						</fieldset>
					  </form>
		   
		 </div>   
		 
	   </div>
	   
	</div>	   
</div>
@endsection