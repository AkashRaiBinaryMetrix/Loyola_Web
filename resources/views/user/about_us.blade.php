@extends('user.layout.app')
@section('content')
<div class="static-banner">
 <div class="static-pic"><img src="{{asset('public/images/about-banner.jpg')}}" alt=""></div>
 <div class="static-title">About Us</div>	
</div>	
	
	@php
	$aboutus=DB::table('about_us')->first();
	@endphp

<div class="static-wrapper">
  <div class="container">
	  <div class="about-text">
	    <p>{{$aboutus->about}}</p>
	  </div>
  </div>
	
<div class="next-level">
<div class="container">
	
<div class="static-titlecol"><h3 class="static-maintitle">How Does It Works?</h3></div>	
	
<div class="row align-items-center">
	
<div class="col-xl-5 col-lg-6">
<div class="next-level-content">
<h4>Dummy Sub Heading Come</h4>	
<h2>Industry's standard dummy text ever since the 1500.</h2>	
<p>{{$aboutus->content}}</p>	
</div>	
	
</div>
	
<div class="col-xl-7 col-lg-6 text-xl-right"><img src="{{asset('public/about/'.$aboutus->image)}}" alt=""></div>	
	
</div>	
	
</div>		
</div>	
	
<div class="about-3col">	
	
<div class="container">
  
	<div class="row">
	  
		<div class="col-lg-4">
		  <div class="services-3col">
			<div class="services-pic"><img src="{{asset('public/images/about-ico-1.png')}}" alt=""></div>  
			<h4 class="green">Post Your Thoughts</h4>
			<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
		  </div>
		</div>
		
		<div class="col-lg-4">
		  <div class="services-3col services-3col2">
			<div class="services-pic"><img src="{{asset('public/images/about-ico-2.png')}}" alt=""></div>  
			<h4 class="blue">Comment What You Think</h4>
			<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
		  </div>
		</div>
		
		<div class="col-lg-4">
		  <div class="services-3col services-3col3">
			<div class="services-pic"><img src="{{asset('public/images/about-ico-3.png')}}" alt=""></div>  
			<h4 class="red">Like Your Post</h4>
			<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
		  </div>
		</div>
	  </div>
	
</div>	
	
</div>	
	
</div>
@endsection