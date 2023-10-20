@extends('admin.layout.app')

@section('content')

<section class="content">

       <div class="container-fluid">

           <div class="block-header">

               <h2>Survey Question Options</h2>
           </div>

           <!-- Basic Table -->

           <div class="row clearfix">

               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                   <div class="card">

                       @if ($message = Session::get('success'))

                       <div class="alert alert-success alert-block">
       
                           <button type="button" class="close" data-dismiss="alert">×</button> 
       
                               <strong>{{ $message }}</strong>
       
                       </div>
       
                       @endif

                       <div class="body table-responsive">

                           <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Survey</th>
                                       <th>Question</th>
                                       <th>Option</th>
                                       <th>Status</th>
                                   </tr>
                               </thead>

                               <tbody>
                                   @foreach($optionLists as $key=>$optionList)
                                   <tr>
                                       <th scope="row">{{$key+1}}</th>
                                       <td>{{ isset($optionList->question->survey->heading) ? $optionList->question->survey->heading : '-' }}</td>
                                       <td>{{ isset($optionList->question->name) ? $optionList->question->name : '-' }}</td>
                                       <td>{{$optionList->name}}</td>
                                       <td>{{ Str::ucfirst($optionList->status)}}</td>
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