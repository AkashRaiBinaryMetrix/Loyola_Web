@extends('user.layout.app')
@section('content')
<div class="policies-wrapper">
  <div class="container">
	
	  <div class="term_conditions">
		  
		  <div class="title-col"><h1 class="static-maintitle">Privacy Policy</h1></div>
		  
			
			{!!$privacypolicy->content!!}
			<hr>
			<h6>Where does it come from?</h6>
			{!!$privacypolicy->content1!!}
		
			<hr>
			<h6>Why do we use it?</h6>
			{!!$privacypolicy->content2!!}
			
		</div>
	  
  </div>	
</div>
@endsection