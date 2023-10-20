 @extends('admin.layout.app')

 @section('content')

 <section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <h2>Manage Category</h2>

                

                @if ($message = Session::get('error'))

                <div class="alert alert-danger alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button> 

                        <strong>{{ $message }}</strong>

                </div>

                @endif


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

                        <a href="category/create"><button type="button" class="btn btn-info btn-sm btn-rounded option add">
                          <i class="fa fa-plus"></i> Add</button></a>


                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                <thead>

                                    <tr>

                                        <th>#</th>

                                        <th>Name</th>
                                        <th width="50%">Image</th>
                                        <th>Status</th>
                                        

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>
                                    @foreach($categoryLists as $key=>$category)

                                    <tr>

                                        <th scope="row">{{$key+1}}</th>

                                        <td>{{$category->name}}</td>
                                        <td><img src="{{ url('public/category') }}/{{ $category->image }}" width="10%"></td>
                                        <td>{{ Str::ucfirst($category->status)}}</td>

                                   

                                        <td>
                                         <a href="category/edit/{{$category->id}}" class="btn btn-success">
                                            <i class="fa fa-edit" style="padding-right: 3px;"></i>
                                          Edit</a>

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