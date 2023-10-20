@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Edit Poll
                    
                </h2>
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
                            <form id="form_validation" method="POST" action="{{route('admin.update.poll')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$poll->id}}">
                                <div class="form-group form-float">
                                    <label class="form-label">Communities</label>
                                    <div class="form-line">
                                       <select id="community-type" class="form-control" name="community_id" required="">
                                        <option value="">Select Community</option>
                                        @foreach($community as $comm)
                                        <option value="{{$comm->id}}"@if($poll->community_id==$comm->id) selected @endif>{{$comm->title}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Poll Question</label>
                                    <div class="form-line">
                                        <input class="form-control" name="question" value="{{$poll->question}}" placeholder="Question Text" type="text" id="questiontxt" required=""> 
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Poll Options</label>
                                    @foreach($options as $optn)
                                    <div class="form-group form-float">
                                      <div class="form-line">
                                        <input class="form-control options" name="option[]" value="{{$optn}}" placeholder="Option Text" type="text" required=""> 
                                       </div>
                                     </div>
                                   @endforeach
                               </div>
                               
                                      
                                    <div id="moreoption"></div>
                                    <span id="optionsreq"></span>
                                    <div class="check-multiplesec">
                                    <div class="custom-control custom-switch">
                                     <input type="checkbox" name="multiple" class="custom-control-input" id="switch1" value="1"@if($poll->multiple==1) checked @endif>
                                     <label class="custom-control-label" for="switch1">Multiple answer</label>
                                  </div>
                                  </div>
                                </div>
                                <div class="poll-footer" style="margin-left: 16px;">
                                  <div  class="more-specbtn"><a href="javascript:void" id="addspec">+ Add Option</a></div>
                                   
                               </div>
                                <div class="form-group form-float" style="margin-left: 16px;">
                                    <label class="form-label">Add Media</label>
                                    <div class="form-line">
                                        <img class="media-pic" src="{{asset('public/images/image-ico.png')}}" alt="">
                                          <img class="media-pic" src="{{asset('public/images/create-video-ico.png')}}" alt="">
                                          <!-- <img class="media-pic" src="{{asset('public/images/mic-ico.png')}}" alt=""> -->
                                          <input class="file-upload" name="media" type="file" accept="audio/*,video/*,image/*" style="display: none;" id="file" onchange="previewimg(this)"/>
                                    </div>
                                </div>
                                <div class="create-addpost newimg" style="margin-left: 16px;">
                                  @if(!empty($extension[1]))
                                @if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
                                  <img src="{{asset('public/poll/'.$poll->media)}}" id="imgcom" style="width:200px;height:100px;">
                                  @elseif($extension[1]=='mp4')
                                    <video width="220" height="140" controls>
                                  <source src="{{asset('public/poll/'.$poll->media)}}" type="video/mp4">
                                  <source src="{{asset('public/poll/'.$poll->media)}}" type="video/ogg">
                                Your browser does not support the video tag.
                                </video>
                                @endif 
                                @endif 
                              </div>
                                <div >
                               <div class="create-addpost" style="margin-left: 16px;">
                               
                                 <img src="" id="blah" style="width:220px;height:120px;text-align: center;display: none;">
                                            <video width="220" height="160" controls style="display: none;" id="videoid">
                                          <source src="" type="video/mp4">
                                          <source src="" type="video/ogg">
                                        Your browser does not support the video tag.
                                        </video> 
                                        <audio controls style="display: none;" id="audid">
                                          <source src="" type="audio/ogg">
                                          <source src="" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                        </audio>
                               </div>
                             </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit" style="margin-left: 16px;">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection