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

                                All User Messages

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

                                        <th>Name</th>

                                        <th>Email</th>

                                        <th>Subject</th>

                                        <th>Message</th>
                                        
                                        <th>Continent</th>
                                        <th>Category</th>
                                        <th>Sub-Category</th>
                                        

                                        <th>Date</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    

                                    @foreach($messages as $key=>$msg)

                                    @php

                                    $newuser=\Session::get('admin');

                                      $permissionreport=DB::table('roles_permissions')->where('role_id',$newuser->role_id)->where('title','user messages')->first();

                                      $user=DB::table('users')->where('id',$msg->user_id)->first();

                                    @endphp

                                    <tr>

                                        <td scope="row">{{$key+1}}</td>

                                        <td>{{$msg->name}}</td>

                                        <td>{{$msg->email}}</td>

                                        <td>{{$msg->title}}</td>

                                        <td>{{$msg->message}}</td>
                                        
                                        <td>{{$msg->continent_name}}</td>
                                        <td>{{$msg->category_name}}</td>
                                        <td>{{$msg->subcategory_name}}</td>
                                        

                                        <td>{{$msg->created_at}}</td>

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