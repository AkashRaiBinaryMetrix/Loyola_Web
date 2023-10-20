@extends('admin.layout.app')

@section('content')
<style>
    input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
</style>

<section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <h2>

                    <strong>Edit Patient Listing</strong> 

                </h2>

                @if ($message = Session::get('error'))

                <!-- <div class="alert alert-danger alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button> 

                        <strong>{{ $message }}</strong>

                </div> -->

                <script type="text/javascript">alert('Community already exists');</script>

                @endif

                @if ($message = Session::get('success'))

                <!-- <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button> 

                        <strong>{{ $message }}</strong>

                </div> -->

                <script type="text/javascript">alert('Community edited successfully');</script>

                @endif

                @if ($errors->any())

                <div class="alert alert-danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

                @endif

            </div>

            <!-- Basic Validation -->

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">

                        <div class="body">
                        @foreach($patient as $patient)

                        <form id="form_validation" method="POST" action="{{ url('admin/edit-patient-process/') }}" enctype="multipart/form-data">
                            @csrf


                            <input type="hidden"name="record_id" value="{{$patient->id}}">

                            <label for="name"> Name</label>
                            <input type="text" id="name" name="name" value="{{$patient->name}}" placeholder="Your name..">

                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" value="{{$patient->email}}" placeholder="Your Email..">

                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{$patient->phone}}" placeholder="Your Phone..">

                            <label for="gender">Gender</label>
                            <input type="text" id="gender" name="gender" value="{{$patient->gender}}" placeholder="Your Gender..">
                            
                            <label for="blood_group">Blood Group</label>
                            <input type="text" id="blood_group" name="blood_group" value="{{$patient->blood_group}}" placeholder="Your Blood Group..">

                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" value="{{$patient->country}}" placeholder="Your Country Name..">
  
                            <input type="submit" value="Submit">

                        </form>
                        @endforeach

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <div class="modal fade" id="covermodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">

<div class="modal-dialog modal-lg" role="document">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title" id="modal-Label"></h5>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">

<span aria-hidden="true">×</span>

</button>

</div>

<div class="modal-body">

<div class="img-container">

<div class="row">

<div class="col-md-8">

<img id="coverimage" src="">

</div>

<div class="col-md-4">

<div class="coverpreview"></div>

</div>

</div>

</div>

</div>

<div class="modal-footer">

<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

<button type="button" class="btn btn-primary" id="covercrop">Crop</button>

</div>

</div>

</div>

</div>

@endsection