@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Edit Community 
                </h2>
                @if ($message = Session::get('error'))
                <!-- <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div> -->
                <script type="text/javascript">alert('Community already exists');</script>
                @endif
                @if ($message = Session::get('success'))
                <!-- <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div> -->
                <script type="text/javascript">alert('Community edited successfully');</script>
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
                            <form id="form_validation" method="POST" action="{{url('admin/edit-community/'.$community->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <label class="form-label">Select Continent</label>
                                    <div class="form-line">
                                        <select class="form-control" name="continent" required="" id="">
                                            <option value="">Select</option>
                                            @foreach($continent as $cntinent)
                                            <option value="{{$cntinent->id}}"@if(!empty($community) && $community->continent==$cntinent->id) selected @endif>{{$cntinent->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Select Category</label>
                                    <div class="form-line">
                                        <select class="form-control" name="cat_id" id="catid">
                                            <option value="">Select</option>
                                            @if(!empty($category) && count($category)>0)
                                            @foreach($category as $cat)
                                            <option value="{{$cat->id}}"@if(!empty($community) && $community->cat_id==$cat->id) selected @endif>{{$cat->title}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Select SubCategory</label>
                                    <div class="form-line">
                                        <select class="form-control" name="subcat_id"  id="subcat">
                                            <option value="">Select</option>
                                            @if(!empty($subcategory) && count($subcategory)>0)
                                            @foreach($subcategory as $subcat)
                                            <option value="{{$subcat->id}}"@if(!empty($community) && $community->subcat_id==$subcat->id) selected @endif>{{$subcat->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Title</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="title"  readonly onfocus="this.removeAttribute('readonly');" value="{{ $community->title }}">
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Description</label>
                                    <div class="form-line">
                                        <textarea name="description" cols="30" rows="5" class="form-control" >{{ strip_tags($community->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Profile Image</label>
                                    <div class="form-line">
                                        <a href="{{asset('public/community/'.$community->image)}}" target="_blank">
                                            <img src="{{asset('public/community/'.$community->image)}}" style="width:200px;height: 200px;" id="previewimg">
                                            
                                        </a>
                                    </div>
                                
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="image" onchange="previewimgcomm(this)">
                                    </div>
                                    <span id="proimg"></span>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Cover Image</label>
                                    <div class="form-line">
                                        <a href="{{asset('public/community/'.$community->cover_image)}}" target="_blank"><img src="{{asset('public/community/'.$community->cover_image)}}" style="width:200px;height: 200px;" id="previecoverwimg"></a>
                                    </div>
                                
                                    <div class="form-line">
                                        <!-- <input type="file" class="form-control coverimage" > -->
                                        <input type="file" class="form-control" name="cover_image" onchange="previewcoverimg(this)">
                                    </div>
                                    <span id="cover-image"></span>
                                    
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="covermodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="modal-Label"></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<div class="img-container">
<div class="row">
<div class="col-md-8">
<img id="coverimage" src="">
</div>
<div class="col-md-4">
<div class="coverpreview"></div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-primary" id="covercrop">Crop</button>
</div>
</div>
</div>
</div>
@endsection