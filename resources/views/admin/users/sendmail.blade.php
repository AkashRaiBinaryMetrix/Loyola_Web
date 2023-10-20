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


                        <div class="body">

                            <form id="form_validation" method="POST" 
                            action="{{ url('admin/user/send-mail')}}" 
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

                                <div class="form-group form-float">

                                    <label class="form-label">Select User </label>

                                    <div class="form-line">

                                        <select  class="form-control" name="user_id[]" multiple required="">

                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                           

                                        </select>

                                </div>

                                </div>

                         

                                <div class="form-group form-float">

                                </div>

                                <input class="btn btn-primary waves-effect" type="submit"  value="Send Email">

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
 