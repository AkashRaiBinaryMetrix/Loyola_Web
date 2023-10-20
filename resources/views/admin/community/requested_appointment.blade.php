@extends('admin.layout.app')

@section('content')

      

<section class="content">

       <div class="container-fluid">

           <div class="block-header">

               <h2>Requested Appointment</h2>

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

                          Requested Appointment

                           </h2>


                       </div>

                       <div class="body table-responsive">

                           <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >

                               <thead>

                                   <tr>


                                       <th>Name</th>

                                       <th>Profile Pic</th>

                                       <th>Other Details</th>

                                       <th>Metting Type</th>

                                       <th>Schedule & Unschedule</th>

                                       <th>Applied Date</th>

                                       <th>Appointment Date</th>

                                       <th>Type</th>

                                       <th>Date</th>

                                       <th>Time</th>

                                       <th>Room Id</th>

                                   </tr>

                               </thead>

                               <tbody>

                               @foreach($appointment as $appointment)


                                   <tr>

                                       <th scope="row">{{$appointment->name}}</td>
                                       
                                       <td><img src="{{str_replace('neuroez','neuroez/public',(asset($appointment->profile_pic)))}}"style="max-width:70px;"></td>

                                       <td>{{$appointment->other_details}}</td>

                                       <td>{{$appointment->meeting_type}}</td>

                                       <td>{{$appointment->schedule_unsche}}</td>

                                       <td>{{$appointment->applied_date}}</td>

                                       <td>{{$appointment->appointment_date}}</td>

                                       <td>{{$appointment->type}}</td>

                                       <td>{{$appointment->date}}</td>

                                       <td>{{$appointment->time}}</td>

                                       <td>{{$appointment->room_id}}</td>

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



