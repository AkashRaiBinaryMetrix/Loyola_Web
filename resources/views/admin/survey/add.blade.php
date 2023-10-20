@extends('admin.layout.app')

@section('content')

<section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <h2><a href="{{url('admin/survey')}}">Survey >> </a> Add Survey</h2><br>
                
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
                            action="{{ url('admin/survey/create')}}" 
                                enctype="multipart/form-data">

                                @csrf
                                @method('POST')

                                <div class="form-group form-float">

                                    <label class="form-label">Category</label>

                                    <div class="form-line">

                                        <select class="form-control" name="category_id" required="">

                                            <option value="">Select</option>
                                        @foreach($categoryLists as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                           

                                        </select>

                                </div>

                                </div>

                                <div class="form-group form-float">

                                    <label class="form-label">Heading</label>

                                    <div class="form-line">

                                        <input type="text" class="form-control" name="heading"  placeholder="Enter heading" required="">

                                </div>

                                </div>


                                <div class="form-group form-float">

                                    <label class="form-label">Description</label>

                                    <div class="form-line">

                                        <input type="text" class="form-control" name="description"  placeholder="Enter description" required="">

                                </div>

                                </div>

                                <div class="form-group form-float">

                                    <label class="form-label">Status</label>

                                    <div class="form-line">

                                        <select class="form-control" name="status" required="">

                                            <option value="">Select</option>

                                            <option value="active">Active</option>

                                            <option value="inactive">Inactive</option>

                                        </select>

                                </div>

                                </div>

                                <div class="form-group form-float">

                                    <label class="form-label">Published Date</label>

                                    <div class="form-line">

                                        <input type="date" min="<?php echo date("Y-m-d"); ?>" class="form-control" name="published_date" required="">

                                </div>

                                </div>

                               

                                <div class="form-group form-float">

                                    <label class="form-label">Image (accept only jpg,png)</label>

                                    <div class="form-line">

                                        <input type="file" accept="image/png, image/jpeg" name="image" class="form-control" required="">

                                </div>

                                </div>

                                <input class="btn btn-primary waves-effect" type="submit"  value="SUBMIT">

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection