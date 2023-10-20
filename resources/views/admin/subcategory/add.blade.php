@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Add Subcategory
                    
                </h2>
                @if ($message = Session::get('error'))
                <!-- <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div> -->
                <script type="text/javascript">alert('Subcategory already exists');</script>
                @endif
                @if ($message = Session::get('success'))
                <!-- <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div> -->
                <script type="text/javascript">alert('Subcategory added successfully');</script>
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
                            <form id="form_validation" method="POST" action="{{route('admin.add.subcategory')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <label class="form-label">Select Continent</label>
                                    <div class="form-line">
                                        <select class="form-control" name="continent" required="" id="">
                                            <option value="">Select</option>
                                            @foreach($continent as $cntinent)
                                            <option value="{{$cntinent->name}}">{{$cntinent->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Select Category</label>
                                    <div class="form-line">
                                        <select class="form-control" name="cat_id" required="">
                                           <option value="">Select</option>
                                           @foreach($category as $cat) 
                                           <option value="{{$cat->id}}">{{$cat->title}}</option>
                                           @endforeach
                                        </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Sub Category Name</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('name') }}" placeholder="Enter Sub Category Name" required="">
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Status</label>
                                    <div class="form-line">
                                        <select class="form-control" name="status" required="">
                                            <option value="">Select</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Image</label>
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