 @if(!empty($comments))
 @foreach($comments as $key=>$comm)
 @php
  $username=DB::table('users')->where('id',$comm->user_id)->first();
  $time=\Carbon\Carbon::parse($comm->created_at)->diffForhumans();
  $userimg=DB::table('user_detail')->where('user_id',$comm->user_id)->first();
  if(!empty(\Session::get('user')))
  {
  $commlike=DB::table('comments_like')->where('comment_id',$comm->id)->where('user_id',\Session::get('user')->id)->first();
  }
  $totalcommlike=DB::table('comments_like')->where('comment_id',$comm->id)->where('like',1)->count();
         
@endphp
<style type="text/css">
    <style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>
</style>
     <div class="usercomment-col">
                       <div class="usercomment-pic"><img src="@if(!empty($userimg->image)) {{asset('public/user/images/'.$userimg->image)}} @else {{asset('public/images/user.png')}} @endif" alt="" ></div>
                       <div class="usercomment-content">
                          <div class="usercomment-name" ><b>@if(!empty($username->name)){{$username->name}} @endif</b> <span >{{$time}}</span></div> 
                          <div class="usercomment-text" >
                            
                            @if(!empty($comm->comment))
                            {!! $comm->comment!!}
                            @elseif(!empty($comm->media))
                                @php
                                 $extension=explode('.',$comm->media);
                                 
                                @endphp
                            @if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
                            <img src="{{asset('public/comment/'.$comm->media)}}" id="imgcom" style="max-height:150px;margin-bottom: 10px;">
                            @elseif($extension[1]=='mp4')
                                <video width="220" height="140" controls style="margin-bottom: 10px;">
                              <source src="{{asset('public/comment/'.$comm->media)}}" type="video/mp4">
                              <source src="{{asset('public/comment/'.$comm->media)}}" type="video/ogg">
                            Your browser does not support the video tag.
                            </video> 
                            @elseif($extension[1]=='ogg')
                                <audio controls style="margin-bottom: 10px;">
                              <source src="{{asset('public/comment/'.$comm->media)}}" type="audio/ogg">
                              <source src="{{asset('public/comment/'.$comm->media)}}" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio> 
                            @endif
                            
                            @endif
                            <p>{{$comm->title}}</p>
                          </div>
                         <div class="usercomment-btns">
                            @if(empty($commlike))
                           <a href="javascript:void" onclick="likecomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','1')" id="like-comm-id{{$comm->id}}"><img src="{{asset('public/images/like-ico.png')}}" alt="" >@if($totalcommlike!=0) {{$totalcommlike}} @endif
                            </a>
                            @elseif(!empty($commlike) && $commlike->like==0)
                            <a href="javascript:void" onclick="likecomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','1')" id="like-comm-id{{$comm->id}}"><img src="{{asset('public/images/like-ico.png') }}" alt="" style="width:20px;height:20px;">@if($totalcommlike!=0) {{$totalcommlike}} @endif</a>
                            @elseif(!empty($commlike) && $commlike->like==1)
                            <a href="javascript:void" onclick="likecomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','0')" id="unlike-comm-id{{$comm->id}}"><img src="{{asset('public/images/like.png') }}" alt="" style="width:20px;height:20px;">@if($totalcommlike!=0) {{$totalcommlike}} @endif</a>
                            @endif
                             <a href="javascript:void" onclick="likecomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','1')" style="display: none;" id="like-comm-id{{$comm->id}}"><img src="{{asset('public/images/like-ico.png')}}" alt="" style="width:20px;height:20px;"><span id="total-count-unlike{{$comm->id}}"></span>
                            </a>
                            <a href="javascript:void" onclick="likecomment('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','0')" style="display: none;" id="unlike-comm-id{{$comm->id}}"><img src="{{asset('public/images/like.png') }}" alt="" style="width:20px;height:20px;"><span id="total-count-like{{$comm->id}}"></span></a>
                           <a href="javascript:void" onclick="replysec('{{$comm->id}}','{{$key}}')">Reply</a>
                           <a href="javascript:void" onclick="report('{{$comm->id}}','{{$comm->community_id}}','{{$post->id}}')">Report</a>  
                         </div>  
                         <form action="{{route('reply.add')}}" method="post">
                            @csrf
                            <input type="hidden" name="community_id" value="{{$comm->community_id}}">
                            <input type="hidden" name="post_id" value="{{$comm->post_id}}">
                            <input type="hidden" name="comment_id" value="{{$comm->id}}">
                             <div class="editor-sec" id="reply-sec{{$comm->id}}" style="margin-top: 15px;display: none;width:600px;">
                               <textarea class="form-control full-featured-non-premium" name="comment" id="comment-reply-sec{{$comm->id}}"></textarea>
                              
                                 <span id="words-max" style="margin-top: 5px;color: red;">Maximum words 400</span>
                                    <button class="common-btn" id="spin-reply-btn{{$comm->id}}" style="display: none;float: right;margin-top: 10px;">
                                      <span class="spinner-border spinner-border-sm"></span>
                                    </button>
                                    <button type="button" class="common-btn" id="reply-btn{{$comm->id}}" style="float: right;margin-top: 10px;" onclick="postreply('{{$comm->id}}','{{$post->id}}','{{$comm->community_id}}','{{$key+1}}','{{$key}}')">Post</button>
                                    <!-- <button type="submit" class="common-btn" style="float: right;margin-top: 10px;">Post</button> -->
                             </div> 
                         </form>
                       </div>
                      
                  </div>
                  <div class="display-comment" style="margin-left: 50px;" id="user-reply-section{{$comm->id}}">
                  </div> 
                  <!-- <div  class="display-comment" style="margin-left: 50px;"> 
                  </div>  -->

                  
                  <div class="display-comment" style="margin-left: 50px;">
                    @php
                      $commreply=DB::table('user_comments')
                                ->leftjoin('users','users.id','user_comments.user_id')
                                ->select('user_comments.*','users.name as username')
                                ->where('post_id',$comm->post_id)
                                ->where('community_id',$comm->community_id)
                                ->where('main_comment_id',$comm->id)
                                ->groupBy('user_comments.id')
                                ->get();
                    @endphp
                    @if(!empty($commreply))
                    @foreach($commreply as $reply)
                    @php
                      $username=DB::table('users')->where('id',$reply->user_id)->first();
                      $time=\Carbon\Carbon::parse($reply->created_at)->diffForhumans();
                      $userimg=DB::table('user_detail')->where('user_id',$reply->user_id)->first();
                      if(!empty(\Session::get('user')))
                      {
                      $replylike=DB::table('comments_like')->where('comment_id',$reply->id)->where('user_id',\Session::get('user')->id)->first();
                      }
                      $totalcommlike=DB::table('comments_like')->where('comment_id',$reply->id)->where('like',1)->count();
                             
                    @endphp
                      <div class="usercomment-col">
                       <div class="usercomment-pic"><img src="@if(!empty($userimg->image)) {{asset('public/user/images/'.$userimg->image)}} @else {{asset('public/images/user.png')}} @endif" alt="" ></div>
                       <div class="usercomment-content">
                          <div class="usercomment-name" ><b>@if(!empty($username->name)){{$username->name}} @endif</b> <span >{{$time}}</span></div> 
                          <div class="usercomment-text" >
                            
                            @if(!empty($reply->comment))
                            {!! $reply->comment!!}
                            @elseif(!empty($reply->media))
                                @php
                                 $extension=explode('.',$reply->media);
                                 
                                @endphp
                            @if($extension[1]=='jpg' || $extension[1]=='jpeg' || $extension[1]=='png')
                            <img src="{{asset('public/comment/'.$reply->media)}}" id="imgcom" style="max-height:150px;margin-bottom: 10px;">
                            @elseif($extension[1]=='mp4')
                                <video width="220" height="140" controls style="margin-bottom: 10px;">
                              <source src="{{asset('public/comment/'.$reply->media)}}" type="video/mp4">
                              <source src="{{asset('public/comment/'.$reply->media)}}" type="video/ogg">
                            Your browser does not support the video tag.
                            </video> 
                            @elseif($extension[1]=='ogg')
                                <audio controls style="margin-bottom: 10px;">
                              <source src="{{asset('public/comment/'.$reply->media)}}" type="audio/ogg">
                              <source src="{{asset('public/comment/'.$reply->media)}}" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio> 
                            @endif
                            
                            @endif
                            <p>{{$reply->title}}</p>
                          </div>
                         <div class="usercomment-btns">
                            @if(empty($replylike))
                           <a href="javascript:void" onclick="likecomment('{{$reply->id}}','{{$reply->post_id}}','{{$reply->community_id}}','1')" id="like-comm-id{{$reply->id}}"><img src="{{asset('public/images/like-ico.png')}}" alt="" >@if($replylike!=0) {{$replylike}} @endif
                            </a>
                            @elseif(!empty($replylike) && $replylike->like==0)
                            <a href="javascript:void" onclick="likecomment('{{$reply->id}}','{{$reply->post_id}}','{{$reply->community_id}}','1')" id="like-comm-id{{$reply->id}}"><img src="{{asset('public/images/like-ico.png') }}" alt="" style="width:20px;height:20px;">@if($totalcommlike!=0) {{$totalcommlike}} @endif</a>
                            @elseif(!empty($replylike) && $replylike->like==1)
                            <a href="javascript:void" onclick="likecomment('{{$reply->id}}','{{$reply->post_id}}','{{$reply->community_id}}','0')" id="unlike-comm-id{{$reply->id}}"><img src="{{asset('public/images/like.png') }}" alt="" style="width:20px;height:20px;">@if($totalcommlike!=0) {{$totalcommlike}} @endif</a>
                            @endif
                             <a href="javascript:void" onclick="likecomment('{{$reply->id}}','{{$reply->post_id}}','{{$reply->community_id}}','1')" style="display: none;" id="like-comm-id{{$reply->id}}"><img src="{{asset('public/images/like-ico.png')}}" alt="" style="width:20px;height:20px;"><span id="total-count-unlike{{$reply->id}}"></span>
                            </a>
                            <a href="javascript:void" onclick="likecomment('{{$reply->id}}','{{$reply->post_id}}','{{$reply->community_id}}','0')" style="display: none;" id="unlike-comm-id{{$reply->id}}"><img src="{{asset('public/images/like.png') }}" alt="" style="width:20px;height:20px;"><span id="total-count-like{{$reply->id}}"></span></a>
                           <a href="javascript:void" onclick="replysec('{{$reply->id}}','{{$key}}')">Reply</a>
                           <a href="javascript:void" onclick="report('{{$reply->id}}','{{$reply->community_id}}','{{$post->id}}')">Report</a>  
                         </div>  
                         <form action="{{route('reply.add')}}" method="post">
                            @csrf
                            <input type="hidden" name="community_id" value="{{$reply->community_id}}">
                            <input type="hidden" name="post_id" value="{{$reply->post_id}}">
                            <input type="hidden" name="comment_id" value="{{$reply->id}}">
                             <div class="editor-sec" id="reply-sec{{$reply->id}}" style="margin-top: 15px;display: none;width:600px;">
                               <textarea class="form-control full-featured-non-premium" name="comment" id="comment-reply-sec{{$reply->id}}"></textarea>
                                    <span id="words-max" style="margin-top: 5px;color: red;">Maximum words 400</span>
                                    <button class="common-btn" id="spin-reply-btn{{$reply->id}}" style="display: none;float: right;margin-top: 10px;">
                                      <span class="spinner-border spinner-border-sm"></span>
                                    </button>
                                    <button type="button" class="common-btn" id="reply-btn{{$reply->id}}" style="float: right;margin-top: 10px;" onclick="postreply('{{$reply->id}}','{{$post->id}}','{{$reply->community_id}}','{{$key+1}}','{{$key}}')">Post</button>
                                    <!-- <button type="submit" class="common-btn" style="float: right;margin-top: 10px;">Post</button> -->
                             </div> 
                         </form>
                       </div>
                      
                  </div>
                  <div class="display-comment" id="user-reply-section{{$reply->id}}">
                  </div>
                    @endforeach
                    @endif


                      
                  </div>

                          
@endforeach
@else
<div class="usercomment-col">
  No comments found
</div>
@endif



 