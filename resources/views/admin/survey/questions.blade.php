@extends('admin.layout.app')

@section('content')

<section class="content">

       <div class="container-fluid">

           <div class="block-header">

               <h2><a href="{{url('')}}/admin/survey">Survey : </a> 
                {{$survey->heading }}</h2>
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

                       @if ($message = Session::get('error'))

                       <div class="alert alert-danger alert-block">
       
                           <button type="button" class="close" data-dismiss="alert">×</button> 
       
                               <strong>{{ $message }}</strong>
       
                       </div>
       
                       @endif

                       <div class="body table-responsive">

                        <button type="button" class="btn btn-info btn-lg option" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-plus"></i> Add Question</button>

                           <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                               <thead>

                                   <tr>

                                       <th>#</th>
                                       <th>Question</th>
                                       <th>Status</th>
                                       {{-- <th>Action</th> --}}

                                   </tr>

                               </thead>

                               <tbody>
                                   @foreach($questionLists as $key=>$question)

                                   <tr>

                                       <th scope="row">{{$key+1}}</th>
                                       <td>{{$question->name}}</td>
                                       <td>{{ Str::ucfirst($question->status)}}</td>
                                       {{-- <td>
                                        <a href="survey/edit/{{$question->id}}" class="btn btn-sm btn-rounded btn-success">
                                           <i class="fa fa-eye"></i>
                                         View</a>
                                         
                                       

                                       </td> --}}

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


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Question and Options</h4>
        </div>
        
        <div class="modal-body">
          <form id="form_validation" method="POST" action="{{ url('admin/survey/save_question')}}" 
              enctype="multipart/form-data">

              @csrf
              @method('POST')
              <input type="hidden" name="survey_id" value="{{$survey->id}}">

              <div class="form-group form-float">
                <label class="form-label">Question</label>
                <div class="form-line">
                    <input type="text" class="form-control" name="name"  placeholder="Enter question" required="">
                 </div>

              </div>

              <div class="form-group form-float">
                  <label class="form-label">Question Type</label>
                  <div class="form-line">
                      <select class="form-control" name="type" required="">
                          <option value="">Select</option>
                          <option value="radio">Single Option (Radio)</option>
                          <option value="checkbox">Multiple Choice (Checkbox)</option>
                          <option value="input">Open End (Text Box)</option>
                      </select>

              </div>
              </div>

              <button onclick="add()" type="button" class="btn btn-info">Add</button>
              <button onclick="remove()" type="button" class="btn btn-danger">remove</button>
              <input type="hidden" value="1" id="total_chq">


 
              <div class="form-group form-float">
                <label class="form-label">Options</label>
                <div class="form-line">
                  <div id="new_chq">
                      <input type="text" class="form-control" name="options[]"  placeholder="Enter option">
                  </div>
              </div>
              </div>

        <div class="modal-footer">
            <input class="btn btn-primary waves-effect" type="submit"  value="Save">
        </div>

      </form>
    </div>
      </div>
  
    </div>
  </div>
  <script>
function add(){
      var new_chq_no = parseInt($('#total_chq').val())+1;
      var new_input="<input type='text' id='new_"+new_chq_no+"' class='form-control option' name='options[]' placeholder='Enter option'>";
      $('#new_chq').append(new_input);
      $('#total_chq').val(new_chq_no)
    }
    function remove(){
      var last_chq_no = $('#total_chq').val();
      if(last_chq_no>1){
        $('#new_'+last_chq_no).remove();
        $('#total_chq').val(last_chq_no-1);
      }
    }
  </script>
<style>
button.btn.btn-info {
    margin-left: 430px;
}

button.add{
    margin-left: 430px;
}

button.btn.btn-info.btn-lg.option {
    margin-left: 735px;
    margin-bottom: 10px;
}
</style>


@endsection