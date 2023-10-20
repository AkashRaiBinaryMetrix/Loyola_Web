@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Add Community
                    
                </h2>
                @if ($message = Session::get('error'))
                <!-- <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div> -->
                <script type="text/javascript">alert('This Community is already added!');</script>
                @endif
                @if ($message = Session::get('success'))
                <!-- <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div> -->
                <script type="text/javascript">alert('Community added successfully!');</script>
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
                            <form id="community_form" method="POST" action="{{route('admin.add.community')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <label class="form-label">Select Continent</label>
                                    <div class="form-line">
                                        <select class="form-control" name="continent" required="" id="">
                                            <option value="">Select</option>
                                            @foreach($continent as $cntinent)
                                            <option value="{{$cntinent->id}}">{{$cntinent->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Select Category</label>
                                    <div class="form-line">
                                        <select class="form-control" name="cat_id" required="" id="catid">
                                            <option value="">Select</option>
                                            @foreach($category as $cat)
                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Select SubCategory</label>
                                    <div class="form-line">
                                        <select class="form-control" name="subcat_id" required="" id="subcat">
                                            <option value="">Select</option>
                                        </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Title</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="title"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('title') }}" id="title" required="">
                                    </div>
                                    <span id="commtitle"></span>
                                </div>
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Description</label>
                                    <div class="form-line">
                                        <textarea name="description" cols="30" rows="5" class="form-control" id="description" required=""></textarea>
                                    </div>
                                    <span id="commdes"></span>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Profile Image</label>
                                    <div class="form-line">
                                        <input type="file" class="form-control image" name="image" 
                                        id="profileimage" onchange="previewimgcomm(this)" >
                                    </div>
                                    <span id="proimg"></span>
                                </div>
                                <div class="form-group form-float">
                                <img id="previewimg" style="width:200px;height: 200px;display: none;">
                               </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Cover Image</label>
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="cover_image"   id="coverimg" onchange="previewcoverimg(this)">
                                    </div>
                                    <span id="coverimg"></span>
                                </div>
                                <!-- <input type="hidden" name="" id="coverimg">
                                <div class="form-group form-float"> -->
                                    <div class="form-group form-float">
                                <img id="previecoverwimg" style="width:200px;height: 200px;display: none;">
                               </div>
                                
                               </div>
                                <button class="btn btn-primary waves-effect" type="button" onclick="add_community()">SUBMIT</button>
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