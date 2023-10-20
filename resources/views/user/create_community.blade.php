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

	    <div class="create-btns">

		  <a href="javascript:void" class="create-active">Request Community</a>   

		</div>

	   <form method="post" action="{{route('user.create.community')}}" enctype="multipart/form-data">

	   	@csrf

		<div class="inner-createnow">

		  <div class="top-innercreate">

			 <div class="row">

			 <div class="form-group col-12">
				   <div class="form-group createpost-field">
					<label>Continent</label>
					<select class="form-control" name="continent" id="continent" required="" onchange="displayCategory();">
						<option value="">Select Continent</option>
						@foreach ($continentsList as $continentsListResult)
							<option value="{{$continentsListResult->name}}">{{$continentsListResult->name}}</option>
						@endforeach
					</select>
				  </div>
			 </div>

			 <div class="form-group col-12">
				   <div class="form-group createpost-field">
					<label>Category</label>
					<div id="category_div"></div>
				  </div>
			 </div>

			 <div class="form-group col-12">
				   <div class="form-group createpost-field">
					<label>Sub-Category</label>
					<div id="sub_category_div"></div>
				  </div>
			 </div>

				 <div class="form-group col-12">

				   <div class="form-group createpost-field">

					<label>Community Name</label>

					<input type="text" class="form-control" name="name" id="" placeholder="" required="">

				  </div>

				 </div>

				 

				 <div class="form-group col-12">

				<textarea class="form-control" id="message" name="description" placeholder="Tell us more about your community" rows="4"></textarea>

				</div>



				<div class="form-group col-12">

				   <div class="form-group createpost-field">

					<label>Upload Profile Image</label>

					<input type="file" class="form-control" name="image"  placeholder="" required="" onchange="previewimgcomm(this)">

				  </div>

				  <div class="form-group form-float">

                    <img id="previewimg" style="height: 200px;display: none;">

                   </div>

				 </div>

				 <div class="form-group col-12">

				   <div class="form-group createpost-field">

					<label>Upload Cover Image</label>

					<input type="file" class="form-control" name="cover_image"  placeholder="" required="" onchange="previewcoverimg(this)">

				  </div>

				  <div class="form-group form-float">

                    <img id="previecoverwimg" style="height: 200px;display: none;">

                   </div>

				 </div>

			  

			 </div>

			   

			

			<div class="form-group mb-1 mt-4 submit-col text-md-right">

			  <button type="submit" class="common-btn">Submit</button>

			</div>

			  

		  </div>   

		   

		   

		</div>   

	   </form>

	   </div>

	   

	</div>	   

</div>

@endsection