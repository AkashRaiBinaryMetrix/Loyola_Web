@extends('user.layout.app')
@section('content')
<div class="main-wrapper">
   <div class="container">
	 
	   <div class="user-account-sec">
	   
	    <div class="accounts-btns">
		  <a href="{{url('my-profile')}}"><div class="profile-ico"><i class="las la-user"></i></div> My Profile</a>   
		  <a href="user-post.html"><div class="profile-ico"><i class="las la-edit"></i></div> My Post</a>
		  <a href="user-activitylog.html"><div class="profile-ico"><i class="las la-list-alt"></i></div> Activity Log</a> 	
		  <a href="user-community.html" class="accounts-active"><div class="profile-ico"><i class="las la-user-friends"></i></div> My Communities</a>
		  <a href="invite-friends.html"><div class="profile-ico"><i class="las la-user-plus"></i></div> Invite Friends</a>		
		</div>
		   
		 <div class="inner-accountsnow">
		   
		   <div class="community-columns">
				  <div class="row">
					  
					<div class="col-md-4 col-xl-3 col-6">
					  <div class="community-col"><a href="#">
						<div class="community-fig"><img src="{{asset('public/images/community-pic-8.jpg')}}" alt=""></div>
						<div class="community-text">
						  <h4>Coronavirus</h4>
						  <p>12K Members</p>
						  <button type="button" class="comjoin-btn">Joined</button>
						</div>
					  </a></div>  
					</div>
					  
					<div class="col-md-4 col-xl-3 col-6">
					  <div class="community-col"><a href="#">
						<div class="community-fig"><img src="{{asset('public/images/community-pic-10.jpg')}}" alt=""></div>
						<div class="community-text">
						  <h4>Environment</h4>
						  <p>12K Members</p>
						  <button type="button" class="comjoin-btn">Joined</button>
						</div>
					  </a></div>  
					</div>
					  
					<div class="col-md-4 col-xl-3 col-6">
					  <div class="community-col"><a href="#">
						<div class="community-fig"><img src="{{asset('public/images/community-pic-7.jpg')}}" alt=""></div>
						<div class="community-text">
						  <h4>Politics</h4>
						  <p>12K Members</p>
						  <button type="button" class="comjoin-btn">Joined</button>
						</div>
					  </a></div>  
					</div>  
					    
				  </div>
				</div>
			 
		   <div class="trending-user-community">
			   
			   <div class="title-col"><h2 class="title">Other Trending Communities</h2></div>
			   
			  <div id="categories-slider" class="owl-carousel">
           
             <div class="item">
              <div class="community-col"><a href="#">
				<div class="community-fig"><img src="{{asset('public/images/community-pic-1.jpg')}}" alt=""></div>
				<div class="community-text">
				  <h4>Fashion</h4>
				  <p>12K Members</p>
				  <button type="button" class="comjoin-btn">Join</button>
				</div>
			  </a></div>
              </div>
				  
			  <div class="item">
              <div class="community-col"><a href="#">
				<div class="community-fig"><img src="{{asset('public/images/community-pic-2.jpg')}}" alt=""></div>
				<div class="community-text">
				  <h4>Health &amp; Fitness</h4>
				  <p>12K Members</p>
				  <button type="button" class="comjoin-btn">Join</button>
				</div>
			  </a></div>
              </div>
				  
			  <div class="item">
              <div class="community-col"><a href="#">
				<div class="community-fig"><img src="{{asset('public/images/community-pic-3.jpg')}}" alt=""></div>
				<div class="community-text">
				  <h4>Sports</h4>
				  <p>12K Members</p>
				  <button type="button" class="comjoin-btn">Join</button>
				</div>
			  </a></div>
              </div>
				  
			  <div class="item">
              <div class="community-col"><a href="#">
				<div class="community-fig"><img src="{{asset('public/images/community-pic-4.jpg')}}" alt=""></div>
				<div class="community-text">
				  <h4>Medical</h4>
				  <p>12K Members</p>
				  <button type="button" class="comjoin-btn">Join</button>
				</div>
			  </a></div>
              </div>
				  
			  <div class="item">
              <div class="community-col"><a href="#">
				<div class="community-fig"><img src="{{asset('public/images/community-pic-5.jpg')}}" alt=""></div>
				<div class="community-text">
				  <h4>Beauty</h4>
				  <p>12K Members</p>
				  <button type="button" class="comjoin-btn">Join</button>
				</div>
			  </a></div>
              </div>
				  
			  <div class="item">
              <div class="community-col"><a href="#">
				<div class="community-fig"><img src="{{asset('public/images/community-pic-6.jpg')}}" alt=""></div>
				<div class="community-text">
				  <h4>Makeup</h4>
				  <p>12K Members</p>
				  <button type="button" class="comjoin-btn">Join</button>
				</div>
			  </a></div>
              </div>	  
			 
          </div><!--owl slider-->  
			 
		   </div>	 
		   
		 </div>   
		 
	   </div>
	   
	</div>	   
</div>
@endsection