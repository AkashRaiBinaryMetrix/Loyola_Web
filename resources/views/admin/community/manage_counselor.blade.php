@extends('admin.layout.app')

@section('content')

<script>
        function myactivate(id){
            var form_data = new FormData();
            form_data.append("id", id);
            form_data.append("_token", "{{ csrf_token() }}");
                
            $.ajax({
                                    url:"{{ route('admin.myactivate') }}",
                                    method:"POST",
                                    data: form_data ,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success:function(data)
                                    {  
                                      //$("#demo1").html("Deactivate");   // Add this line
                                      window.location.reload();
                                    }
                                });    
        }

        function mydeactivate(id){
            var form_data = new FormData();
            form_data.append("id", id);
            form_data.append("_token", "{{ csrf_token() }}");
                
            $.ajax({
                                    url:"{{ route('admin.deactivate') }}",
                                    method:"POST",
                                    data: form_data ,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success:function(data)
                                    {  
                                      //$("#demo1").html("Deactivate");   // Add this line
                                      window.location.reload();
                                    }
                                });
        }
</script>

<section class="content">

       <div class="container-fluid">

           <div class="block-header">

               <h2>Manage Counselor</h2>

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

                           Manage Counselor

                           </h2>


                       </div>

                       <div class="body table-responsive">

                           <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >

                               <thead>

                                   <tr>


                                       <th>Name</th>

                                       <th>Email</th>

                                       <th>Phone</th>

                                       <th>Designation</th>

                                       <th>Experience</th>

                                       <th>Gender</th>

                                       <th>Age</th>

                                       <th>Location</th>

                                       <th>Weight</th>

                                       <th>Height</th>

                                       <th>City</th>

                                       <th>Country</th>

                                       <th>Doctor Qualification</th>

                                       <th>Doctor Experience</th>

                                       <th>Service Type</th>

                                       <th>Doctor Fees</th>

                                       <th>Status</th>

                                       <th>Edit</th>

                                   </tr>

                               </thead>

                               <tbody>

                               @foreach($counselor as $counselor)

                                   <tr>

                                       <th scope="row">{{$counselor->name}}</td>

                                       <td>{{$counselor->email}}</td>

                                       <td>{{$counselor->phone}}</td>

                                       <td>{{$counselor->designation}}</td>

                                       <td>{{$counselor->doctor_experience}}</td>

                                       <td>{{$counselor->gender}}</td>

                                       <td>{{$counselor->age}}</td>

                                       <td>{{$counselor->location}}</td>
                                       
                                       <td>{{$counselor->weight}}</td>

                                       <td>{{$counselor->height}}</td>

                                       <td>{{$counselor->city}}</td>

                                       <td>{{$counselor->country}}</td>

                                       <td>{{$counselor->doctor_qualification}}</td>

                                       <td>{{$counselor->doctor_experience}}</td>

                                       <td>{{$counselor->services_type}}</td>

                                       <td>{{$counselor->doctor_fess}}</td>
                                       
                                       <td>
                                        @php 
                                            $var = $counselor->id;
                                            
                                            if($counselor->status == '1'){ 
                                        @endphp
                                         
                                        <button id="demo" onclick="mydeactivate({{$var}})">Deactivate</button>
                                        
                                        @php
                                            }else{
                                        @endphp

                                        <button id="demo1" onclick="myactivate({{$var}})">Activate</button>
                                        
                                        @php
                                            }
                                        @endphp
                                        </td>

                                        <td><a href="{{ url('admin/edit-counselor/'.$counselor->id) }}">Edit</a></td>
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



