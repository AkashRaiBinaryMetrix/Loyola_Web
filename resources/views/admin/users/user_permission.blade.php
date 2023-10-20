@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Manage Permission
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
               
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="mypost-col" id="">
                           <!-- <div class="mypost-pic"><a href="#"><img src="{{asset('public/images/gaming-post-1.jpg') }}" alt=""></a></div> -->
                          <div class="mypost-content">
                              <div class="mypost-title">
                               <h2 style="text-align: center;">Role- {{$userrole->name}}</h2>
                              </div>
                                <div class="mypost-title">
                                  <div class="body table-responsive">
                                     <form method="post" action="{{route('admin.manage.user.perssion',$userrole->name)}}">
                                                @csrf
                                    <input type="hidden" name="role_id" value="{{$userrole->id}}">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>View</th>
                                                <th>Add</th>
                                                <th>Manage</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Home</td>
                                                <input type="hidden" name="Home[name]" value="Home">
                                                <td>
                                                    <input type="checkbox" name="Home[view]" id="view1" value="1"@if(!empty($home) && $home->view==1) checked @endif>
                                                    <label for="view1"></label>
                                                    
                                                </td>
                                                 <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Community</td>
                                                <input type="hidden" name="Community[name]" value="Community">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="Community[view]]" value="1"@if(!empty($Community) && $Community->view==1) checked @endif id="view2">
                                                    <label class="custom-control-label" for="view2"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Community[add]" class="form-control" value="1"@if(!empty($Community) && $Community->add==1) checked @endif id="add1">
                                                    <label class="custom-control-label" for="add1"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Community[manage]" class="form-control" value="1"@if(!empty($Community) && $Community->manage==1) checked @endif id="manage1">
                                                    <label class="custom-control-label" for="manage1"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Community[edit]" class="form-control" value="1"@if(!empty($Community) && $Community->edit==1) checked @endif id="edit1">
                                                    <label class="custom-control-label" for="edit1"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Community[delete]" class="form-control" value="1"@if(!empty($Community) && $Community->delete==1) checked @endif id="delete1">
                                                    <label class="custom-control-label" for="delete1"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Post</td>
                                                <input type="hidden" name="Post[name]" value="Post">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="Post[view]]" value="1"@if(!empty($Post) && $Post->view==1) checked @endif id="view3">
                                                    <label class="custom-control-label" for="view3"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Post[add]" class="form-control" value="1"@if(!empty($Post) && $Post->add==1) checked @endif id="add2">
                                                    <label class="custom-control-label" for="add2"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Post[manage]" class="form-control" value="1"@if(!empty($Post) && $Post->manage==1) checked @endif id="manage2">
                                                    <label class="custom-control-label" for="manage2"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Post[edit]" class="form-control" value="1"@if(!empty($Post) && $Post->edit==1) checked @endif id="edit2">
                                                    <label class="custom-control-label" for="edit2"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Post[delete]" class="form-control" value="1"@if(!empty($Post) && $Post->delete==1) checked @endif id="delete2">
                                                    <label class="custom-control-label" for="delete2"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>Category</td>
                                                <input type="hidden" name="Category[name]" value="Category">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="Category[view]]" value="1"@if(!empty($Category) && $Category->view==1) checked @endif  id="view4">
                                                    <label class="custom-control-label" for="view4"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Category[add]" class="form-control" value="1"@if(!empty($Category) && $Category->add==1) checked @endif  id="add3">
                                                    <label class="custom-control-label" for="add3"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Category[manage]" class="form-control" value="1"@if(!empty($Category) && $Category->manage==1) checked @endif  id="manage3">
                                                    <label class="custom-control-label" for="manage3"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Category[edit]" class="form-control" value="1"@if(!empty($Category) && $Category->edit==1) checked @endif  id="edit3">
                                                    <label class="custom-control-label" for="edit3"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Category[delete]" class="form-control" value="1"@if(!empty($Category) && $Category->delete==1) checked @endif  id="delete3">
                                                    <label class="custom-control-label" for="delete3"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td>Subcategory</td>
                                                <input type="hidden" name="subcategory[name]" value="subcategory">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="subcategory[view]]" value="1"@if(!empty($subcategory) && $subcategory->view==1) checked @endif id="view5">
                                                    <label class="custom-control-label" for="view5"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="subcategory[add]" class="form-control" value="1"@if(!empty($subcategory) && $subcategory->add==1) checked @endif id="add4">
                                                    <label class="custom-control-label" for="add4"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="subcategory[manage]" class="form-control" value="1"@if(!empty($subcategory) && $subcategory->manage==1) checked @endif id="manage4">
                                                    <label class="custom-control-label" for="manage4"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="subcategory[edit]" class="form-control" value="1"@if(!empty($subcategory) && $subcategory->edit==1) checked @endif id="edit4">
                                                    <label class="custom-control-label" for="edit4"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="subcategory[delete]" class="form-control" value="1"@if(!empty($subcategory) && $subcategory->delete==1) checked @endif id="delete4">
                                                    <label class="custom-control-label" for="delete4"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">6</th>
                                                <td>Videos</td>
                                                <input type="hidden" name="Videos[name]" value="Videos">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="Videos[view]]" value="1"@if(!empty($Videos) && $Videos->view==1) checked @endif id="view6">
                                                    <label class="custom-control-label" for="view6"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Videos[add]" class="form-control" value="1"@if(!empty($Videos) && $Videos->add==1) checked @endif id="add5">
                                                    <label class="custom-control-label" for="add5"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Videos[manage]" class="form-control" value="1"@if(!empty($Videos) && $Videos->manage==1) checked @endif id="manage5">
                                                    <label class="custom-control-label" for="manage5"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Videos[edit]" class="form-control" value="1"@if(!empty($Videos) && $Videos->edit==1) checked @endif id="edit5">
                                                    <label class="custom-control-label" for="edit5"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Videos[delete]" class="form-control" value="1"@if(!empty($Videos) && $Videos->delete==1) checked @endif id="delete5">
                                                    <label class="custom-control-label" for="delete5"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">7</th>
                                                <td>Poll</td>
                                                <input type="hidden" name="Poll[name]" value="Poll">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="Poll[view]]" value="1"@if(!empty($Poll) && $Poll->view==1) checked @endif id="view7">
                                                    <label class="custom-control-label" for="view7"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Poll[add]" class="form-control" value="1"@if(!empty($Poll) && $Poll->add==1) checked @endif id="add6">
                                                    <label class="custom-control-label" for="add6"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Poll[manage]" class="form-control" value="1"@if(!empty($Poll) && $Poll->manage==1) checked @endif id="manage6">
                                                    <label class="custom-control-label" for="manage6"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Poll[edit]" class="form-control" value="1"@if(!empty($Poll) && $Poll->edit==1) checked @endif id="edit6">
                                                    <label class="custom-control-label" for="edit6"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Poll[delete]" class="form-control" value="1"@if(!empty($Poll) && $Poll->delete==1) checked @endif id="delete6">
                                                    <label class="custom-control-label" for="delete6"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">8</th>
                                                <td>Content Management</td>
                                                <input type="hidden" name="Content[name]" value="Content">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="Content[view]]" value="1"@if(!empty($Content) && $Content->view==1) checked @endif id="view8">
                                                    <label class="custom-control-label" for="view8"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Content[add]" class="form-control" value="1"@if(!empty($Content) && $Content->add==1) checked @endif id="add7">
                                                    <label class="custom-control-label" for="add7"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Content[edit]" class="form-control" value="1"@if(!empty($Content) && $Content->edit==1) checked @endif id="edit7">
                                                    <label class="custom-control-label" for="edit7"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">9</th>
                                                <td>Faq</td>
                                                <input type="hidden" name="Faq[name]" value="Faq">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="Faq[view]]" value="1"@if(!empty($Faq) && $Faq->view==1) checked  @endif id="view9">
                                                    <label class="custom-control-label" for="view9"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Faq[add]" class="form-control" value="1"@if(!empty($Faq) && $Faq->add==1) checked @endif id="add8">
                                                    <label class="custom-control-label" for="add8"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Faq[manage]" class="form-control" value="1"@if(!empty($Faq) && $Faq->manage==1) checked @endif id="manage8">
                                                    <label class="custom-control-label" for="manage8"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Faq[edit]" class="form-control" value="1"@if(!empty($Faq) && $Faq->edit==1) checked @endif id="edit8">
                                                    <label class="custom-control-label" for="edit8"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Faq[delete]" class="form-control" value="1"@if(!empty($Faq) && $Faq->delete==1) checked @endif id="delete8">
                                                    <label class="custom-control-label" for="delete8"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">10</th>
                                                <td>Email Template</td>
                                                <input type="hidden" name="email[name]" value="email">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="email[view]]" value="1"@if(!empty($email) && $email->view==1) checked @endif id="view10">
                                                    <label class="custom-control-label" for="view10"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="email[add]" class="form-control" value="1"@if(!empty($email) && $email->add==1) checked @endif id="add9">
                                                    <label class="custom-control-label" for="add9"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="email[edit]" class="form-control" value="1"@if(!empty($email) && $email->edit==1) checked @endif id="edit9">
                                                    <label class="custom-control-label" for="edit9"></label>
                                                </td>
                                                <td>
                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">11</th>
                                                <td>Manage Community Request</td>
                                                <input type="hidden" name="manage[name]" value="manage community">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="manage[view]]" value="1"@if(!empty($managecommunity) && $managecommunity->view==1) checked @endif  id="view11">
                                                    <label class="custom-control-label" for="view11"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="manage[manage]" class="form-control" value="1"@if(!empty($managecommunity) && $managecommunity->manage==1) checked @endif  id="manage10">
                                                    <label class="custom-control-label" for="manage10"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                   
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">12</th>
                                                <td>Posts Report</td>
                                                <input type="hidden" name="report[name]" value="post report">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="report[view]]" value="1"@if(!empty($postreport) && $postreport->view==1) checked @endif id="view12">
                                                    <label class="custom-control-label" for="view12"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="report[manage]" class="form-control" value="1"@if(!empty($postreport) && $postreport->manage==1) checked @endif id="manage12">
                                                    <label class="custom-control-label" for="manage12"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="report[delete]" class="form-control" value="1"@if(!empty($postreport) && $postreport->delete==1) checked @endif id="delete12">
                                                    <label class="custom-control-label" for="delete12"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">13</th>
                                                <td>Comments Report</td>
                                                <input type="hidden" name="comment[name]" value="comment report">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input" name="comment[view]]" value="1"@if(!empty($commentreport) && $commentreport->view==1) checked @endif id="view13">
                                                    <label class="custom-control-label" for="view13"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="comment[manage]" class="form-control" value="1"@if(!empty($commentreport) && $commentreport->manage==1) checked @endif id="manage13">
                                                    <label class="custom-control-label" for="manage13"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="comment[delete]" class="form-control" value="1"@if(!empty($commentreport) && $commentreport->delete==1) checked @endif id="delete13">
                                                    <label class="custom-control-label" for="delete13"></label>
                                                </td>
                                            </tr>
                                             <tr>
                                                <th scope="row">13</th>
                                                <td>User Messages</td>
                                                <input type="hidden" name="message[name]" value="user messages">
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <input type="checkbox" name="message[manage]" class="form-control" value="1"@if(!empty($usermsg) && $usermsg->manage==1) checked @endif id="manage14">
                                                    <label class="custom-control-label" for="manage14"></label>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit">Submit</button>
                                    </form>
                        </div>
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