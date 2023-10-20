 @extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manage Subcategory</h2>
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
                                All Subcategories
                            </h2>
                            <!-- <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $user=\Session::get('admin');
                                    $permissionsubcategory=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','subcategory')->first();
                                    @endphp
                                    @foreach($subcategory as $key=>$subcat)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$subcat->title}}</td>
                                        <td>{{$subcat->name}}</td>
                                        <td>
                                            @if($subcat->status==1)
                                              Active
                                            @else
                                              Inactive
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($user) && !empty($permissionsubcategory) && $permissionsubcategory->edit==1 || $user->role_id==1)
                                            <a href="{{route('admin.edit.subcategory',encrypt($subcat->id))}}" class="btn btn-success"><i class="fa fa-edit" style="padding-right: 3px;"></i>Edit</a>
                                            @endif
                                            @if(!empty($user) && !empty($permissionsubcategory) && $permissionsubcategory->delete==1 || $user->role_id==1)
                                            <a href="{{route('admin.delete.subcategory',encrypt($subcat->id))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" ><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete</a>
                                            @endif
                                            
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