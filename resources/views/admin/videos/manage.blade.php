 @extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manage Videos</h2>
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
                                All Videos
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
                                        <th>Title</th>
                                        <th>Url</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($videos)>0)
                                    @php 
                                    $user=\Session::get('admin');
                                    $permissionVideos=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','Videos')->first();
                                    @endphp
                                    @foreach($videos as $key=>$video)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$video->title}}</td>
                                        <td>{{$video->url}}</td>
                                        
                                        <td>{{ date('d-m-Y h:m:i A'),strtotime($video->created_at) }}</td>
                                        <td>
                                            @if(!empty($user) && !empty($permissionVideos) && $permissionVideos->edit==1 || $user->role_id==1)
                                            <a href="{{route('admin.video.edit',encrypt($video->id))}}" class="btn btn-success"><i class="fa fa-edit" style="padding-right: 3px;"></i>Edit</a>
                                            @endif
                                            @if(!empty($user) && !empty($permissionVideos) && $permissionVideos->delete==1 || $user->role_id==1)
                                            <a href="{{route('admin.video.delete',encrypt($video->id))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" id="del{{$key+1}}"><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>No Data Found</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
</section>
@endsection