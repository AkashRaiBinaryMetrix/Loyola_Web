@extends('user.layout.app')
@section('content')
<div class="main-wrapper">
   <div class="container">
	 
	   <div class="user-account-sec">
	   
	    <div class="accounts-btns">
		  <a href="{{url('my-profile')}}" class="accounts-active"><div class="profile-ico"><i class="las la-user"></i></div> My Profile</a>   
		  <a href="{{route('user.my.post')}}"><div class="profile-ico"><i class="las la-edit"></i></div> My Post</a>
		  <a href="{{route('user.activity')}}"><div class="profile-ico"><i class="las la-list-alt"></i></div> Activity Log</a> 	
		  <a href="{{route('my.community')}}"><div class="profile-ico"><i class="las la-user-friends"></i></div> My Communities</a>
		  <a href="{{route('user.invite.friends')}}"><div class="profile-ico"><i class="las la-user-plus"></i></div> Invite Friends</a>	
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
		   <form class="common-form" id="" method="post" action="{{route('detail')}}" enctype="multipart/form-data">
		   	@csrf

		   		@php
		   		$user=Session::get('user');
		   		$userdetails=DB::table('user_detail')->join('users','users.id','user_detail.user_id')->where('user_detail.user_id',$user->id)->select('user_detail.*','users.name as username','users.email as useremail')->first();
            
		   		@endphp
						<fieldset>
					 
						<div class="row"> 
						
						<div class="col-12">
						  <div class="form-group avtar-profile">
							<label>Avatar</label>
							<div class="avatar-wrapper">
							<img class="profile-pic" src="@if(!empty($userdetails->image)) {{asset('public/user/images/'.$userdetails->image)}} @else {{asset('public/images/user.png')}} @endif" alt="" />
							<div class="upload-button"></div>
							<input class="file-upload" name="image" type="file" accept="image/*"/>
						</div>
							<span>Upload a head image</span>  
						  </div>
						</div>	
							
						<div class="col-12 col-sm-4 col-xl-3">
						  <div class="form-group">
							<label>Name</label>
							<input class="form-control" name="name" type="text" value="@if(!empty($userdetails)) {{ $userdetails->username}} @else (!empty($user)) {{ $user->name }} @endif">
						  </div>
						</div>
						 
						<div class="col-12 col-sm-4 col-xl-3">
						  <div class="form-group">
							<label>Email</label>
							<input class="form-control" name="email" type="text" value="{{ ($userdetails ? $userdetails->useremail : ($user))  ? $user->email: '' }}" readonly="">
						  </div>
						</div> 
						 
						<div class="col-12 col-sm-4 col-xl-3">
						  <div class="form-group">
							<label>Phone</label>
							<input class="form-control" name="phone" type="text" value="{{($userdetails) ?$userdetails->phone :''}}">
						  </div>
						</div>
							
						<div class="col-12 col-sm-4 col-xl-3">
						  <div class="form-group">
							<label>Gender</label>
							<input class="form-control" name="gender" type="text" value="{{($userdetails) ?$userdetails->gender  :''}}">
						  </div>
						</div>
							
						<div class="col-12 col-sm-4 col-xl-3">
						  <div class="form-group">
							<label>Age</label>
							<input class="form-control" name="age" type="text" value="{{($userdetails) ?$userdetails->age :''}}">
						  </div>
						</div>
							
						<div class="col-12 col-sm-4 col-xl-3">
						  <div class="form-group">
							<label>City</label>
							<input class="form-control" name="city" type="text" value="{{($userdetails) ?$userdetails->city :''}}">
						  </div>
						</div>
							
						<div class="col-12 col-sm-4 col-xl-3">
						  <div class="form-group">
							<label>State</label>
							<input class="form-control" name="state" type="text" value="{{($userdetails) ?$userdetails->state :''}}">
						  </div>
						</div>
							
						<div class="col-12 col-sm-4 col-xl-3">
						  <div class="form-group">
							<label>Country</label>
							<input class="form-control" name="country" type="text" value="{{($userdetails) ?$userdetails->country :''}}">
						  </div>
						</div>
							
						<div class="col-12 col-sm-4 col-xl-3">
						  <div class="form-group">
							<label>Zip Code</label>
							<input class="form-control" name="zipcode" type="text" value="{{($userdetails) ?$userdetails->zipcode :''}}">
						  </div>
						</div>
						 
						</div>
							
						<div class="mt-2 mb-2 submit-col">
						<button type="submit" class="btn common-btn">Save</button>
						</div>	
							
						</fieldset>
					  </form>
		   
		   
		 </div>   
		 
	   </div>
	   
	</div>	   
</div>
@endsection