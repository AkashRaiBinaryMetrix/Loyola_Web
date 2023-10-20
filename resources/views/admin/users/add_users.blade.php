@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Add Users
                    
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
                @php 
                $errorsall=$errors->all(); @endphp
                @endif
            </div>
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form id="form_validation" method="POST" action="{{route('admin.add.users')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <label class="form-label">Name</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('name') }}">
                                        
                                    </div>
                                    @if($errors->has('name'))
                                            <span style="color: red;">{{ $errors->first('name') }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Email</label>
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('email') }}">
                                        
                                    </div>
                                    @if($errors->has('email'))
                                            <span style="color: red;">{{ $errors->first('email') }}</span>
                                        @enderror
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Password</label>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="password"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('password') }}">
                                        
                                    </div>
                                    @if($errors->has('password'))
                                        <span style="color: red;">{{ $errors->first('password') }}</span>
                                        @enderror
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="confirm_password"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('confirm_password') }}">
                                        
                                    </div>
                                    @if($errors->has('confirm_password'))
                                            <span style="color: red;">{{ $errors->first('confirm_password') }}</span>
                                    @enderror
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Select Role</label>
                                    <div class="form-line">
                                        <select name="role_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($roles as $role)
                                            @if($role->name!='Admin')
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                     @if($errors->has('role_id'))
                                            <span style="color: red;">{{ $errors->first('role_id') }}</span>
                                    @enderror
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