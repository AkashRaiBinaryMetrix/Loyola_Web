@extends('user.layout.app')

@section('content')

<style type="text/css">

	.select2-search__field

{

	width: 1000px !important;

}

</style>

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

	    <div class="create-btns">

		  <a href="{{route('create.post')}}">Create a Post</a>   

		  <a href="{{route('create.poll')}}" class="create-active">Create a Poll</a> 

		</div>

	   

		<div class="inner-createnow">

			<form method="post" action="{{route('create.poll')}}" enctype="multipart/form-data" id="pollform">

				@csrf

		  <div class="top-innercreate">

			 <div class="row">

				 <div class="col-md-3 col-sm-12">

				   <div class="form-group createpost-field">
							<label>Continent</label>
							<select class="form-control" name="continent" id="continent" required="" onchange="displayCategoryPost();">
								<option value="">Select Continent</option>
								@foreach ($continentsList as $continentsListResult)
									<option value="{{$continentsListResult->name}}">{{$continentsListResult->name}}</option>
								@endforeach
							</select>
				   </div>

				   <div class="form-group createpost-field">
							<label>Category</label>
							<div id="category_div"></div>
				   </div>

				   <div class="form-group createpost-field">
							<label>Sub-Category</label>
							<div id="sub_category_div"></div>
				   </div>

				   <div class="form-group createpost-field">

					<label>My Communities</label>

					<!-- <select id="community-type" class="form-control" name="community_id" required="">

						<option value="">Select Community</option>

					  @foreach($community as $comm)

						<option value="{{$comm->id}}">{{$comm->title}}</option>

						@endforeach

					</select> -->
					
					<div id="community_div"></div>


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

				<input class="form-control" name="question" value="" placeholder="Question Text" type="text" id="questiontxt"> 

			   </div>

			   <span id="quetext" style="display: none;"></span>

				 

			   <div class="poll-ques-opt form-group">

				<input class="form-control options" name="option[]" value="" placeholder="Option Text" type="text"> 

			   </div>

				 

			   <div class="poll-ques-opt form-group">

				<input class="form-control options" name="option[]" value="" placeholder="Option Text" type="text"> 

			   </div>

				 

			   <div class="poll-ques-opt form-group">

				<input class="form-control options" name="option[]" value="" placeholder="Option Text" type="text"> 

			   </div>

				 

			   <div class="poll-ques-opt form-group">

				<input class="form-control options" name="option[]" value="" placeholder="Option Text" type="text"> 

			   </div>	 

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

			 @if(!empty($alluser) && count($alluser)>0)

			 <p>Tag People</p>

			 <div class="form-group">

			 <select data-placeholder="Begin typing a name to filter..." multiple class="form-control select2" name="tags[]" id="cmbIdioma" style="width: 100%!important;">

			 <!-- <select multiple class="form-control multiselect" name="tags[]"> -->

			    <option value=""></option>

			   

			    @foreach($alluser as $user)

			    <option value="{{$user->id}}" data-img="@if(!empty($user->image)) {{asset('public/user/images/'.$user->image)}} @else {{asset('public/images/user.png')}} @endif">{{$user->name}}</option>

			    @endforeach

			   

			  </select>



			</div>

			 @endif

			

			<div class="form-group mb-1 mt-4 submit-col text-md-right">

			  <button type="submit" class="common-btn" id="pollbtn">Post</button>

			</div>

			  

		  </div>   

		   </form>

		   

		</div>   

	   

	   </div>

	   

	</div>	   

</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>



<script type="text/javascript">

	$("#cmbIdioma").select2({

		width: '100%',

		 minimumResultsForSearch: Infinity,

	templateResult: function (idioma) {

		if(idioma.text!='')

		{

			var img = $(idioma.element).attr('data-img');

		console.log(img);

  			var $span = $("<span><img src="+img+" style='width:30px;height:30px;'/> " + idioma.text + "</span>");

  			return $span;

		}

  },

	templateSelection: function (idioma) {

		var img = $(idioma.element).attr('data-img');

  	var $span = $("<span><img src="+img+" style='width:30px;height:30px;'/> " + idioma.text + "</span>");

  	return $span;

  }

});

</script>

@endsection