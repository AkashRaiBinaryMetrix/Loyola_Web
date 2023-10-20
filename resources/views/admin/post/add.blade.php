@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Add Post
                    
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
                            <form id="form_validation" method="POST" action="{{route('admin.add.post')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <label class="form-label">Select Community</label>
                                    <div class="form-line">
                                        <select class="form-control" name="community_id" >
                                           <option value="">Select</option>
                                           @foreach($community as $comm) 
                                           <option value="{{$comm->id}}">{{$comm->title}}</option>
                                           @endforeach
                                        </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Title</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="title"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('title') }}">
                                    </div>
                                </div>
                                <div class="form-group form-float" id="image-add">
                                    <label class="form-label">Images</label>
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="image"  accept="audio/*,video/*,image/*" id="file" onchange="previewimg(this)" >
                                        <div  id="imgsec" style="display: none;text-align: center;">
                                    <span class="drop-zone__prompt"></span>
                                   
                                    <img src="" id="blah" style="width:300px;height:150px;text-align: center;display: none;">
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
                                    </div>
                                </div>
                                
                                <div class="form-group form-float" id="editor-sec">
                                    <label class="form-label">Description</label>
                                    <div class="form-line">
                                        <textarea name="description" cols="30" rows="5" class="form-control" id="" onchange="descriptionadd()"></textarea>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection