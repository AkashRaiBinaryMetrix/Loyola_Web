<div class="newsfeed-title"><h3>{{$post->title}}</h3></div> 
			   <div class="newsfeed-mainpic">
			   	<!-- <img src="{{asset('public/images/gaming-post-1.jpg')}}" alt=""> -->
			      @if(!empty($post->media))
				   	@if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
						  	<img src="{{asset('public/post/'.$post->media)}}" id="imgcom" style="max-height: 300px;">
						  	@elseif($extension[1]=='mp4')
						  		<video width="320" height="240" controls>
							  <source src="{{asset('public/post/'.$post->media)}}" type="video/mp4">
							  <source src="{{asset('public/post/'.$post->media)}}" type="video/ogg">
							Your browser does not support the video tag.
							</video> 
						  	@elseif($extension[1]=='ogg')
						  		<audio controls>
							  <source src="{{asset('public/post/'.$post->media)}}" type="audio/ogg">
							  <source src="{{asset('public/post/'.$post->media)}}" type="audio/mpeg">
							Your browser does not support the audio element.
							</audio> 
						  	@endif
				    @elseif(!empty($post->post))
				   	{!!$postdata!!}
				   	@endif
			   </div>