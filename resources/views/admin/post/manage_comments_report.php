 @extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <!-- <h2>All Posts Report</h2> -->
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
                                All Posts Report
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
                        <div class="body" style="overflow: scroll;">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Post By</th>
                                        <th>Report</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($report as $key=>$post)
                                    @php
                                    $newuser=\Session::get('admin');
                                      $permissionreport=DB::table('roles_permissions')->where('role_id',$newuser->role_id)->where('title','post report')->first();
                                      $user=DB::table('users')->where('id',$post->user_id)->first();
                                    @endphp
                                    <tr>
                                        <td scope="row">{{$key+1}}</td>
                                        <td>{{$post->name}}</td>
                                        <td>{{($user)?$user->name:''}}</td>
                                        <td>{{$post->report}}</td>
                                        <td>
                                            <a href="{{ route('admin.user.post.details',encrypt($post->post_id)) }}" class="btn btn-success" id="app{{$post->id}}" ><i class="fa fa-eye" style="padding-right: 3px;"></i>View Details</a>
                                             @if(!empty($newuser) && !empty($permissionreport) && $permissionreport->delete==1 || $newuser->role_id==1)
                                            <a href="{{route('admin.post.delete',encrypt($post->post_id))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to permanently delete?')" id="del{{$post->id}}" ><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete Post</a>
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