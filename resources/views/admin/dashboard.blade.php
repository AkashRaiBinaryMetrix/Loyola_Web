@extends('admin.layout.app')

@section('content')

 <section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <h2>DASHBOARD</h2>

            </div>



            <!-- Widgets -->

           
            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="{{url('admin/user/lists')}}" style="cursor: pointer;text-decoration: none;">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Users</div>
                            <div class="number count-to" class="fs-30 mb-2">{{$totalUsers}}</div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="{{url('admin/category')}}" style="cursor: pointer;text-decoration: none;">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Category</div>
                            <div class="number count-to" class="fs-30 mb-2">{{$totalCategory}}</div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="{{url('admin/survey')}}" style="cursor: pointer;text-decoration: none;">
                    <div class="info-box bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Survey</div>
                            <div class="number count-to" class="fs-30 mb-2">{{$totalSurvey}}</div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="{{url('admin/user/feedbacks')}}" style="cursor: pointer;text-decoration: none;">
                    <div class="info-box bg-yellow hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Feedback</div>
                            <div class="number count-to" class="fs-30 mb-2">{{$totalFeedbacks}}</div>
                        </div>
                    </div>
                    </a>
                </div>


                


            </div>

       

            <!-- #END# Widgets -->

            

        </div>

    </section>

@endsection

