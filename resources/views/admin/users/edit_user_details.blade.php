@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Edit User Details
                    
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
                            <form id="form_validation" method="POST" action="{{url('admin/edit-users/'.$user->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <label class="form-label">Name</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name"  readonly onfocus="this.removeAttribute('readonly');" value="{{ $user->name }}">
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Email</label>
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email"  readonly onfocus="this.removeAttribute('readonly');" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Select Role</label>
                                    <div class="form-line">
                                        <select name="role_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($roles as $role)
                                            @if($role->name!='Admin')
                                            <option value="{{$role->id}}"@if($user->role_id==$role->id) selected @endif>{{$role->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
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