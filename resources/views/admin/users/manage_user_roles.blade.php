 @extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manage User Roles</h2>
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
            </div>
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All Roles
                            </h2>
                           
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $key=>$role)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            <a href="{{route('admin.users.role.edit',encrypt($role->id))}}" class="btn btn-success"><i class="fa fa-edit" style="padding-right: 3px;"></i>Edit</a>
                                            <a href="{{url('admin/delete-user-role/'.encrypt($role->id))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" ><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
</section>
@endsection