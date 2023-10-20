@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Role Management
                    
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
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                            <li>{{ $error }}</li>
                    </ul>
                </div>
                @endforeach
                @endif
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form id="form_validation" method="POST" action="{{route('admin.users.role.add')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <label class="form-label">Name</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('name') }}">
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Slug</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="slug"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('slug') }}">
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