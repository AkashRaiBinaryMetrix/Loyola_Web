@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                   Privacy Policy
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
                            <form id="form_validation" method="POST" action="{{route('admin.content.privacy_policy')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <label class="form-label">Welcome to our IF YOU WERE</label>
                                    <div class="form-line">
                                        <textarea name="content" cols="30" rows="5" class="form-control ckeditor">@if(!empty($privacypolicy)) {{($privacypolicy->content)? $privacypolicy->content :''}} @endif</textarea>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Where does it come from?</label>
                                    <div class="form-line">
                                        <textarea name="content1" cols="30" rows="5" class="form-control ckeditor">@if(!empty($privacypolicy)) {{($privacypolicy->content1)? $privacypolicy->content1 :''}} @endif</textarea>
                                    </div>
                                </div>

                                 <div class="form-group form-float">
                                    <label class="form-label">Why do we use it?</label>
                                    <div class="form-line">
                                        <textarea name="content2" cols="30" rows="5" class="form-control ckeditor">@if(!empty($privacypolicy)) {{($privacypolicy->content2)? $privacypolicy->content2 :''}} @endif</textarea>
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