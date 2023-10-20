@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                     @if(!empty($id))
                     Edit Faq
                     @else
                     Add Faq
                     @endif
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

                            @if(!empty($id))
                            <form id="form_validation" method="POST" action="{{route('admin.content.editfaq',$id)}}" enctype="multipart/form-data">
                            @else
                            <form id="form_validation" method="POST" action="{{route('admin.content.faq')}}" enctype="multipart/form-data">
                            @endif
                                @csrf
                                @if(!empty($id))
                                <input type="hidden" name="id" value="{{($id)?$id:''}}">
                                @endif
                                <div class="form-group form-float">
                                    <label class="form-label">Question Type</label>
                                    <div class="form-line">
                                       <select class="form-control" name="type">
                                           <option value="">Select</option>
                                           <option value="general"@if(!empty($faq) && $faq->type=='general')  selected @endif>General</option>
                                           <option value="other"@if(!empty($faq) && $faq->type=='other')  selected @endif>Other</option>
                                       </select> 
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Question</label>
                                    <div class="form-line">
                                        <input type="text" name="question"  class="form-control ckeditor" value="@if(!empty($faq)) {{($faq->question)? $faq->question :''}} @endif">
                                    </div>
                                </div>

                                 <div class="form-group form-float">
                                    <label class="form-label">Answer</label>
                                    <div class="form-line">
                                        <textarea name="answer" cols="30" rows="5" class="form-control">@if(!empty($faq)) {{($faq->answer)? $faq->answer :''}} @endif</textarea>
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