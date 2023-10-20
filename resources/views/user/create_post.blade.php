@extends('user.layout.app')

@section('content')

<style type="text/css">

	.drop-zone {

  /*max-width: 800px;*/

  height: 200px;

  padding: 25px;

  display: flex;

  align-items: center;

  justify-content: center;

  text-align: center;

  font-family: "Quicksand", sans-serif;

  font-weight: 500;

  font-size: 20px;

  cursor: pointer;

  color: #cccccc;

  border: 4px dashed #009578;

  border-radius: 10px;

}



.drop-zone--over {

  border-style: solid;

}



.drop-zone__input {

  display: none;

}



.drop-zone__thumb {

  width: 100%;

  height: 100%;

  border-radius: 10px;

  overflow: hidden;

  background-color: #cccccc;

  background-size: cover;

  position: relative;

}



.drop-zone__thumb::after {

  content: attr(data-label);

  position: absolute;

  bottom: 0;

  left: 0;

  width: 100%;

  padding: 5px 0;

  color: #ffffff;

  background: rgba(0, 0, 0, 0.75);

  font-size: 14px;

  text-align: center;

}

.select2-search__field

{

	width: 1000px !important;

}



.file-preview {

    border-radius: 0;

    float: left;

    width: 100%;

    border: 1px solid #f1f1f1;

    background: #f1f1f1;

}

.file-drop-zone-title {

    color: #aaa;

    font-size: 1.6em;

    padding: 85px 10px;

    cursor: default;

}

.file-input theme-fa file-input-ajax-new

{

	display: none !important;

}

</style>

<div class="main-wrapper" >

   <div class="container">

	 

	   <div class="createnow-sec">

	   

	    <div class="create-btns">

		  <a href="{{route('create.post')}}" class="create-active">Create a Post</a>   

		  <a href="{{route('create.poll')}}">Create a Poll</a> 

		</div>

	   <form method="post" action="{{route('create.post')}}" enctype="multipart/form-data" id="postform">

	   	@csrf

		<div class="inner-createnow">

		  <div class="top-innercreate">

			 <div class="row">

			  

				 <div class="col-md-3 col-sm-6">

				 
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

					<!-- <select id="community-type"  class="form-control" name="community_id" required="">

						<option value="">Select Community</option>

						@if(!empty($community))

						@foreach($community as $comm)

						<option value="{{$comm->id}}"@if(!empty($comm) && $comm->title==$comm->title) selected @endif>{{$comm->title}}</option>

						@endforeach

						@endif

					</select> -->

					<div id="community_div"></div>

					<input type="hidden" name="" id="commall" value="{{(!empty($community[0])) ? $community[0] :''}}">

						

					<span id="comtype" style="display: none;"></span>

				  </div>

				 </div>

				 

				 <div class="col-md-3 col-sm-6">

				   <div class="create-addpost"> 

					 

					<div class="create-media">

					  <a href="javascript:void(0)" onclick="openmedia('image')" style="margin-right: 0px !important"><img class="media-pic" src="{{asset('public/images/image-ico.png')}}" alt="" title="Add image" ></a>



					  <a href="javascript:void(0)" onclick="openmedia('video')" style="margin-right: 0px !important"><img class="media-pic" src="{{asset('public/images/create-video-ico.png')}}" alt="" title="Add video"></a>



					  <a href="javascript:void(0)" style="margin-right: 0px !important"><img class="media-pic media-audio" src="{{asset('public/images/mic-ico.png')}}" alt="" title="Add audio"></a>

					  <!-- <input class="file-upload" name="media" type="file" accept="audio/*,video/*,image/*" capture="camera"  style="display: none;" id="file" onchange="previewimg(this)"/>	 -->

					  <input type="hidden" name="media" value="" id="camera-snap">

					  <input type="hidden" name="" value="" id="video-snap">

					  <input type="hidden" name="imagetype" value="" id="media-image-type">

					</div>

				   </div>

				 </div>

			  

			 </div>

			  

			  <div class="form-group">

			  	<input type="text" name="title" class="form-control" placeholder="Enter title" id="tiletxt">

			  	<span id="textpost" style="display: none;"></span>

			  </div>

			  

			 <div class="editor-sec" id="editor-sec">

			   <textarea class="full-featured-non-premium" name="post" maxlength="400" id="postid"></textarea>

			   <span id="postcontnt" style="float: right;"></span>

			   <span id="words-max" style="margin-top: 5px;color: red;">Maximum words 400</span>

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



			 <div  id="imgsec" style="display: none;">

				    <span class="drop-zone__prompt"></span>

				    <img src="" id="blah" style="width:300px;height:150px;display: none;">

						  		<video width="240" height="160" controls style="display: none;" id="videoid">

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

			

			<div class="form-group mb-1 mt-4 submit-col text-md-right">

			  <button type="submit" class="common-btn" id="postuser">Post</button>

			</div>

			  

		  </div>   

		   

		   

		</div>   

	   </form>

	   </div>

	   

	</div>	   

</div>



<div class="modal fade common-modal" id="postvideoamodalTitle" tabindex="-1" role="dialog" aria-labelledby="postmediamodalTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-align: right;

    margin: 10px;">

          <span aria-hidden="true"><i class="las la-times"></i></span>

        </button>

		

      <div class="modal-body p-0">

         <div class="login-wrapper">

			<div class="login-form-col">

			 

		    <h1 style="margin-left: 15px;">Create Post</h1>

            <div class="postmedia-popcol">

              <div class="user-postmedia-head" style="text-align: center; margin-top: 10px;margin-bottom: 10px;">

              	<input type="hidden" name="type" id="modal-type">

									

                  <button type="button" onclick="opengallery('gallery')">Upload from Gallery</button> 

                  <button type="button" onclick="opencamera('camera')" id="start-camera">Start Camera</button> 

              </div>

                

              <div class="postmedia-inner">

              	<video autoplay="true" id="videoElement" class="w-100" style="display:none;"></video>

              <div class="postlive-popcol" id="video-open" style="display:none;">

              <!-- <video id="video" autoplay="true" class="w-100"></video> -->

              

              <!-- <canvas id="canvas" width="500" height="320" style="display: none;"></canvas> -->

              <div class="camera-snap">

              <button id="start-record">Start Recording</button>

              <canvas id="canvas-video" width="500" height="320" style="display: none;"></canvas>

							<button id="stop-record" style="display:none;">Stop Recording</button>

							<button style="display:none;" id="download-btn"><a id="download-video" download="{{time()}}.webm" >Download Video</a></button>

            </div>

            </div>



            <div class="postlive-popcol" id="image-snap" style="display:none;">

              

              

              <canvas id="canvas" width="500" height="320" style="display: none;"></canvas>

              <div class="camera-snap">

              <button id="click-photo">Take Snap</button>

            </div>

            </div>

					    <div class="file-loading drop-zone" id="file-vdo">

					    	<video width="240" height="160" controls style="display: none;" id="video-preview" style="display:none;">

							  <source src="" type="video/mp4">

							  <source src="" type="video/ogg">

							  	Your browser does not support the video tag.

							</video>

                   <input type="file" accept="video/*" id="vdofile" onchange="previewvideo(this)">

              </div>

               <div class="file-loading drop-zone" id="file-img">

					    	<img src="" id="flie-preview" style="width:300px;height:150px;display: none;">

                   <input type="file" accept="image/jpg, image/png, image/jpeg" name="media" class="file" data-overwrite-initial="false" data-min-file-count="2" id="file" onchange="previewimage(this)">

              </div>					

              </div>    

            </div>

               

           <div class="common-box" style="display:none" id="image-post">

              <button type="button" class="common-btn w-100" id="closemodal">Add to your post</button>

          </div> 

			     <div class="common-box" style="display:none" id="video-post">

              <button type="button" class="common-btn w-100" id="closevdomodal" disabled>Upload to your post</button>

          </div>   

		  </div>

		  </div>

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



		if(idioma.text!='' && idioma.id!='')

		{

			var img = $(idioma.element).attr('data-img');

		   // console.log(img);

		  	var $span = $("<span><img src="+img+" style='width:30px;height:30px;'/> " + idioma.text + "</span>");

		  	return $span;

		}

		

  },

	templateSelection: function (idioma) {

		var img = $(idioma.element).attr('data-img');

  	var $span = $("<span><img src="+img+" style='width:30px;height:30px;'/> " + idioma.text + "</span>");

  	return $span;

  },

  formatNoMatches: function () {

  return "No Results Found";

  }

});



	</script>











@endsection