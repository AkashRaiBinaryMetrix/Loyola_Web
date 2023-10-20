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
	    <!-- <div class="create-btns">
		  <a href="{{route('create.post')}}">Create a Post</a>   
		  <a href="{{route('create.poll')}}" class="create-active">Create a Poll</a> 
		</div> -->
	   	@php
	   	    $randnum=\Helper::RandNum('5').$poll->id;
	   	@endphp
		<div class="inner-createnow">
			<form method="post" action="{{route('user.edit.poll',$randnum)}}" enctype="multipart/form-data" id="pollform">
				@csrf
		  <div class="top-innercreate">
			 <div class="row">
			  
				 <div class="col-md-3 col-sm-12">
				   <div class="form-group createpost-field">
					<label>My Communities</label>
					<select id="community-type" class="form-control" name="community_id" required="">
						<option value="">Select Community</option>
					  @foreach($community as $comm)
						<option value="{{$comm->id}}"@if($poll->community_id==$comm->id) selected @endif>{{$comm->title}}</option>
						@endforeach
					</select>
				  </div>
				 </div>
				 
				<!-- <div class="col-md-3 col-sm-6">
				   <div class="create-addpost">
					<h4>Add to your post</h4> 
					 
					<div class="create-media">
					  <img class="media-pic" src="{{asset('public/images/image-ico.png')}}" alt="">
					  <img class="media-pic" src="{{asset('public/images/create-video-ico.png')}}" alt="">
					  <img class="media-pic" src="{{asset('public/images/mic-ico.png')}}" alt="">
					  <input class="file-upload" name="media" type="file" accept="audio/*,video/*,image/*" style="display: none;" id="file" onchange="previewimg(this)"/>	
					</div>
					   
				   </div>
				 </div> -->
			  
				 
				 
			  
			 </div>
			  
			 <div class="poll-area">
			   <!-- <div class="poll-title-input form-group">
				<input class="form-control" name="title" value="" placeholder="Poll Title" type="text" id="title_poll">
				 
			   </div> -->
			   <span id="polltitle" style="display: none;"></span>
				<div id="options"> 
			   <div class="poll-ques form-group">
				<input class="form-control" name="question" value="{{$poll->question}}" placeholder="Question Text" type="text" id="questiontxt"> 
			   </div>
			   <span id="quetext" style="display: none;"></span>
				 @foreach($option as $optn)
			     <div class="poll-ques-opt form-group">
				   <input class="form-control options" name="option[]" value="{{$optn}}"placeholder="Option Text" type="text"> 
			     </div>
			     @endforeach
					 
			  	<div id="moreoption"></div>
			  	<span id="optionsreq"></span>
			  </div>
			  	<div class="col-md-12 col-sm-12" style="text-ali">
				   <div class="create-addpost">
					 <img src="" id="blah" style="width:220px;height:120px;text-align: center;display: none;">
						  		<video width="220" height="160" controls style="display: none;" id="videoid">
							  <source src="" type="video/mp4">
							  <source src="" type="video/ogg">
							Your browser does not support the video tag.
							</video> 
						  		<audio controls style="display: none;" id="audid">
							  <source src="" type="audio/ogg">
							  <source src="" type="audio/mpeg">
							Your browser does not support the audio element.
							</audio>
				   </div>
				 </div>
			   <div class="poll-footer" id="poll_footer">
				  <div  class="more-specbtn"><a href="javascript:void" id="addspec">+ Add Option</a></div>
				  <div class="check-multiplesec">
				    <div class="custom-control custom-switch">
					 <input type="checkbox" name="multiple" class="custom-control-input" id="switch1" value="1">
					 <label class="custom-control-label" for="switch1">Multiple answer</label>
				  </div>
				  </div> 
			   </div>	 
				 
			 </div> 
			
			<div class="form-group mb-1 mt-4 submit-col text-md-right">
			  <button type="submit" class="common-btn" id="pollbtn">Post</button>
			</div>
			  
		  </div>   
		   </form>
		   
		</div>   
	   
	   </div>
	   
	</div>	   
</div>
@endsection