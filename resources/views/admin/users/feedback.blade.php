 @extends('admin.layout.app')

 @section('content')

 <section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <h2>User Feedbacks</h2>

            </div>

            <!-- Basic Table -->

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">


                        <div class="body" style="overflow: scroll;">



                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                <thead> 

                                    <tr>

                                        <th>#</th>
                                        <th>User Name</th>

                                        <th>Type</th>

                                        <th>Rate</th>

                                        <th>Message</th>

                                        <th>Created Date & Time</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($feedbackLists as $key=>$feedback)

                                    <tr>

                                        <th scope="row">{{$key+1}}</th>
                                        
                                        <td>{{ isset($feedback->user->name) ?  $feedback->user->name :null }} </td>

                                        <td>{{$feedback->type}}</td>

                                        <td>
                                            {{$feedback->rate}}
                                        </td>

                                        <td>{{$feedback->message}}</td>

                                        <td>{{date('m-d-Y h:i:s',strtotime($feedback->created_at))}}</td> 


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