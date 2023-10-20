@extends('admin.layout.app')

@section('content')

<section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <h2><a href="{{url('admin/category')}}">Category >> </a> Edit Category</h2><br>
                
            <!-- Basic Validation -->

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>{{ $message }}</strong>

                            </div>
                        @endif

                        <div class="body">

                            <form id="form_validation" method="POST" 
                            action="{{$category->id}}" 
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')
                                <div class="form-group form-float">

                                    <label class="form-label">Name</label>

                                    <div class="form-line">

                                        <input type="text"  class="form-control" name="name" value="{{ $category->name }}" placeholder="Enter Category Name" required="">

                                </div>

                                </div>

                                <div class="form-group form-float">

                                    <label class="form-label">Status</label>

                                    <div class="form-line">

                                        <select class="form-control" name="status" required="">

                                            <option value="">Select</option>

                                            <option value="active" @if($category->status=='active') selected @endif>Active</option>

                                            <option value="inactive" @if($category->status=='inactive') selected @endif>Inactive</option>

                                        </select>

                                </div>

                                </div>

                                <div class="form-group form-float">

                                    <label class="form-label">Image</label>

                                    <div class="form-line">

                                        <img src="{{ url('public/category') }}/{{$category->image}}" class="img-responsive" width="10%">

                                </div>

                                </div>

                                <div class="form-group form-float">

                                    <label class="form-label">Image</label>

                                    <div class="form-line">

                                        <input type="file" name="image" class="form-control" accept="image/png, image/jpeg">

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