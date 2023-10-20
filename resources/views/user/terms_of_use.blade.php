@extends('user.layout.app')
@section('content')
<div class="policies-wrapper">
  <div class="container">
	
	  <div class="term_conditions">
		  
		  <div class="title-col"><h1 class="static-maintitle">Terms of Service</h1></div>
		   
		   <h5 class="mb-3">Welcome to our IF YOU WERE...</h5>
		  
			{!!$terms->content!!}
			<hr>
			<h6>Where does it come from?</h6>
			{!!$terms->content1!!}
			<hr>
			<h6>Why do we use it?</h6>
			{!!$terms->content2!!}
		</div>
	  
  </div>	
</div>
@endsection