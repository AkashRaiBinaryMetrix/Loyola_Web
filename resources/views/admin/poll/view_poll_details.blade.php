 @extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Poll Vote Details</h2>
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
                        <div class="body table-responsive">
                           @foreach($options as $option)
                           @php
                           $totalpoll=DB::table('admin_poll_votes')->where('votes',$option)->count();
                           $totaluser=DB::table('users')->where('role_id',2)->count();
                           $totalvotecount=$totalpoll*100/$totaluser;
                           if(!empty($totalpoll))
                           {
	                           if($totaluser>100)
	                           {
	                           	$votecount=$totalvotecount;
	                           }else
	                           {
	                           	$votecount=$totalpoll;
	                           }
                           }else
                           {
                           	$votecount=0;
                           }
                           @endphp 
                           <p>{{$option}}-{{round($votecount)}}%</p>
                           @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
</section>
@endsection