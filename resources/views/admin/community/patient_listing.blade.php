@extends('admin.layout.app')

@section('content')


<section class="content">

       <div class="container-fluid">

           <div class="block-header">

               <h2>Patient Listing</h2>

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

                           Patient Listing

                           </h2>


                       </div>

                       <div class="body table-responsive">

                           <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >

                               <thead>

                                   <tr>


                                       <th>Name</th>

                                       <th>Email</th>

                                       <th>Phone</th>

                                       <th>Gender</th>

                                       <th>Blood Group</th>

                                       <th>Country</th>

                                       <th>Edit</th>

                                   </tr>

                               </thead>

                               <tbody>

                               @foreach($patient as $patient)

                                   <tr>

                                       <th scope="row">{{$patient->name}}</td>

                                       <td>{{$patient->email}}</td>

                                       <td>{{$patient->phone}}</td>

                                       <td>{{$patient->gender}}</td>

                                       <td>{{$patient->blood_group}}</td>

                                       <td>{{$patient->country}}</td>

                                       <td><a href="{{ url('admin/edit-patient-listing/'.$patient->id) }}">Edit</a></td>
                                    
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



