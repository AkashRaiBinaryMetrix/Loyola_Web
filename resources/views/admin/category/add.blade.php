@extends('admin.layout.app')

@section('content')

<section class="content">

        <div class="container-fluid">

            <div class="block-header">

               <h2> <a href="{{url('admin/category')}}">Category >> </a>   Add Category</h2><br>
                
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
                            action="{{url('admin/category/create')}}" 
                                enctype="multipart/form-data">

                                @csrf
                                @method('POST')
                                <div class="form-group form-float">

                                    <label class="form-label">Name</label>

                                    <div class="form-line">

                                        <input type="text"  class="form-control" name="name" placeholder="Enter Category Name" required="">

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

                                    <label class="form-label">Image</label>

                                    <div class="form-line">

                                        <input type="file" name="image" class="form-control" required="" accept="image/png, image/jpeg">

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