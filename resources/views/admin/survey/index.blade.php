 @extends('admin.layout.app')

 @section('content')

 <section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <h2>Manage Survey</h2>
            </div>

            <!-- Basic Table -->

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">

                       

                        <div class="body table-responsive">

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

                            <table class="table table-responsive table-bordered table-striped table-hover js-basic-example dataTable">

                            <a href="survey/create"><button type="button" class="btn btn-info btn-sm btn-rounded option add">
                          <i class="fa fa-plus"></i> Add</button></a>

                                <thead>

                                    <tr>

                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Heading</th>
                                        <th width="10%">Image</th>
                                        <th>Status</th>
                                        <th>Published</th>
                                        <th>Action</th>
                                        <th>Question</th>

                                    </tr>

                                </thead>

                                <tbody>
                                    @foreach($surveyLists as $key=>$survey)

                                    <tr>

                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{ isset($survey->category->name) ? $survey->category->name : '-' }}</td>
                                        <td>{{$survey->heading}}</td>
                                        <td><img src="{{ $survey->image }}" width="80%" height="20%"></td>
                                        <td>{{ Str::ucfirst($survey->status)}}</td>
                                        <td>{{$survey->is_published}}</td>
                                        <td>
                                         <a href="survey/edit/{{$survey->id}}" class="btn btn-success">
                                            <i class="fa fa-edit" style="padding-right: 3px;"></i>
                                          Edit</a>
                                          <br><br>
                                          @if($survey->is_published=='No')
                                          <a href="survey/published/{{$survey->id}}" class="btn btn-danger">
                                            <i class="fa fa-ban" style="padding-right: 3px;"></i>
                                            Publish</a>
                                           @endif
                                   
                                        </td>
                                        <td>
                                        <a href="survey/questions/{{$survey->id}}" class="btn btn-info">
                                            <i class="fa fa-plus" style="padding-right: 3px;"></i>
                                          Questions</a>
                                       </td>

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
<style>

button.add {
    margin-left: 800px;
    margin-bottom: 10px;
}
</style>