@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                   About Us
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
                            <form id="form_validation" method="POST" action="{{route('admin.content.about')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <label class="form-label">Description</label>
                                    <div class="form-line">
                                        <textarea name="description" cols="30" rows="5" class="form-control">{{($about->about)? $about->about :''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">How Does It Works</label>
                                    <div class="form-line">
                                        <textarea name="content" cols="30" rows="5" class="form-control">{{($about->content)? $about->content :''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Update Image</label> </br>
                                    <img src="{{asset('public/about/'.$about->image)}}" class="img-rounded" style="width:200px;height:200px;">
                                </div>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="file" name="image" class="form-control">
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