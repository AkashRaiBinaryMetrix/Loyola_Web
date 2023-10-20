@extends('admin.layout.app')
@section('content')
<style type="text/css">
      cursor: pointer;
    }
   .avatar-wrapper:hover .profile-pic {
     opacity: 0.5;
    }
   .avatar-wrapper .profile-pic {
     height: 100%;
     width: 100%;
      transition: all 0.3s ease;
    }
   .avatar-wrapper .profile-pic:after {
      font-family:'Line Awesome Free';
      font-weight: 900;
  }
 
.avatar-wrapper .upload-button {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    cursor: pointer;
}

</style>
<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                
                <div class="col-xs-12 col-sm-3">
                    
                    <div class="card profile-card">
                        <form method="post" action="{{route('admin.edit.profile.image')}}" enctype="multipart/form-data" id="profile-form">
                       @csrf
                        <div class="form-group avtar-profile">
                            <label style="margin-left: 81px;">Profile Image</label>
                            <div class="avatar-wrapper">
                            <img class="profile-pic" src="@if(!empty($admin->profile_pic)) {{asset('public/'.$admin->profile_pic)}} @else {{asset('public/images/user.png')}} @endif" alt="" />
                            <div class="upload-button"></div>
                            <input class="file-upload"  type="file" accept="image/*"/ name="image" style="margin-left: 30px;display: none;" id="filimg">
                        </div> 
                        
                        <span style="margin-left: 81px;">Upload image</span>
                        <p id="profile-err" style="text-align: center;"></p>  
                          </div>
                        <div class="profile-footer">
                            <button class="btn btn-primary btn-lg waves-effect btn-block" type="button" id="profile-btn">Update Profile Image</button>
                        </div>
                        </form>
                    </div>
                    
                </div>
            
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
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
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                                    <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                                        <form class="form-horizontal" method="post" action="{{route('admin.profile')}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="NameSurname" class="col-sm-2 control-label">Name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name Surname" value="{{$admin->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="Email" name="email" placeholder="Email" value="{{$admin->email}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="InputExperience" class="col-sm-2 control-label">Experience</label>

                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <textarea class="form-control" id="InputExperience" name="experience" rows="3" placeholder="Experience">{{$admin->experiance}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="InputSkills" class="col-sm-2 control-label">Skills</label>

                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="InputSkills" name="skills" placeholder="Skills" value="{{$admin->skills}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                        <form class="form-horizontal" method="post" action="{{route('admin.profile_password')}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                                <input type="hidden" name="email" value="{{$admin->email}}">
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="OldPassword" name="oldpassword" placeholder="Old Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPassword" name="newpassword" placeholder="New Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPasswordConfirm" name="newpasswordConfirm" placeholder="New Password (Confirm)" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection