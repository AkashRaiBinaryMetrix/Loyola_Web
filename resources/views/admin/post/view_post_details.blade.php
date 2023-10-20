@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Post Details
                </h2>
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="mypost-col" id="delete{{$posts->id}}">
                           <!-- <div class="mypost-pic"><a href="#"><img src="{{asset('public/images/gaming-post-1.jpg') }}" alt=""></a></div> -->
                          <div class="mypost-content">
                              <div class="mypost-title">
                                {{$posts->title}}
                              </div>
                                <div class="mypost-title">
                                @if(!empty($posts->media))
                                <div class="poll-pic">
                                @if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
                                        <img src="{{asset('public/post/'.$posts->media)}}" class="img-responsive"  style="">
                                        @elseif($extension[1]=='mp4')
                                            <video width="320" height="240" controls>
                                          <source src="{{asset('public/post/'.$posts->media)}}" type="video/mp4">
                                          <source src="{{asset('public/post/'.$posts->media)}}" type="video/ogg">
                                        Your browser does not support the video tag.
                                        </video> 
                                        @elseif($extension[1]=='ogg')
                                            <audio controls>
                                          <source src="{{asset('public/post/'.$posts->media)}}" type="audio/ogg">
                                          <source src="{{asset('public/post/'.$posts->media)}}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                        </audio> 
                                        @endif
                                      </div>
                                @else
                                @if(!empty($postdata))
                                {!!$postdata!!}
                                @endif
                                @endif
                              </div>
                              <div class="mypost-info" style="margin-top: 10px;">
                                <span class="mypost-community"><strong>Community</strong> -{{$posts->title}}</span>
                              </div>
                              <div class="mypost-info" style="margin-top: 10px;">
                                  <span class="mypost-user">Posted by {{ $posts->name }}</span>
                                  <span class="mypost-time">{{ $time }}</span>
                              </div>
                             
                          </div>
                       </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection