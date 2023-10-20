 @extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manage Community Request</h2>
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
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($request as $key=>$comm)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$comm->name}}</td>
                                        <td>{{$comm->description}}</td>
                                        <td>
                                            @if(is_null($comm->status))
                                                Active
                                            @elseif($comm->status==1)
                                                Active
                                            @elseif($comm->status==0)
                                                Inactive
                                            @endif
                                        </td>
                                        <td>
                                           
                                            @if(is_null($comm->status))
                                               <a href="javascript:void" class="btn btn-danger" onclick="approvecomm('{{$comm->id}}','0')" id="del{{$comm->id}}" ><i class="fa fa-trash" ></i>Inactive</a>
                                            @elseif($comm->status==1)
                                               <a href="javascript:void" class="btn btn-danger" onclick="approvecomm('{{$comm->id}}','0')" id="del{{$comm->id}}" ><i class="fa fa-trash" ></i>Inactive</a>
                                            @elseif($comm->status==0)

                                               <a href="javascript:void" class="btn btn-success" onclick="approvecomm('{{$comm->id}}','1')" id="app{{$comm->id}}" style="padding-right: 3px;"><i class="fa fa-check" ></i>Active</a>
                                            @endif
                                            <a href="javascript:void" class="btn btn-success" onclick="approvecomm('{{$comm->id}}','1')" id="app{{$comm->id}}" style="display: none;"><i class="fa fa-check" style="padding-right: 3px;"></i>Active</a>
                                            <a href="javascript:void" class="btn btn-danger" onclick="approvecomm('{{$comm->id}}','0')" id="del{{$comm->id}}" style="display: none;"><i class="fa fa-trash" style="padding-right: 3px;"></i>Inactive</a>
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