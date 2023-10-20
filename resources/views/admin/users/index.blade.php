 @extends('admin.layout.app')

 @section('content')

 <section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <h2>Users</h2>

            </div>

            <!-- Basic Table -->

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">



                        <div class="header">




                           

                        </div>

                        <div class="body" style="overflow: scroll;">



                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                <thead> 

                                    <tr>

                                        <th>#</th>

                                        <th>Name</th>

                                        <th>Email ID</th>

                                        <th>Mobile No</th>

                                        <th>DOB</th>

                                        <th>Created Date & Time</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($users as $key=>$user)

                                    <tr>

                                        <th scope="row">{{$key+1}}</th>

                                        <td>{{$user->name}}</td>

                                        <td>{{$user->email}}</td>

                                        <td>{{$user->phone}}</td>

                                        <td>{{$user->dob}}</td>

                                        <td>{{date('m-d-Y h:i:s',strtotime($user->created_at))}}</td> 


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