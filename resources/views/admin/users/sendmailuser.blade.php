@extends('admin.layout.app')

@section('content')

<section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <h2> Send Mail</h2><br>
                
            <!-- Basic Validation -->

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


                        <div class="body">

                            <form id="form_validation" method="POST" 
                            action="{{ url('admin/user/send-mail-user')}}" 
                                enctype="multipart/form-data">

                                @csrf
                                @method('POST')
                                
                                <div class="form-group form-float">

                                    <label class="form-label">Select Survey </label>

                                    <div class="form-line">

                                        <select class="form-control" name="survey_id" required="">
                                        <option value="">  Select Survey </option>
                                        @foreach($surveys as $survey)
                                        <option value="{{$survey->id}}">{{$survey->heading}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                </div>

                              

                                <div class="after-add-more">
  
    <div class="col-md-4">                                
        <div class="form-group">
            <label class="control-label">Email ID</label>
            <input maxlength="200" type="email" class="form-control" placeholder="Enter Email ID" name="email[]" />
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group change">
            <label for="">&nbsp;</label><br/>
            <a class="btn btn-success add-more">+ Add Email ID</a>
        </div>
    </div>
</div>


                         

                                <div class="form-group form-float">

                                </div>
                                <br>
                                  <br>
                                    <br><br>
                                    <br><br>

                                <input class="btn btn-primary waves-effect" type="submit"  value="Send Email">

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
    $("body").on("click",".add-more",function(){ 
        var html = $(".after-add-more").first().clone();
          $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
        $(".after-add-more").last().after(html);
      
     
       
    });

    $("body").on("click",".remove",function(){ 
        $(this).parents(".after-add-more").remove();
    });
});
</script>
<style>
.add-more {
    border: 38px !important;
}
</style>
 