<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript">
	function previewimgcomm(img)
	{
		
		// var filename = $("#profileimage").val();
		// var extension = filename.replace(/^.*\./, '');
		$('#previewimg').show();
		document.getElementById('previewimg').src = window.URL.createObjectURL(img.files[0]);
	}
	function previewcoverimg(img)
	{
		$('#previecoverwimg').show();
		document.getElementById('previecoverwimg').src = window.URL.createObjectURL(img.files[0]);
	}
</script>
<script>
var $modal = $('#covermodal');
var image = document.getElementById('coverimage');
var cropper;
$("body").on("change", ".coverimage", function(e){

var files = e.target.files;
var done = function (url) {
image.src = url;
$modal.modal('show');
};
var reader;
var file;
var url;
if (files && files.length > 0) {
file = files[0];
if (URL) {
done(URL.createObjectURL(file));
} else if (FileReader) {
reader = new FileReader();
reader.onload = function (e) {
done(reader.result);
};
reader.readAsDataURL(file);
}
}
});
$modal.on('shown.bs.modal', function () {
cropper = new Cropper(image, {
aspectRatio: 1,
viewMode: 3,
preview: '.coverpreview'
});
}).on('hidden.bs.modal', function () {
cropper.destroy();
cropper = null;
});
$("#covercrop").click(function(){
canvas = cropper.getCroppedCanvas({
width: 800,
height: 350,
});
canvas.toBlob(function(blob) {
url = URL.createObjectURL(blob);
var reader = new FileReader();
reader.readAsDataURL(blob); 
reader.onloadend = function() {
var base64datacover = reader.result;
$('#previecoverwimg').attr('src', base64datacover);
$('#coverimg').val(base64datacover);
$modal.modal('hide');
// var image = new Image();
// image.onload = function(){
//    console.log(image.width); // image is loaded and we have image width 
// }
// image.src = base64data;

// return false;
}
});
})
</script>
<script>
$(document).ready(function() {
	
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});	
</script>
<script type="text/javascript">
	$("#profile-btn").on('click',function(e)
	{
	    e.preventDefault();
	    if($('#filimg').val() != '')
	    {
	    	$('#profile-err').hide();
	    }else
	    {
	    	$('#profile-err').html('Please upload a pic');
	    	$('#profile-err').css('color','red');
	    }
	    if($('#filimg').val() != '')
	    {
		    $("#profile-form").submit();   	
	    } else
	    {
	    	return false;
	    }

    });
</script>
<script type="text/javascript">
	function add_community()
	{
		// alert('hii');
		var img=$('#profileimage').val(); 
		var title=$('#title').val(); 
		var coverimg=$('#coverimg').val(); 
		var description=$('#description').val();
		
		if(img=='')
		{
			$('#proimg').html('This field is required');
			$('#proimg').css('color','red');
		}else 
		{
			$('#proimg').hide();
		}
		if(title=='')
		{
			$('#commtitle').html('This field is required');
			$('#commtitle').css('color','red');
		}
		else 
		{
			$('#commtitle').hide();
		} 
		if(coverimg=='')
		{
			$('#coverimg').html('This field is required');
			$('#coverimg').css('color','red');
		} 
		else 
		{
			$('#coverimg').hide();
		}
		if(description=='')
		{
			$('#commdes').html('This field is required');
			$('#commdes').css('color','red');
		} 
		else 
		{
			$('#commdes').hide();
		}
		if(img!='' && description!='' && title!='' && coverimg!='')
		{
			$('#community_form').submit();
			// var fd = new FormData();

			// var file_data = $('#profileimage')[0].files;
			// fd.append("file", file_data);
			// $.ajax({
			// headers: {
   //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   //                    },
			// type: "POST",
			// url: "{{route('admin.add.community')}}",
			// data: {'image': fd,'title':title,'description':description,'coverimg':coverimg},
			// processData: false,
   //          contentType: false,
			// success: function(data){
			// swal("Add Community!", "Community added successfully!", "success");
			// location.reload();
			// }
			// });
		}else
		{
			return false;
		}
	}
</script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
       config.allowedContent = true;
       config.extraAllowedContent = 'div(*)';
    });

</script>
<script>
$(".toggle-password").click(function() 
{
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1', {
		height:300,
    // filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
    filebrowserUploadUrl: "{{ route('admin.upload.image',['_token'=>csrf_token() ]) }}",
    filebrowserUploadMethod: 'form'
} );
</script>

<script type="text/javascript">

	$(document).ready(function() {
    $('#example').DataTable();
} );
	function showpass() {
  var x = document.getElementById("passlogin");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script type="text/javascript">
function validateEmail($email) 
	{
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  return emailReg.test( $email );
   }
  $("#register").on('click',function(e)
	{
	    e.preventDefault();
	    
	    if($('#emailid').val() != '')
	    {
	    	$('#semailerr').hide();
	    }else
	    {
	    	$('#semailerr').html('Email is required');
	    	$('#semailerr').css('color','red');
	    }

	    if($('#spassword').val() != '')
	    {
	    	$('#spasserr').hide();
	    }else
	    {
	    	$('#spasserr').html('Password is required');
	    	$('#spasserr').css('color','red');
	    }

	    if($('#scpassword').val() != '')
	    {
	    	$('#scpasserr').hide();
	    }else
	    {
	    	$('#scpasserr').html('Confirm Password is required');
	    	$('#scpasserr').css('color','red');
	    } 
	    
	    if(($('#emailid').val() != '') && ($('#spassword').val() != '') && ($('#scpassword').val() != ''))
	    {
		    if( !validateEmail($('#emailid').val())) 
		    { 
		    	$('#erroremail').html('Email is not valid');
		    	$('#erroremail').css('color','red');
		    	return false;
		    }else{
  				$('#erroremail').hide();
		    }
		    var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
						if($('#spassword').val().match(paswd)) 
						{ 
							
							$('.errorshow').hide();
						}
						else
						{ 
							
						$('.errorshow').html('Password should contain at least one numeric digit and a special character and length between 7 to 15 characters');
						$('.errorshow').css('color','red');
						return false;
						}
				if($('#spassword').val()!=$('#scpassword').val())
				{
					$('.pass-miss').html('Password and Confirm Password not matched!');
					$('.pass-miss').css('color','red');
					return false;
				}else
				{
					$('.pass-miss').hide();
				}
		
		    	$("#registerform").submit();
		    	
	    } else
	    {
	    	return false;
	    }

    });

  $("#loginbtn").on('click',function(e)
	{

	    e.preventDefault();
	    if($('#emaillogin').val() != '')
	    {
	    	$('#emailloginerr').hide();
	    }else
	    {
	    	$('#emailloginerr').html('Email is required');
	    	$('#emailloginerr').css('color','red');
	    }

	    if($('#passlogin').val() != '')
	    {
	    	$('#passlerr').hide();
	    }else
	    {
	    	$('#passlerr').html('Password is required');
	    	$('#passlerr').css('color','red');
	    }

	    if(($('#emaillogin').val() != '') && ($('#passlogin').val() != ''))
	    {

		    if( !validateEmail($('#emaillogin').val())) 
		    { 
		    	$('#emailerr').html('Email is not valid');
		    	$('#emailerr').css('color','red');
		    	return false;
		    }
		    $('#loginform').submit();
		    // if($('#customCheck').prop('checked') == true)
		    // {
	     //      $('#customCheck').attr('name','');
	     //      var remember = $('#customCheck').val();
	     //   }else{
	     //      $('#customCheck').attr('name','');
	     //      // var remember = $('#customCheck').val();
	     //      var remember =0;
	     //   }
		    	// $("#registerform").submit();
		    	
		}else{
 			 return false;
		}
		

	});

  
  $(document).ready(function () {
	$(".alert").fadeTo(5000, 1000).slideUp(1000, function(){
    $(".alert").slideUp(1000);
});
});

$("#forgotbtn").on('click',function(e)
{
    e.preventDefault();

    if($('#emaillidf').val() != '')
    {
    	if(!validateEmail($('#emaillidf').val())) 
		{ 
		    	$('#emailfierr').html('Email is not valid');
		    	$('#emailfierr').css('color','red');
		    	return false;
		}
    	$('#emailferr').hide();
    	$('#forgotform').submit();
    }else
    {
    	$('#emailferr').html('Email is required');
    	$('#emailferr').css('color','red');
    	return false;
    }
}); 

$("#changebtn").on('click',function(e)
	{
	    e.preventDefault();

	    if($('#passwordc').val() != '')
	    {
	    	$('#passcerr').hide();
	    }else
	    {
	    	$('#passcerr').html('Password is required');
	    	$('#passcerr').css('color','red');
	    }

	    if($('#passwordcp').val() != '')
	    {
	    	$('#cperr').hide();
	    }else
	    {
	    	$('#cperr').html('Confirm Password is required');
	    	$('#cperr').css('color','red');
	    } 
	    
	    if(($('#passwordc').val() != '') && ($('#passwordcp').val() != ''))
	    {
				if($('#passwordc').val()!=$('#passwordcp').val())
				{
					$('#passcperr').html('Password and Confirm Password not matched!');
					$('#passcperr').css('color','red');
					return false;
				}else
				{
					$('#passcperr').hide();
				}
		
		    	$("#changepform").submit();
		    	
	    } else
	    {
	    	return false;
	    }

    });

$("#otpbtn").on('click',function(e)
	{
	    e.preventDefault();

	    if($('#otp').val() != '')
	    {
	    	$('#otperr').hide();
	    	// $("#otpform").submit();
	    	var otp=$('#otp').val();
	    	var email=$('#email').val();
	    		$.ajax({
	           headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
	            url: "{{route('admin.checkotp')}}",
	            type: 'POST', 
		           data: {otp:otp, email:email},
		           success: function( data ) 
		           {
		           	  
		           	   if(data==2)
		           	   {
		           	   	    $('#otpinval').html('Invalid OTP');
			                $('#otpinval').css('color','red');
		           	   }else
		           	   {
		           	   		$('#otpinval').html('OTP verify successfully');
			                window.location.href= data.url;
		           	   }
		               
		           }
		       });
	    }else
	    {
	    	$('#otperr').html('OTP is required');
	    	$('#otperr').css('color','red');
	    	return false;
	    }
		    	
    });
</script>
<script type="text/javascript">
	function editcomm(i) 
	{
		var comid=$.md5($('#id'+i).val());
        var url="{{url('admin/edit-community/')}}"+comid;
	    window.location.href= data.url;    	
    }	

    function details(i)
     {
     	var title=$('#title'+i).val();
     	var description=$('#des'+i).val();
        $('#titlecom').html(title);
        $('#desall').html(description);
     }

     function imgopen(i)
     {
     	titlenew= $('#title'+i).val();
     	img= $('#img'+i).val();
        $('#titleimg').html(titlenew);
        $('#imges').html('<img src="'+img+'" style="width:250px;height:250px;">');
     }     
</script>
<script type="text/javascript">
	function regstatus(val,user)
	{
		
		var status=$(val).val();
		$.ajax({
	           headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
	            url: "{{route('admin.user.status')}}",
	            type: 'POST', 
		           data: {status:status,id:user},
		           success: function( data ) 
		           {
		           	   console.log(data);
		           	   if(data==1)
		           	   {
		           	   	alert('status Changed successfully');
		           	   }
		           }
		       });
	}
</script>
<script type="text/javascript">
   	$(".media-pic").click(function () {
       $("#file").trigger('click');
   })

   	function previewimg(img)
	{
		$('#blah').show();
		$('#titletxt').show();
		$('#imgsec').show();
		$('#titletxtsec').show();
		$('#editor-sec').hide();
		var filename = $("#file").val();
		var extension = filename.replace(/^.*\./, '');
		
		// var boxZone = $(img).parent().parent().find('.preview-zone').find('.box').find('.box-body');
		
		if(extension=='mp4')
		{
			$('#videoid').show();
			$('#audid').hide();
			$('#blah').hide();
			$('#audiosrc').hide();
			$('#videosrc').show();
			$('#imagesrc').hide();
			$('.newimg').hide();
			
			document.getElementById('videoid').src = window.URL.createObjectURL(img.files[0]);
			document.getElementById('videosrc').src = window.URL.createObjectURL(img.files[0]);
			 // $('#imgsec').html('<video style="max-width: 283px;text-align: center; controls><source src="'+window.URL.createObjectURL(img.files[0])+'" type="video/mp4"></video>');
		}else if(extension=='jpg' || extension=='jpeg' || extension=='png')
		{
			$('#audid').hide();
			$('#videoid').hide();
			$('#audiosrc').hide();
			$('#videosrc').hide();
			$('#imagesrc').show();
			$('.newimg').hide();
			document.getElementById('blah').src = window.URL.createObjectURL(img.files[0]);
			
		}
		// else if(extension=='ogg')
		// {
			
		// 	$('#audid').show();
		// 	$('#videoid').hide();
		// 	$('#blah').hide();
		// 	$('#audiosrc').show();
		// 	$('#videosrc').hide();
		// 	$('#imagesrc').hide();
		// 	document.getElementById('audid').src = window.URL.createObjectURL(img.files[0]);
			
		// 	// $('#videoid').html('<video style="max-width: 283px;text-align: center; controls><source src="'+window.URL.createObjectURL(img.files[0])+'" type="audio/ogg"></video>');
		// }
		
}
</script>
<script type="text/javascript">
	 $(".addmorespec").hide();
var count = 0;
$("#addspec").on('click',function(){
// $('.addmorespec:eq('+count+')').show();	
$('#moreoption').append('<div class="form-group form-float"><div class="form-line"><input class="form-control options" name="option[]" value=""placeholder="Option Text" type="text" required=""></div><span class="remove" style="color:red;">Remove</span></div>');	
count++;	
});
$('#moreoption').on('click','.remove',function() {
    $(this).parent().remove();
});

function approvecomm(commid,status)
{
	$.ajax({
	           headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
	            url: "{{route('admin.community.request')}}",
	            type: 'POST', 
		           data: {commid:commid,status:status},
		           success: function( data ) 
		           {
		           	   console.log(data);
		           	   if(data.status=='true')
		           	   {
		           	   		if(status==1)
			           	   {
			           	   	swal("Approve Request!", "Community Request Approved Successfully!", "success");
			           	   	$('#del'+commid).show();
			           	   	$('#app'+commid).hide();
			           	   }else if(status==0)
			           	   {
			           	   	swal("Cancel Request!", "Community request canceled successfully!", "success");
			           	   	$('#del'+commid).hide();
			           	   	$('#app'+commid).show();
			           	   }
		           	   }
		           	   
		           	   // if(data==1)
		           	   // {
		           	   // 	alert('status Changed successfully');
		           	   // }
		           }
		       });
}
</script>
<script type="text/javascript">
	function previewimg(img)
	{
		var filename = $("#file").val();
		var extension = filename.replace(/^.*\./, '');
			$('#editor-sec').hide();
			$('#blah').show();
			$('#audid').hide();
			$('#videoid').hide();
			$('#imgsec').show();
			document.getElementById('blah').src = window.URL.createObjectURL(img.files[0]);
	}

	function descriptionadd() 
	{
		$('#image-add').hide();
	}
</script>
<script type="text/javascript">
	$('#catid').on('change',function(){

                    var flag = 1;
                   if(flag==1){
                                   
                        $('#subcat').find('option').not(':first').remove();
                     }

                    var catid=$(this).val();
                    // var json = JSON.stringify(catid);
                    
                    $.ajax({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                           url: "{!!route('admin.subcat.list')!!}",
                           type: 'POST',                         
                            data: {catid:catid},
                            success: function(result) {
                             if(result.length>0){                                  
                              for(var i= 0;i<result.length;i++){                             
                                    function loadDropDownList(collection) {
                                    
                                        $.each(collection, function (index, value) {
                                            console.log(result);
                                        flag = 0;
                                        if(flag==1){
                                            $('#subcat').find('option').not(':first').remove(); 
                                            }
                                            var listItem = $('<option></option>').val(value[0]).html(value[1]);
                                            $('#subcat').append(listItem);       
                                        });
                                    }   

                                    var userName = result[i].name;  
	                                var userID = result[i].id;  
	                                var myCollection = {userID: [userID,userName]};
	                                
	                                loadDropDownList(myCollection);                         
                                                          
                                } 
                            }else{

                                // $('.divDepartment').removeClass('hidden');
                            }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {}
                        });  
                    
                    });
</script>

  