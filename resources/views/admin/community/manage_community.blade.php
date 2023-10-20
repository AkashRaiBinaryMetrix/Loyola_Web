 @extends('admin.layout.app')

 @section('content')

 <section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <h2>Manage Community</h2>

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

                                All Communities

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

                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >

                                <thead>

                                    <tr>

                                        <th>#</th>

                                        <th>Category</th>

                                        <th>Subcategory</th>

                                        <th>Title</th>

                                        <th>Details</th>

                                        <th>Images</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @php 

                                    $user=\Session::get('admin');

                                    $permissionCommunity=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','Community')->first();

                                    @endphp

                                    

                                    @foreach($community as $key=>$comm)

                                    <tr>

                                        <input type="hidden" name="id" value="{{$comm->id}}" id="id{{$key+1}}">

                                        <input type="hidden" id="des{{$key+1}}" value="{{$comm->description}}">

                                        <input type="hidden" id="img{{$key+1}}" value="{{asset('public/community/'.$comm->image)}}" >

                                        <input type="hidden" id="title{{$key+1}}" value="{{$comm->title}}">

                                        <th scope="row">{{$key+1}}</th>

                                        <td>{{($comm->category ? $comm->category : '' )}}</td>

                                        <td>{{($comm->subcategory ? $comm->subcategory : '' )}}</td>

                                        <td>{{$comm->title}}</td>

                                        <td><a href="" class="btn btn-success" data-toggle="modal" data-target="#detail" onclick="details('{{$key+1}}')"><i class="fa fa-eye" style="padding-right: 3px;"></i>View Details</a></td>

                                        <td><a href="" class="btn btn-success" data-toggle="modal" data-target="#img" onclick="imgopen('{{$key+1}}')"><i class="fa fa-eye" style="padding-right: 3px;"></i></a></td>

                                        <td>

                                            @if(!empty($user) && !empty($permissionCommunity) && $permissionCommunity->edit==1 || $user->role_id==1)

                                            <a href="{{route('admin.edit.community',$comm->id)}}" class="btn btn-success" onclick="editcomm('comm{{$key+1}}')"><i class="fa fa-edit" style="padding-right: 3px;"></i>Edit</a>

                                            @endif

                                            @if(!empty($user) && !empty($permissionCommunity) && $permissionCommunity->delete==1 || $user->role_id==1)

                                            <a href="{{url('admin/delete-community/'.$comm->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" id="del{{$key+1}}"><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete</a>

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

        <div id="detail" class="modal fade" role="dialog">

          <div class="modal-dialog">



            <!-- Modal content-->

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title" id="titlecom"></h4>

              </div>

              <div class="modal-body">

                <p id="desall"></p>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

              </div>

            </div>



          </div>

        </div>

        <div id="img" class="modal fade" role="dialog">

          <div class="modal-dialog">



            <!-- Modal content-->

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title" id="titleimg"></h4>

              </div>

              <div class="modal-body">

                <p id="imges"></p>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

              </div>

            </div>



          </div>

        </div>

</section>

@endsection