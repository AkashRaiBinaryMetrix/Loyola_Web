<script src="https://cdn.tiny.cloud/1/qn4aa24uvhmo3xu7npdi7g7r7ka96hp22jze02e4gss8pklc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/filesize/9.0.3/filesize.min.js"></script>

<script type="text/javascript">

    if (window.location.hash === "#_=_"){

    history.replaceState 

        ? history.replaceState(null, null, window.location.href.split("#")[0])

        : window.location.hash = "";

}

</script>

<script>

  tinymce.init({

  charLimit : 1500,

  selector: 'textarea.full-featured-non-premium',

  

  setup: function (editor) {

        editor.on('change', function () {

        	

            editor.save();

            var test = document.getElementsByClassName("full-featured-non-premium");



test.onpaste = function(e){

    //do some IE browser checking for e

    var max = test.getAttribute("maxlength");

    console.log(max);

    e.clipboardData.getData('text/plain').slice(0, max)

};

        });

       var wordLen = 400,

		len; // Maximum word length

		editor.on('keydown', function(event) {

		

			len = $('textarea.full-featured-non-premium').val().split(/[\s]+/);

			var text=$('textarea.full-featured-non-premium').val();

			if (len.length >= wordLen) { 



				if ( event.keyCode == 46 || event.keyCode == 8 ) {// Allow backspace and delete buttons

		    } else if (event.keyCode < 48 || event.keyCode > 57 ) {//all other buttons

		    	event.preventDefault();

		    }

		    // text =text.substring(0, wordLen);

		    // $('textarea.full-featured-non-premium').val(text.substring(0, wordLen));

		    console.log(len.length);

			} 

			// else if(len.length <= wordLen){

			// 	console.log('hii');

			// 	$('textarea.full-featured-non-premium').val(text.substring(0, wordLen));

			// }

			// console.log(len.length + " words are typed out of an available " + wordLen);

			wordsLeft = (wordLen) - len.length;

			if(wordsLeft>0)

			{

				$('#postcontnt').html(wordsLeft+ ' words left');

				

			}

			else if(wordsLeft == 0) {

				$('#postcontnt').html('0 words left');

				$('#postcontnt').css({

					'background':'red'

				}).prepend('<i class="fa fa-exclamation-triangle"></i>');

			}

			else if(wordsLeft < 0) {

				$('#postcontnt').html('words limit exceed');

				$('#postcontnt').css({

					'background':'red'

				}).prepend('<i class="fa fa-exclamation-triangle"></i>');

			}

		});

    },

  plugins: 'preview visualblocks visualchars fullscreen image link media imagetools emoticons wordcount',

  imagetools_cors_hosts: ['picsum.photos'],

  menubar:false,

    statusbar: false,

    branding:false,

    draggable_modal: true,

  toolbar: 'undo redo | bold italic underline strikethrough |fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify  |  numlist bullist | forecolor backcolor removeformat| emoticons link insertfile',



file_picker_callback: function(cb, value, meta) {

                var input = document.createElement('input');

                input.setAttribute('type', 'file');

                input.setAttribute('accept', 'image/*');

                input.onchange = function() {

                    var file = this.files[0];



                    var reader = new FileReader();

                    reader.readAsDataURL(file);

                    reader.onload = function () {

                        var id = 'blobid' + (new Date()).getTime();

                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;

                        var base64 = reader.result.split(',')[1];

                        var blobInfo = blobCache.create(id, file, base64);

                        blobCache.add(blobInfo);

                        cb(blobInfo.blobUri(), { title: file.name });

                    };

                };

                input.click();

            },

 image_title: true,

 automatic_uploads: true,

 images_upload_url: "{{url('upload')}}",

 file_picker_types: 'image',

  importcss_append: true,

  height: 260,

  block_unsupported_drop: false,

  // image_caption: true,

  

 });

</script>

<script>

        // var ENDPOINT = "{{ url('/') }}";

        // var page = 1;

        // infinteLoadMore(page);

        // $(window).scroll(function () {

        //     if ($(window).scrollTop() + $(window).height() >= $(document).height()) {

        //         page++;

        //         infinteLoadMore(page);

        //     }

        // });

        // function infinteLoadMore(page) {

        //     $.ajax({

        //             url: ENDPOINT + "/blogs?page=" + page,

        //             datatype: "html",

        //             type: "get",

        //             beforeSend: function () {

        //                 $('.auto-load').show();

        //             }

        //         })

        //         .done(function (response) {

        //             if (response.length == 0) {

        //                 $('.auto-load').html("We don't have more data to display :(");

        //                 return;

        //             }

        //             $('.auto-load').hide();

        //             $("#data-wrapper").append(response);

        //         })

        //         .fail(function (jqXHR, ajaxOptions, thrownError) {

        //             console.log('Server error occured');

        //         });

        // }

    </script>

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

	function copyToClipboard(element,postid) 

	{

      //  $(element).select();

      // document.execCommand("copy");

       var $tempElement = $("<input>");

        $("body").append($tempElement);

        $tempElement.val($(element).val()).select();

        document.execCommand("Copy");

        $tempElement.remove();

    }

</script>

<script type="text/javascript">

	<?php 

	// if(empty(app\Helpers\Helper::getCookie()))

	// { 

		?>



	// $(document).ready(function(){

 //    $('#loginform').load( 'focus', ':input', function(){p

 //        $('input[type="email').val('');

 //        $('input[type="password"]').val('');

 //    });

 //     $('#registerform').load( 'focus', ':input', function(){

 //        $('input[type="email').val('');

 //        $('input[type="text').val('');

 //        $('input[type="password"]').val('');

 //    });

 //   });

   <?php

	// }



?>

$(document).ready(function () {

// 	$(".alert").fadeTo(5000, 10000).slideUp(10000, function(){

//     $(".alert").slideUp(10000);

// });

$('.alert').delay(10000).fadeOut('slow');

});

</script>

<script type="text/javascript">

	function readFile(input) {

  if (input.files && input.files[0]) {

    var reader = new FileReader();



    reader.onload = function(e) {

      var htmlPreview =

        '<img width="200" src="' + e.target.result + '" />' +

        '<p>' + input.files[0].name + '</p>';

      var wrapperZone = $(input).parent();

      var previewZone = $(input).parent().parent().find('.preview-zone');

      var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');



      wrapperZone.removeClass('dragover');

      previewZone.removeClass('hidden');

      boxZone.empty();

      boxZone.append(htmlPreview);

    };



    reader.readAsDataURL(input.files[0]);

  }

}



</script>

<script type="text/javascript">

	$(".media-audio").click(function () {

    $("#file").trigger('click');



});

	function previewimg(img)

	{

		var filename = $("#file").val();

		var extension = filename.replace(/^.*\./, '');

		// var boxZone = $(img).parent().parent().find('.preview-zone').find('.box').find('.box-body');

		var postimage=img.files[0].size;

		var filesizeimg=filesize(postimage);

		var image=(postimage / (1024*1024)).toFixed(2);

		tinstotal = Math.round(image);

		

		if(tinstotal > '20')

		{

			alert('File size is too large it should be max 20 MB');

			return false;

		}

		if(extension=='mp4')

		{

			// $('#titletxt').show();

			$('#imgsec').show();

			$('#titletxtsec').show();

			$('#options').hide();

			$('#poll_footer').hide();

			// $('#editor-sec').hide();

			$('#videoid').show();

			$('#audid').hide();

			$('#blah').hide();

			$('#audiosrc').hide();

			$('#videosrc').show();

			$('#imagesrc').hide();

			$('#postsec').hide();

			

			document.getElementById('videoid').src = window.URL.createObjectURL(img.files[0]);

			document.getElementById('videosrc').src = window.URL.createObjectURL(img.files[0]);

			 // $('#imgsec').html('<video style="max-width: 283px;text-align: center; controls><source src="'+window.URL.createObjectURL(img.files[0])+'" type="video/mp4"></video>');

		}else if(extension=='jpg' || extension=='jpeg' || extension=='png')

		{

			

			// $('#titletxt').show();

			$('#imgsec').show();

			$('#titletxtsec').show();

			$('#options').hide();

			$('#poll_footer').hide();

			// $('#editor-sec').hide();

			$('#blah').show();

			$('#audid').hide();

			$('#videoid').hide();

			$('#audiosrc').hide();

			$('#videosrc').hide();

			$('#postsec').hide();

			$('#imagesrc').show();

			document.getElementById('blah').src = window.URL.createObjectURL(img.files[0]);

			

		}else if(extension=='ogg' || extension=='mp3')

		{

			// $('#titletxt').show();

			$('#imgsec').show();

			$('#titletxtsec').show();

			$('#options').hide();

			$('#poll_footer').hide();

			// $('#editor-sec').hide();

			$('#audid').show();

			$('#videoid').hide();

			$('#blah').hide();

			$('#audiosrc').show();

			$('#videosrc').hide();

			$('#imagesrc').hide();

			$('#postsec').hide();

			document.getElementById('audid').src = window.URL.createObjectURL(img.files[0]);

			

			// $('#videoid').html('<video style="max-width: 283px;text-align: center; controls><source src="'+window.URL.createObjectURL(img.files[0])+'" type="audio/ogg"></video>');

		}else

		{

			alert('This file format is not supported');

			return false;

		}

		

		



//     if (input.files && input.files[0]) {

// var reader = new FileReader();

// reader.onload = function (e) {

// 	// $('#blah').show();

// $('textarea#full-featured-non-premium').hide();

// $('#blah')

// .attr('src', e.target.result)

// .width(100)

// .height(100);

// };

// reader.readAsDataURL(input.files[0]);

// }

}

</script>

<script type="text/javascript">

	document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {

  const dropZoneElement = inputElement.closest(".drop-zone");



  dropZoneElement.addEventListener("click", (e) => {

    inputElement.click();

  });



  inputElement.addEventListener("change", (e) => {

    if (inputElement.files.length) {

      updateThumbnail(dropZoneElement, inputElement.files[0]);

    }

  });



  dropZoneElement.addEventListener("dragover", (e) => {

    e.preventDefault();

    dropZoneElement.classList.add("drop-zone--over");

  });



  ["dragleave", "dragend"].forEach((type) => {

    dropZoneElement.addEventListener(type, (e) => {

      dropZoneElement.classList.remove("drop-zone--over");

    });

  });



  dropZoneElement.addEventListener("drop", (e) => {

    e.preventDefault();



    if (e.dataTransfer.files.length) {

      inputElement.files = e.dataTransfer.files;

      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);

    }



    dropZoneElement.classList.remove("drop-zone--over");

  });

});



/**

 * Updates the thumbnail on a drop zone element.

 *

 * @param {HTMLElement} dropZoneElement

 * @param {File} file

 */

function updateThumbnail(dropZoneElement, file) {

  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");



  // First time - remove the prompt

  if (dropZoneElement.querySelector(".drop-zone__prompt")) {

    dropZoneElement.querySelector(".drop-zone__prompt").remove();

  }



  // First time - there is no thumbnail element, so lets create it

  if (!thumbnailElement) {

    thumbnailElement = document.createElement("div");

    thumbnailElement.classList.add("drop-zone__thumb");

    dropZoneElement.appendChild(thumbnailElement);

  }



  thumbnailElement.dataset.label = file.name;



  // Show thumbnail for image files

  if (file.type.startsWith("image/")) {

    const reader = new FileReader();



    reader.readAsDataURL(file);

    reader.onload = () => {

      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;

    };

  } else {

    thumbnailElement.style.backgroundImage = null;

  }

}

</script>

<script type="text/javascript">

	function likecomment(commentid,postid,communityid,status) 

	{

		$.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('user.comment.likes')}}",

	            type: 'POST', 

		         data: {commentid:commentid,postid:postid,communityid:communityid,status:status},

		         success: function( data ) 

		           {

		           	 

		           	  if(data.status=='true')

		           	  {			

           	  	     	if(status==1)

           	  	     	{

           	  	     	

		           	  	    		$('#like-comm-id'+commentid).hide(); 

		           	  	    	    $('#total-count-like'+commentid).html(data.like);  

		           	  	            $('#unlike-comm-id'+commentid).show();

		           	  	    	

           	  	     	}else

           	  	     	{		

		           	  	    		$('#like-comm-id'+commentid).show( ); 

		           	  	    	    $('#total-count-like'+commentid).html(data.like);  

		           	  	            $('#unlike-comm-id'+commentid).hide();

		           	  	    	

           	  	     	}

	           	  	       

		           	  }else if(data.status=='false')

		           	  {

		           	  	$('#login-modal').modal();

		           	  	

		           	  }

		           }

		       });

	}

	function displayCategory() {
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					 },
			url: "{{route('user.category.list')}}",
			type: 'POST', 
			data: {continentId:$("#continent").val()},
			success: function(data) {
						$("#category_div").empty().html(data);
				}
			});
	}

	function displaySubCategoryRes(){
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					 },
			url: "{{route('user.subcategory.list')}}",
			type: 'POST', 
			data: {categoryId:$("#category_res").val()},
			success: function(data) {
						$("#sub_category_div").empty().html(data);
				}
			});
	}
	
	function displayCategoryPost() {
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					 },
			url: "{{route('user.category.postlist')}}",
			type: 'POST', 
			data: {continentId:$("#continent").val()},
			success: function(data) {
						$("#category_div").empty().html(data);
				}
			});
	}

	function displaySubCategoryResPost(){
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					 },
			url: "{{route('user.subcategory.postlist')}}",
			type: 'POST', 
			data: {categoryId:$("#category_res").val()},
			success: function(data) {
						$("#sub_category_div").empty().html(data);
				}
			});
	}

	function getCommunityList(){
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					 },
			url: "{{route('user.community.communitylist')}}",
			type: 'POST', 
			data: {continentId:$("#continent").val(), categoryId:$("#category_res").val(), subcategory_res:$("#subcategory_res").val()},
			success: function(data) {
						$("#community_div").empty().html(data);
				}
			});
	}

	function likesubcomment(commentid,postid,communityid,status,replyid="") 

	{

		$.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('user.sub.comment.likes')}}",

	            type: 'POST', 

		         data: {commentid:commentid,postid:postid,communityid:communityid,status:status,reply_id:replyid},

		         success: function( data ) 

		           {

		           	 

		           	  if(data.status=='true')

		           	  {		

		           	  	

           	  	     	if(status==1)

           	  	     	{

           	  	     	

		           	  	    		$('#like-sub-comm-id'+replyid).hide(); 

		           	  	    	    $('#total-sub-count-like'+replyid).html(data.like);  

		           	  	            $('#unlike-sub-comm-id'+replyid).show();

		           	  	    	

           	  	     	}else

           	  	     	{		

		           	  	    		$('#like-sub-comm-id'+replyid).show( ); 

		           	  	    	    $('#total-sub-count-like'+replyid).html(data.like);  

		           	  	            $('#unlike-sub-comm-id'+replyid).hide();

		           	  	    	

		           	  	    	

		           	  	    

           	  	     	}

	           	  	       

		           	  }else if(data.status=='false')

		           	  {

		           	  	$('#login-modal').modal();

		           	  	

		           	  }

		           }

		       });

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

	    

	    if($('#username').val() != '')

	    {

	    	$('#snameerr').hide();

	    }else

	    {

	    	$('#snameerr').html('Username is required');

	    	$('#snameerr').css('color','red');

	    }

	    

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

	    

	    if(($('#username').val() != '') && ($('#emailid').val() != '') && ($('#spassword').val() != '') && ($('#scpassword').val() != ''))

	    {



		    if( !validateEmail($('#emailid').val())) 

		    { 

		    	$('#erroremail').html('Email is not valid');

		    	$('#erroremail').css('color','red');

		    	return false;

		    }

		        var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;

						if($('#spassword').val().match(paswd)) 

						{ 

							

							$('#passcheck').hide();

						}

						else

						{ 

							

						$('#passcheck').html('Password should contain at least one numeric digit and a special character and length between 7 to 15 characters');

						$('#passcheck').css('color','red');

						return false;

						} 

				if($('#spassword').val()!=$('#scpassword').val())

				{

					$('#errorshow').html('Password and Confirm Password not matched!');

					$('#errorshow').css('color','red');

					return false;

				}else

				{

					$('#errorshow').hide();

					

				}

		    

		         var name= $('#username').val();

		         var email= $('#emailid').val();

		         var password= $('#spassword').val();

		    	// $("#registerform").submit();

		    	swal('Please Wait....');

		    	$.ajax({

	           headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('user.register')}}",

	            type: 'POST', 

		           data: {name:name, email:email, password:password},

		           success: function( data ) 

		           {

		           	

		           	   if(data.status=='true')

		           	   {

		           	   	    $(".modal-body input").val("")



			                swal(data.msg);

			                $('#signup-modal').modal('toggle');

                            $('#signup-modal').modal('hide');

			                

		           	   }else if(data.status=='false')

		           	   {

		           	   		swal(data.msg);

		           	   }else{

		           	   	   swal('Server Error try after some time!');

		           	   }

		               

		           }

		       });

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

		    	$('#emailloginerr').html('Email is not valid');

		    	$('#emailerror').css('color','red');

		    	return false;

		    }

		    // $('#loginform').submit();

		    if($('#customCheck').prop('checked') == true)

		    {

	          $('#customCheck').attr('name','');

	          var remember = $('#customCheck').val();

	       }else{

	          $('#customCheck').attr('name','');

	          // var remember = $('#customCheck').val();

	          var remember =0;

	       }

		    var emailnew = $('#emaillogin').val();

		    var passwordnew = $('#passlogin').val();

		    	// $("#registerform").submit();

		    	$.ajax({

	           headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{url('login')}}",

	            type: 'POST', 

		           data: {email:emailnew, password:passwordnew,remember:remember},

		           success: function( data ) 

		           {

		           	   if(data.status=='true')

		           	   {

		           	   	// alert(data.url);

			                $("#login-modal input").val("")

			                window.location.href="{{route('home.dashboard')}}";

			                // window.location.href=data.url;

			                $('#login-modal').modal('toggle');

                            $('#login-modal').modal('hide');

	                    }else if(data.status=='false') 

		           	    {

		           	   		swal(data.msg);

		           	   		return false;

		           	   	

		           	    }else if(data.status==1) 

		           	    {

		           	   		// swal(data.msg);

		           	   		$('#erroremail').html(data.msg);

		           	   		$('#erroremail').css('color','red');

		           	   		return false;

		           	   	}

		           	    else if(data.status==2) 

		           	    {

		           	   		$('#errorpass').html(data.msg);

		           	   		$('#errorpass').css('color','red');

		           	   		$('#erroremail').hide();

		           	   		return false;

		           	    }   

		           }

		       });

		}else{

 			 return false;

		}

		



	});



  $("#signup").on('click',function(e)

	{

		// $('#login-modal').modal('toggle');

      $('#login-modal').modal('hide');

		$('#signup-modal').modal('show');

		// $('#signup-modal').on('shown.bs.modal', function () {

		//   $('html').css('overflow','visible');

		// }).on('hidden.bs.modal', function() {

		//   $('html').css('overflow','visible');

		// });

	});



  $("#loginid").on('click',function(e)

	{

		// $('#signup-modal').modal('toggle');

      $('#signup-modal').modal('hide');

		$('#login-modal').modal();

	});

  $("#forgotbtn").on('click',function(e)

	{

		// $('#signup-modal').modal('toggle');

      $('#forgot-modal').modal();

		$('#login-modal').modal('hide');

	});



</script>

<script type="text/javascript">

	$("#enquirybtn").on('click',function(e)

	{

	    e.preventDefault();

	    if($('#first_name').val() != '')

	    {

	    	$('#firstname').hide();

	    }else

	    {

	    	$('#firstname').html('First name is required');

	    	$('#firstname').css('color','red');

	    }



	    if($('#last_name').val() != '')

	    {

	    	$('#lastname').hide();

	    }else

	    {

	    	$('#lastname').html('Last name is required');

	    	$('#lastname').css('color','red');

	    }



	    if($('#email').val() != '')

	    {

	    	$('#email_id').hide();

	    }else

	    {

	    	$('#email_id').html('Email is required');

	    	$('#email_id').css('color','red');

	    }



	    if($('#phone').val() != '')

	    {

	    	$('#contact').hide();

	    }else

	    {

	    	$('#contact').html('Phone no is required');

	    	$('#contact').css('color','red');

	    }



	    if($('#message').val() != '')

	    {

	    	$('#msgs').hide();

	    }else

	    {

	    	$('#msgs').html('Message is required');

	    	$('#msgs').css('color','red');

	    }



	    if(($('#first_name').val() != '') && ($('#last_name').val() != '') && ($('#email').val() != '') && ($('#phone').val() != '') && ($('#message').val() != ''))

	    {



		    if( !validateEmail($('#email').val())) 

		    { 

		    	$('#emailinval').html('Email id is not valid');

		    	$('#emailinval').css('color','red');

		    	return false;

		    }

		    $('#enquiryform').submit();

	

 			 return false;

		}

		



	});



	$("#fpbtn").on('click',function(e)

	{

		emailid= $('#emaillidf').val();

		

	    e.preventDefault();

	    if($('#emaillidf').val() != '')

	    {

	    	$('#emailidferr').hide();

	    }else

	    {

	    	$('#emailidferr').html('Email Id is required');

	    	$('#emailidferr').css('color','red');

	    }



	   

	    if(($('#emaillidf').val() != ''))

	    {



		    if( !validateEmail($('#emaillidf').val())) 

		    { 

		    	$('#emailfperror').html('Email id is not valid');

		    	$('#emailfperror').css('color','red');

		    	return false;

		    }

		    // $('#forgotform').submit();

		    swal('Please Wait.....')

		    

			 $.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('user.forgot.password')}}",

	            type: 'POST', 

		         data: {email:emailid},

		         success: function( data ) 

		           {

		           	  

		           	  if(data==1)

		           	  {



		           	  	    swal('Email id not matched with our records');

		           	  	    return false;    

		           	  }else

		           	  {

		           	  	   $('#forgot-modal').modal('hide');

		           	  	   $('#emailotp').val(emailid);

		           	  	   swal('One Time Password has been sent on your email id successfully');

		           	  	   $('#otp-modal').modal();

		           	  }

		           }

		       });

	

 			 

		}else

		{

			return false;

		}



		

	});



	$("#otpbtn").on('click',function(e)

	{

		otp= $('#otp').val();

		emailotp=$('#emailotp').val();

	    e.preventDefault();

	    if($('#otp').val() != '')

	    {

	    	$('#otpferr').hide();

	    }else

	    {

	    	$('#otpferr').html('OTP is required');

	    	$('#otpferr').css('color','red');

	    }



	   

	    if(($('#otp').val() != ''))

	    { 

			 $.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('user.verify.otp')}}",

	            type: 'POST', 

		         data: {otp:otp,email:emailotp},

		         success: function( data ) 

		           {



		           	  if(data==1)

		           	  {

		           	  	swal('Invalid OTP');

		           	  	return false;    

		           	  }else

		           	  {

	           	  	   $('#otp-modal').modal('hide');

	           	  	  

										 

	           	  	   window.location.href=data.route;

		           	  }

		           }

		       });

	

 			 

		}else

		{

			return false;

		}



		

	});





		$(document).ready(function($) 

		{

			var commtype = $("#commall").val();

              

			if(commtype=='')

		    {

		    	swal('Please join a community first to create post');

		    	return false;

		    }



		});

	$("#postuser").on('click',function(e)

	{

		

	    e.preventDefault();

	    tinyMCE.triggerSave();

	    var commtypeval = $("#commall").val();

	    if(commtypeval=='')

		    {

		    	swal('Please join a community first to create post');

		    	return false;

		    }

	    if($('#tiletxt').val()!='')

	    {

	    	$('#textpost').hide();

	    }else

	    {

            $('#textpost').show();

	    	$('#textpost').html('This field is required');

	    	$('#textpost').css('color','red');

	    }

	    if($('#community-type').val()!='')

	    {

	    	$('#comtype').hide();

	    }else

	    {

            $('#comtype').show();

	    	$('#comtype').html('This field is required');

	    	$('#comtype').css('color','red');

	    }

        if($('#full-featured-non-premium').val() != '' || $('#file').val()!='')

	    {

	    	$('#postcontnt').hide();

	    	

	    }else 

        {

            $('#postcontnt').show();

            $('#postcontnt').html('This field is required');

	    	$('#postcontnt').css('color','red');

        }

	    if($('#full-featured-non-premium').val() != '' && $('#tiletxt').val()!='' && $('#community-type').val()!='')

	    {

	    	$('#postcontnt').hide();

	    	$('#textpost').hide();

	    	$('#comtype').hide();

	    	var postval=$('#full-featured-non-premium').val();

				var textval=$(postval).text().length;

        if(textval>2500)

        {

        	swal('words limit has been exceed');

        	return false;

        }

	    	$('#postform').submit();

	    }else if(($('#tiletxt').val()!='') && ($('#file').val()!='') && $('#community-type').val()!='')

	    {

	    	$('#postcontnt').hide();

	    	$('#textpost').hide();

	    	$('#comtype').hide();

	    	$('#postform').submit();

	    

	    }else

	    {

	    	

	    	return false;

	    }

		

	});



	

</script>

<script type="text/javascript">

	$("#commentbtn").on('click',function(e)

	{

		$('#nocomment').hide();

		$('#postcontnt').hide();

	    e.preventDefault(); 

	     tinyMCE.triggerSave();



	    var form =$('#commform')[0];

        var formData = new FormData(form); 

        // $('#sorting').show();

        var mycontent = tinymce.activeEditor.getContent();

        var text=$(mycontent).text().length;

        

        if(text>2500)

        {

        	

        	return false;

        }

	    if((mycontent != ''))

	    {

	    	

	    	// $('#commform').submit();

	    	$('#commac').html('');

	    	$('#commentbtn').hide();

	    	$('#spinbtn').show();

	    	// $('#usercomsec').show();

	 		$.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('comment.add')}}",

	            type: 'POST', 

	            processData: false,

                contentType: false,

		         data: formData,

		         success: function( data )

		           {

		           	  tinymce.activeEditor.setContent('');

		           	  $('#commentbtn').show();

	    	          $('#spinbtn').hide();

	    	          

		           	 if(data.status==1)

		           	 {

		           	 	if(data.image==null)

		           	 	{

		           	 		var imgsrc="{{asset('public/images/user.png')}}";

		           	 	// 	$('#userimgda').attr("src",imgsrc);

		           	 	}else

		           	 	{

		           	 		var imgsrc="{{asset('public/user/images')}}"+"/"+data.image;

		           	 		// $('#userimgda').attr("src",userimg);

		           	 	}

		           	 	// $('#commenttime').html(data.time);

		           	 	// $('#contentss').html(data.comment);

		           	 	// $('#username').html(data.name);

		           	 	

		           	 	unlikeimg="{{asset('public/images/like-ico.png')}}";

		           	 	likeimg="{{asset('public/images/like.png')}}";

		           	 	$('#commt-section').prepend('<div class="usercomment-col" ><div class="usercomment-pic"><img src="'+imgsrc+'" alt="" id="user-reply-image"></div><div class="usercomment-content"> <div class="usercomment-name" ><b id="user-reply-name">'+data.name+'</b> <span id="user-reply-time">'+data.time+'</span></div><div class="usercomment-text"><p id="user-comment-reply">'+data.comment+'</p></div><div class="usercomment-btns"> <a href="javascript:void" onclick="likecomment(\''+data.comment_id+'\',\''+data.post_id+'\',\''+data.community_id+'\',\''+1+'\')" id="like-comm-id'+data.comment_id+'"><img src="'+unlikeimg+'" alt="" ><span id="total-count-unlike'+data.comment_id+'"></span></a><a href="javascript:void" onclick="likecomment(\''+data.comment_id+'\',\''+data.post_id+'\',\''+data.community_id+'\',\''+0+'\')" id="unlike-comm-id'+data.comment_id+'" style="display: none;" ><img src="'+likeimg+'" alt="" style="width:20px;height:20px;"><span id="total-count-like'+data.comment_id+'"></span></a> <a href="javascript:void" onclick="replysec(\''+data.comment_id+'\')">Reply</a> <a href="javascript:void" onclick="report(\''+data.comment_id+'\',\''+data.community_id+'\',\''+data.post_id+'\')">Report</a> </div><div class="editor-c" id="reply-sec'+data.comment_id+'" style="margin-top: 15px;display: none;"> <textarea class="form-control full-featured-non-premium" name="comment" id="comment-reply-sec'+data.comment_id+'"></textarea> <span id="words-max" style="margin-top: 5px;color: red;">Maximum words 400</span><button class="common-btn" id="spin-reply-btn'+data.comment_id+'" style="display: none;float: right;margin-top: 10px;"> <span class="spinner-border spinner-border-sm"></span></button> <button type="button" class="common-btn" id="reply-btn'+data.comment_id+'" style="float: right;margin-top: 10px;" onclick="postreply(\''+data.comment_id+'\',\''+data.post_id+'\',\''+data.community_id+'\')">Post</button> </div></div></div><div id="user-reply-section'+data.comment_id+'" class="display-comment" ></div>');

		           	 	

			           	 	$('#reply-sec'+status).hide();

		           	 }

		           }

		       });

		}else if($('#file').val()!='' || ($('#camera-snap').val()!=''))

		{

			

			// $('#commform').submit();

			$('#commac').html('');

	    	$('#commentbtn').hide();

	    	$('#spinbtn').show();

	  //   	$('#usercomsec').show();

	    	$('#imgsec').hide();

			$('#titletxt').hide();

			$('#titletxt').val('');

			var fileval=$('#file').val(null);

			$('#editor-sec').show();

			$.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('comment.add')}}",

	            type: 'POST', 

	            processData: false,

                contentType: false,

		         data: formData,

		         success: function( data ) 

		           {

		           	  $('#commentbtn').show();

	    	          $('#spinbtn').hide();

	    	          // $('#titletxt').hide();

	    	          // $('#imgsec').hide();

	    	          // $('#editor-sec').show();

		           	 if(data.status==1)

		           	 {

		           	 	if(data.image==null)

		           	 	{

		           	 		var imgsrc="{{asset('public/images/user.png')}}";

		           	 	// 	$('#userimgda').attr("src",imgsrc);

		           	 	}else

		           	 	{

		           	 		var imgsrc="{{asset('public/user/images')}}"+"/"+data.image;

		           	 		// $('#userimgda').attr("src",userimg);

		           	 	}

		           	 	// $('#commenttime').html(data.time);

		           	 	// imgcom="{{asset('public/comment')}}"+"/"+data.comment;

		           	 	// imgex=imgcom.substr(imgcom.lastIndexOf('.') + 1);

		           	 	

		           	 	if(data.comment!=null)

		           	 		{

	           	 			var media=data.comment;

			           	 		

			           	 	var $extension=media.replace(/^.*\./, '');

			           	 	if($extension=='jpg' || $extension=='jpeg' || $extension=='png')

			           	 	{

			           	 		var str='<img src="{{asset("public/comment")}}'+'/'+''+data.comment+'"  style="max-height:150px;margin-bottom: 10px;">';

			           	 	}else if($extension=='mp4')

			           	 	{

			           	 		var str='<video width="320" height="240" controls ><source src="{{asset("public/comment")}}'+'/'+''+data.comment+'" type="video/mp4"></video>';

			           	 	}

			           	 	else if($extension=='ogg')

			           	 	{

			           	 		var str='<audio style="width:100%;text-align: center;" controls ><source src="{{asset("public/comment")}}'+'/'+''+data.comment+'" type="audio/ogg"></audio>';

			           	 	}

			           	 	

				           	 	

		           	 		}

		           	 		if(data.title!=null)

		           	 		{

		           	 			var title=data.title;

		           	 		}else

		           	 		{

		           	 			var title='';

		           	 		}

		           	 		likeimg="{{asset('public/images/like-ico.png')}}";

		           	 		unlikeimg="{{asset('public/images/like-ico.png')}}";

		           	 		$('#commt-section-media').prepend('<div class="usercomment-col" ><div class="usercomment-pic"><img src="'+imgsrc+'" alt="" id="user-reply-image"></div><div class="usercomment-content"> <div class="usercomment-name" ><b id="user-reply-name">'+data.name+'</b> <span id="user-reply-time">'+data.time+'</span></div><div class="usercomment-text">'+str+'<p>'+title+'</p></div><div class="usercomment-btns"> <a href="javascript:void" onclick="likecomment(\''+data.comment_id+'\',\''+data.post_id+'\',\''+data.community_id+'\',\''+1+'\')" id="like-comm-id'+data.comment_id+'"><img src="'+unlikeimg+'" alt="" ><span id="total-count-unlike'+data.comment_id+'"></span></a><a href="javascript:void" onclick="likecomment(\''+data.comment_id+'\',\''+data.post_id+'\',\''+data.community_id+'\',\''+0+'\')" id="unlike-comm-id'+data.comment_id+'" style="display: none;" ><img src="'+likeimg+'" alt="" style="width:20px;height:20px;"><span id="total-count-like'+data.comment_id+'"></span></a> <a href="javascript:void" onclick="replysec(\''+data.comment_id+'\')">Reply</a> <a href="javascript:void" onclick="report(\''+data.comment_id+'\',\''+data.community_id+'\',\''+data.post_id+'\')">Report</a> </div><div class="editor-c" id="reply-sec'+data.comment_id+'" style="margin-top: 15px;display: none;"> <textarea class="form-control full-featured-non-premium" name="comment" id="comment-reply-sec'+data.comment_id+'"></textarea> <span id="words-max" style="margin-top: 5px;color: red;">Maximum words 400</span><button class="common-btn" id="spin-reply-btn'+data.comment_id+'" style="display: none;float: right;margin-top: 10px;"> <span class="spinner-border spinner-border-sm"></span></button> <button type="button" class="common-btn" id="reply-btn'+data.comment_id+'" style="float: right;margin-top: 10px;" onclick="postreply(\''+data.comment_id+'\',\''+data.post_id+'\',\''+data.community_id+'\')">Post</button> </div></div></div><div id="user-reply-section'+data.comment_id+'" class="display-comment"></div>');

		           	 	// $('#contentss').html(data.title);

		           	 	

		           	 	// $('#username').html(data.name);

		           	 }else if(data==2)

		           	 {

		           	 	$('#commac').html('File size too large to upload');

			            $('#commac').css('color','red');

		           	 }

		           }

		       });

		}else

		{

			$('#commac').html('Enter Your Comments First');

			$('#commac').css('color','red');

			return false;

		}

		

	});

</script>

<script type="text/javascript">

	 $(".addmorespec").hide();

var count = 0;

$("#addspec").on('click',function(){

// $('.addmorespec:eq('+count+')').show();	

$('#moreoption').append('<div class="poll-ques-opt form-group" ><input class="form-control options" name="option[]" value="" placeholder="Option Text" type="text"><span class="remove" style="color:red;">Remove</span></div>');	

count++;	

});

$('#moreoption').on('click','.remove',function() {

    $(this).parent().remove();

});

</script>

<script type="text/javascript">

	$("#invitebtn").on('click',function(e)

	{

		

	    e.preventDefault();

	    if($('#first_name').val() != '')

	    {

	    	$('#firstname').hide();

	    }else

	    {

	    	$('#firstname').html('This field is required');

	    	$('#firstname').css('color','red');

	    } 

	    if($('#last_name').val() != '')

	    {

	    	$('#lastname').hide();

	    }else

	    {

	    	$('#lastname').html('This field is required');

	    	$('#lastname').css('color','red');

	    }  

	    if($('#email').val() != '')

	    {

	    	$('#emailinvite').hide();

	    }else

	    {

	    	$('#emailinvite').html('This field is required');

	    	$('#emailinvite').css('color','red');

	    }    

	    if(($('#first_name').val() != '') && ($('#last_name').val()!='') && ($('#email').val()!=''))

	    {

	        $('#inviteform').submit();

		}else

		{

			return false;

		}



		

	});



	$("#changepbtn").on('click',function(e)

	{

		

	    e.preventDefault();



 		if($('#oldpass').val() != '')

	    {

	    	$('#oldpasserrc').hide();

	    }else

	    {

	    	$('#oldpasserrc').html('Old Password is required');

	    	$('#oldpasserrc').css('color','red');

	    } 

	    if($('#pass').val() != '')

	    {

	    	

	    	$('#passerr').hide();

	    }else

	    {

	    	$('#passerr').html('Password is required');

	    	$('#passerr').css('color','red');

	    } 

	    if($('#confpass').val() != '')

	    {

	    	$('#confrmpasserr').hide();

	    }else

	    {

	    	$('#confrmpasserr').html('Confirm Password is required');

	    	$('#confrmpasserr').css('color','red');

	    }  

	        

	    if(($('#oldpass').val()!='') && ($('#pass').val() != '') && ($('#confpass').val()!=''))

	    {

	    	var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;

						if($('#pass').val().match(paswd)) 

						{ 

							$('#passerrc').hide();

						}

						else

						{ 	

						$('#passerrc').html('Password should contain at least one numeric digit and a special character and length between 7 to 15 characters');

						$('#passerrc').css('color','red');

						return false;

						} 

	    	if($('#pass').val()!=$('#confpass').val())

	    	{

	        swal('Password and Confirm Password not matched');

	        return false;

	      }else

	    	{

	    		$('#changepassform').submit();

	    	}

		}else

		{

			return false;

		}





		

	});



$("#changeuserpbtn").on('click',function(e)

	{

		

	    e.preventDefault();



 		

	    if($('#pass').val() != '')

	    {

	    	

	    	$('#passerr').hide();

	    }else

	    {

	    	$('#passerr').html('Password is required');

	    	$('#passerr').css('color','red');

	    } 

	    if($('#confpass').val() != '')

	    {

	    	$('#confrmpasserr').hide();

	    }else

	    {

	    	$('#confrmpasserr').html('Confirm Password is required');

	    	$('#confrmpasserr').css('color','red');

	    }  

	        

	    if(($('#pass').val() != '') && ($('#confpass').val()!=''))

	    {

	    	var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;

						if($('#pass').val().match(paswd)) 

						{ 

							$('#passerrc').hide();

						}

						else

						{ 

						$('#passerrc').html('Password should contain at least one numeric digit and a special character and length between 7 to 15 characters');

						$('#passerrc').css('color','red');

						return false;

						} 

	    	if($('#pass').val()!=$('#confpass').val())

	    	{

	        swal('Password and Confirm Password not matched');

	        return false;

	      }else

	    	{

	    		$('#changepassform').submit();

	    	}

		}else

		{

			return false;

		}





		

	});





</script>

<script type="text/javascript">

	$("#pollbtn").on('click',function(e)

	{

		

	    e.preventDefault();

	    

	    if($('#questiontxt').val() != '')

	    {

	    	$('#quetext').hide();

	    }else

	    {

	    	$('#quetext').show();

	    	$('#quetext').html('This field is required');

	    	$('#quetext').css('color','red');

	    }  

	    if($('.options').val() != '')

	    {

	    	$('#optionsreq').hide();

	    }else

	    {

	    	$('#optionsreq').html('This field is required');

	    	$('#optionsreq').css('color','red');

	    }    

	    if(($('#questiontxt').val()!='') && ($('.options').val()!=''))

	    {

	        $('#pollform').submit();

		}else

		{

			return false;

		}



		

	});

</script>

<script type="text/javascript">

	function pollvotes(pollid,type) 

	{

		

	    if(type=='radio')

		{

			// var votes=$('#pollm'+i).val();

			var votes=$('input[name="poll"]:checked').val();

		}else if(type=='checkbox')

		{

			var votes = $("input[name='pollmnew[]']:checked")

              .map(function(){return $(this).val();}).get();   

		}



		$.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('poll.month.votes')}}",

	            type: 'POST', 

		         data: {pollid:pollid,type:type,votes:votes},

		         success: function( data ) 

		           {

		           	$('#subpoll').hide();

		           	

		           	 if(data.status=='true')

		           	 {

		           	 	$('#totalvote').html(data.votes);

		           	 	swal('Poll submitted successfully');

		           	 }else if(data==2) 

		           	 {

		           	 	if(type=='radio')

						{

							$('input[name="poll"]').prop('checked', false);

						}else if(type=='checkbox')

						{

							$("input[name='pollmnew[]']").prop('checked', false);

						}

		           	 	$('#login-modal').modal();

		           	 	

		           	 }

		           	 

		           }

		       });	

	}

</script>

<script type="text/javascript">

	function unlikepost(post)

	{



		postid= post;

		like=1;

	   

			 $.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('user.post.likes')}}",

	            type: 'POST', 

		         data: {postid:postid,like:like},

		         success: function( data ) 

		           {

		           	 

		           	  if(data.status==1)

		           	  {			

           	  	     

           	  	    if(data.like==0)

           	  	    {

           	  	    	

           	  	    	$('#likediv'+post).show();

           	  	    	$('#double'+post).html(); 

           	  	    	$('#single'+post).html();  

           	  	      $('#unlikediv'+post).hide();	

           	  	    	

           	  	    }else if(data.like==1)

           	  	    {

           	  	    	

           	  	    	$('#likediv'+post).show( ); 

           	  	    	$('#single'+post).html(data.like+' Like');  

           	  	    $('#unlikediv'+post).hide();

           	  	    }else{

           	  	    

           	  	    	$('#likediv'+post).show();

           	  	    	$('#double'+post).html(data.like+' Likes');   

           	  	    $('#unlikediv'+post).hide();	

           	  	    }   

		           	  }else if(data==2)

		           	  {

		           	  	$('#login-modal').modal();

		           	  	

		           	  }

		           }

		       });

		

	}

	function likepost(post)

	{



		postid= post;

		like=0;

	    

			 $.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('user.post.likes')}}",

	            type: 'POST', 

		         data: {postid:postid,like:like},

		         success: function( data ) 

		           {

		           	 

		           	  if(data.status==1)

		           	  {

			           	  if(data.like==0)

	           	  	      {

	           	  	    	

	           	  	    	$('#likediv'+post).hide();

		           	  	    	$('#unlikediv'+post).show();  

		           	  	      $('#doubleun'+post).html();

	           	  	    	$('#singleun'+post).html();

	           	  	      }

		           	  	   else if(data.like==1)

		           	  	    {

		           	  	    	$('#likediv'+post).hide();

		           	  	    	$('#unlikediv'+post).show(); 

		           	  	    	$('#singleun'+post).html(data.like+' Like'); 

		           	  	      

		           	  	    }else{

		           	  	    	

		           	  	    	$('#likediv'+post).hide();

		           	  	    	$var=' Likes';		           	  	    	

		           	  	    	$('#unlikediv'+post).show();  

		           	  	      $('#doubleun'+post).html(data.like+' Likes');

		           	  	    }    

		           	  }else if(data==2)

		           	  {

		           	  	$('#login-modal').modal();

		           	  	// swal('You have to login first');

		           	  }

		           }

		       });

		

	}

</script>

<script type="text/javascript">

	function myFunction() {

  var x = document.getElementById("passlogin");

  if (x.type === "password") {

    x.type = "text";

  } else {

    x.type = "password";

  }

}

function showpass() {

  var x = document.getElementById("pass");

  var y = document.getElementById("confpass");

  if (x.type === "password" && y.type === "password") {

    x.type = "text";

    y.type = "text";

  } else {

    x.type = "password";

    y.type = "password";

  }

}

function checkpasssignup() {

  var x = document.getElementById("spassword");

  var y = document.getElementById("scpassword");

  if (x.type === "password" && y.type === "password") {

    x.type = "text";

    y.type = "text";

  } else {

    x.type = "password";

    y.type = "password";

  }

}

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

	function CheckPassword(inputtxt) 

{ 

	

var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;

if(inputtxt.match(paswd)) 

{ 

	// alert('right');

	return false;

}

else

{ 

	// alert('wrong');

$('#passcheck').html('Password should contain at least one numeric digit and a special character and length between 7 to 15 characters');

$('#passcheck').css('color','red');

return false;

}

}  

</script>

<script type="text/javascript">

	function join(comm,status)

	{



		 $.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('join.community')}}",

	            type: 'POST', 

		         data: {commid:comm,status:status},

		         success: function( data ) 

		           {

		           	 

		           	 if(status==1 && data.status==1)

		           	 {

		           	 	if(data.total==1)

		           	 	{

		           	 		$('#totalmem'+comm).html(data.total+' Member');

		           	 	}else

		           	 	{

		           	 		$('#totalmem'+comm).html(data.total+' Members');

		           	 	}

		           	 	

		           	 	$('#leaveid'+comm).show();

		           	 	$('#join-community').show();

		           	 	$('#join'+comm).hide();

		           	 	$('#joinnew'+comm).hide();

		           	 	$('#join-community').delay(5000).fadeOut();

		           	 }else if(status==0)

		           	 {

		           	 	if(data.total==1)

		           	 	{

		           	 		$('#totalmem'+comm).html(data.total+' Member');

		           	 	}else

		           	 	{

		           	 		$('#totalmem'+comm).html(data.total+' Members');

		           	 	}

		           	 	$('#leaveid'+comm).hide();

		           	 	$('#join'+comm).show();

		           	 	$('#leaveidnew'+comm).hide();

		           	 	$('#left-community').show();

		           	 	$('#left-community').delay(5000).fadeOut();

		           	 }else if(data==2)

		           	 {

		           	 	$('#login-modal').modal();

		           	 }

		           }

		       });

	}

</script>

<script type="text/javascript">

	function votes(postid,community,type) 

	{

		if(type=='radio')

		{

			var votes=$("input[name='pollvote"+postid+"']:checked").val();

             

		}else if(type=='checkbox')

		{

			votes = $("input[name='pollnew"+postid+"[]']:checked")

              .map(function(){return $(this).val();}).get();

		}

		

		if(votes=='' || typeof votes === "undefined")

		{

			swal('Please select an option');

			return false;

		}



		$.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('poll.votes')}}",

	            type: 'POST', 

		         data: {commid:community,postid:postid,type:type,votes:votes},

		         success: function( data ) 

		           {

		           	$('#subpollvote').hide();

		           	swal('Poll submitted successfully');

		           	 if(data.status=='true')

		           	 {

		           	 	$('#uservote'+postid).html(data.votes);

		           	 }else if(data==2) 

		           	 {

		           	 	if(type=='radio')

						{

							$("input[name='poll']").prop('checked', false);

						}else if(type=='checkbox')

						{

							$("input[name='pollnew[]']").prop('checked', false);

						}

		           	 	$('#login-modal').modal();

		           	 }

		           	 

		           }

		       });



	}

</script>

<script type="text/javascript">

	function hidepost(postid,status,type='')

	 {

	 	

		$.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('hide.post')}}",

	            type: 'POST', 

		         data: {postid:postid,status:status},

		         success: function( data ) 

		           {

		           	 if(data.status=='true')

		           	 {

		           	 	if(status==1)

		           	 	{

			           	 	swal("hide Post!", "Your post hidden successfully. you can unhide this anytime", "success");

			           	 	$('#hide'+postid).hide();

			           	 	if(type=='comment')

			           	 	{

			           	 		setTimeout(function(){

								   window.location.reload(1);

								}, 5000);

			           	 	}

		           	 	}else if(status==0)

		           	 	{

		           	 		swal("Unhide Post!", "Now Your post has been visible.", "success");

		           	 		if(type=='comment')

			           	 	{

			           	 		setTimeout(function(){

								   window.location.reload(1);

								}, 5000);

			           	 	}

		           	 	}

		           	 }else if(data.status=='false')  

		           	 {

		           	 	$('#login-modal').modal();

		           	 }

		           	 

		           }

		       });

	}



	function deletepost(postid)

	 {

	 	

	 	// if (confirm(swal("Are you sure you want to delete this post?"))) {

    	if( !confirm('Are you sure you want to delete this post?')) 

    	{

    	}else

    	{

		    $.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('delete.post')}}",

	            type: 'POST', 

		         data: {postid:postid},

		         success: function( data ) 

		           {

		           	 if(data.status=='true')

		           	 {

		           	 	swal("Deleted!", "Your post has been deleted.", "success");

		           	 	$('#delete'+postid).hide();

		           	 	$('#hide'+postid).hide();

		           	 	$('#user-comment').hide();

		           	 	$('#no-comment').show();

		           	 }else if(data.status=='false')  

		           	 {

		           	 	$('#login-modal').modal();

		           	 }

		           	 

		           }

		       });

    	}

		

		

		}

		

</script>

<script type="text/javascript">

	$("#commbtn").on('click',function(e)

	{

		var searchname=$('#searchname').val();

	    e.preventDefault();

	    $.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('search.news')}}",

	            type: 'POST', 

		         data: {type:'post',name:searchname},

		         success: function( data ) 

		           {



		           	 if(data.community!='0')

		           	 {

		           	 	$('#communtydiv').show();

					    $('#postdiv').hide();

					    $('#nodatadiv').hide();

					    $('#postbtn').removeClass('accounts-active');

					    $('#commbtn').addClass('accounts-active');

		           	 }else{

		           	 	$('#postdiv').hide();

		           	 	$('#nodatadiv').show();

		           	 	$('#noresdiv').hide();

					    $('#postbtn').removeClass('accounts-active');

					    $('#commbtn').addClass('accounts-active');

		           	 }





		           	 

		           }

		       });

	    

	});



	$("#postbtn").on('click',function(e)

	{

		var searchname=$('#searchname').val();



	    e.preventDefault();

	    $.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('search.news')}}",

	            type: 'POST', 

		         data: {type:'community',name:searchname},

		         success: function( data ) 

		           {

		           	 if(data.post!='0')

		           	 {

		           	 	$('#communtydiv').hide();

					    $('#postdiv').show();

					    $('#nodatadiv').hide();

					    $('#commbtn').removeClass('accounts-active');

					    $('#postbtn').addClass('accounts-active');

		           	 }else{

		           	 	$('#nodatadiv').show();

		           	 	$('#communtydiv').hide();

		           	 	$('#noresdiv').hide();

					    $('#commbtn').removeClass('accounts-active');

					    $('#postbtn').addClass('accounts-active');

		           	 }

		           	 

		           }

		       });

	    

	});



	function report(postid,communityid="",commentid="")

	 {

	 	$('#spamr').prop('checked', false);

	 	$('#hater').prop('checked', false);

	 	$('#interestedr').prop('checked', false);

	 	$('#misinformationr').prop('checked', false);

	 	$('#likeitr').prop('checked', false);

	 	$('#fraudr').prop('checked', false);

	 	$('#harassmentr').prop('checked', false);

	 	$('#voilencer').prop('checked', false);

	 	$.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('report')}}",

	            type: 'POST', 

		         data: {postid:postid},

		         success: function( data ) 

		           {

		           	 if(data.status=='true')

		           	 {

		           	 	console.log();

		           	 	$('#report-modal').modal();

		                $('#postid').val(postid);

		                $('#comment-id').val(postid);

		                $('#community-id').val(communityid);

		                $('#post-id').val(commentid);

		           	 }else if(data.status=='false'){

		           	 	$('#login-modal').modal();

		           	 }

		           	 

		           }

		       });

		

	}



	function remove(val) 

	{



		$('#reportbtn').prop("disabled", false);

		$('#report-comment-btn').prop("disabled", false);

	}



	$("#reportbtn").on('click',function(e)

	{

		var postid=$('#postid').val();

		var report=$('input[name="report"]:checked').val();

		if(report=='')

		{

			$('#reporterr').html('Please select an option');

			$('#reporterr').css('color','red');

		}

	    e.preventDefault();

	    $.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('report.post')}}",

	            type: 'POST', 

		         data: {postid:postid,report:report},

		         success: function( data ) 

		           {

		           	 if(data.status=='true')

		           	 {

		           	 	

		           	 	$('#report-modal').modal('hide');

		           	 	

		           	 	$('#thanks-modal').modal();

		           	 }else if(data.status=='false'){

		           	 	$('#login-modal').modal();

		           	 }

		           	 

		           }

		       });

	    

	});



	$("#thanksbtn").on('click',function(e)

	{

		$('#thanks-modal').modal('hide');

	});



</script>

<script type="text/javascript">

	function usercomments(postid) 

	{

		   $.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('report.post')}}",

	            type: 'POST', 

		         data: {postid:postid,report:report},

		         success: function( data ) 

		           {

		           	 if(data.status=='true')

		           	 {

		           	 	$('#report-modal').modal('hide');

		           	 	$('#thanks-modal').modal();

		           	 }else if(data.status=='false'){

		           	 	$('#login-modal').modal();

		           	 }

		           	 

		           }

		       });

	}

</script>

<!-- <script src="https://momentjs.com/downloads/moment.min.js"></script> -->

<script type="text/javascript">

	function sortcomments(postid,type) 

	{

		$.ajax({

	           headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('sort.comments')}}",

	            type: 'POST', 

		         data: {postid:postid,type:type},

		         success: function( data ) 

		           {

		           	 if(data.total!='0')

		           	 {

		           	 	$('.usercomment-col').hide();



		           	 	$.each(data.comment, function (key, val) {

		           	 		let date = moment(val.created_at, "YYYY-MM-DD h:m:ia");

		           	 		var todaytime=$('#datenew').val();

								posttime=date.fromNow();

								var str='';

		           	 		if(val.media!=null)

		           	 		{

		           	 			var media=val.media;

				           	 		console.log(val);

				           	 	var $extension=media.replace(/^.*\./, '');

				           	 	if($extension=='jpg' || $extension=='jpeg' || $extension=='png')

				           	 	{

				           	 		var str='<img src="{{asset("public/comment")}}'+'/'+''+val.media+'"  style="width:200px;height:100px;">';

				           	 	}else if($extension=='mp4')

				           	 	{

				           	 		var str='<video width="320" height="240" controls ><source src="{{asset("public/comment")}}'+'/'+''+val.media+'" type="video/mp4"></video>';

				           	 	}

				           	 	else if($extension=='ogg')

				           	 	{

				           	 		var str='<audio style="width:100%;text-align: center;" controls ><source src="{{asset("public/comment")}}'+'/'+''+val.media+'" type="audio/ogg"></audio>';

				           	 	}

				           	 	

				           	 	console.log($extension);

		           	 		}

		           	 	if(type=='alpha' || type=='text')

		           	 	{

		           	 		$('#commt-section').append('<div class="usercomment-col"><div class="usercomment-pic"><img src="'+(val.image?'{{asset("public/user/images/")}}'+'/'+''+val.image+'':'{{asset("public/images/user.png")}}')+'" alt="" ></div><div class="usercomment-content"> <div class="usercomment-name" ><span >'+val.name+'</span> <span >'+posttime+'</span></div><div class="usercomment-text" >'+(val.comment!=null?val.comment:'')+' </div></div></div></div>');

		           	 	}else if(type=='video')

		           	 	{

		           	 		$('#commt-section').append('<div class="usercomment-col"><div class="usercomment-pic"><img src="'+(val.image?'{{asset("public/user/images/")}}'+'/'+''+val.image+'':'{{asset("public/images/user.png")}}')+'" alt="" ></div><div class="usercomment-content"> <div class="usercomment-name" ><span >'+val.name+'</span> <span >'+posttime+'</span></div><div class="usercomment-text" >'+(val.media!=null?str:'')+' </div></div></div></div>');

		           	 	}else if(type=='video_text')	

		           	 	{

		           	 		$('#commt-section').append('<div class="usercomment-col"><div class="usercomment-pic"><img src="'+(val.image?'{{asset("public/user/images/")}}'+'/'+''+val.image+'':'{{asset("public/images/user.png")}}')+'" alt="" ></div><div class="usercomment-content"> <div class="usercomment-name" ><span >'+val.name+'</span> <span >'+posttime+'</span></div><div class="usercomment-text" >'+(val.media!=null?str:'')+''+(val.title!=null?'<p>'+val.title+'</p>':'')+' </div></div></div></div>');

		           	 	}

		           	 	

		           	 	});

		           	 }

		           	 else if(data.total=='0')

		           	 {

		           	 	$('.usercomment-col').hide();

		           	 	$('#commt-section').append('<div class="usercomment-col"><p>No result found</p></div>');

		           	 }

		           	 

		           }

		       });

	}

</script>



<script type="text/javascript">

	function commentreport() 

	{

		var postid=$('#comment-id').val();

		var commentid=$('#post-id').val();

		var communityid=$('#community-id').val();

		var commentreport=$('input[name="report-comment"]:checked').val();

		

	    $.ajax({

	    		 headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	    	    type: 'POST', 

	            url: "{{route('user.comment.report')}}", 

		         data: {comment_id:postid,post_id:commentid,community_id:communityid,comment_report:commentreport},

		         success: function( data ) 

		           {

		           	console.log(data);

		           	 if(data.status=='true')

		           	 {

		           	 	$('input[name="report-comment"]').removeAttr("checked");

		           	 	$('#report-modal').modal('hide');

		           	 	$('#thanks-modal').modal();

		           	 }

		           	 

		           },

                   error: function(jqXHR, textStatus, errorThrown) { console.log(errorThrown); }

		       });

	}

		

	    

	function replysec(commentid,i="") 

	{



		<?php if(empty(\Session::get('user')))

		{?>

			$('#login-modal').modal();

		<?php }else{ ?>

			tinymce.activeEditor.setContent('');

			tinymce.init({

    

  		selector: 'textarea.full-featured-non-premium',

  		setup: function (editor) {

        editor.on('change', function () {

        	

            editor.save();

        });

    },

  plugins: 'visualblocks visualchars fullscreen image link media imagetools emoticons wordcount',

  imagetools_cors_hosts: ['picsum.photos'],

  menubar:false,

    statusbar: false,

    branding:false,

    draggable_modal: true,

  toolbar: 'bold italic underline strikethrough |fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify  |  numlist bullist | forecolor backcolor removeformat| emoticons link insertfile',

  }); 

			$('#reply-btn'+commentid).show();

		    $('#reply-sec'+commentid).show();

		<?php } ?>

		}



		function replycommsec(commentid,i) 

	    {

		<?php if(empty(\Session::get('user')))

		{?>

			$('#login-modal').modal();

		<?php }else{ ?>

			tinymce.activeEditor.setContent('');

		    $('#comment-reply-sec'+commentid).show();

		<?php } ?>

		}



	function postreply(commentid,postid,communityid,i="",status="")

	{

		tinyMCE.triggerSave();

		

		var reply=$('#comment-reply-sec'+commentid).val();

		var text=$(reply).text().length;

        if(text>2500)

        {

        	swal('words limit has been exceed');

        	return false;

        }

		$('#reply-btn'+commentid).hide();

		$('#spin-reply-btn'+commentid).show();

		setTimeout(function () {

                 }, 20000);

		 $.ajax({

	    		 headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	    	    type: 'POST', 

	            url: "{{route('reply.add')}}", 

		         data: {comment_id:commentid,post_id:postid,community_id:communityid,comment:reply},

		         success: function( data ) 

		           {

		           	$('#reply-btn'+commentid).hide();

		            $('#spin-reply-btn'+commentid).hide();

		            $('#reply-sec'+commentid).hide();

		           	console.log(commentid);



		           	 if(data.status=='true')

		           	 {

		           	 	if(data.image==null)

		           	 	{

		           	 		var imgsrc="{{asset('public/images/user.png')}}";

		           	 		

		           	 	}else

		           	 	{

		           	 		var imgsrc="{{asset('public/user/images')}}"+"/"+data.image;

		           	 		

		           	 	}

		           	 	unlikeimg="{{asset('public/images/like-ico.png')}}";

		           	 	likeimg="{{asset('public/images/like.png')}}";

		       				

                        var count = 0;

                        

                        $('#user-reply-section'+commentid+'').prepend('<div class="usercomment-col display-comment" ><div class="usercomment-pic"><img src="'+imgsrc+'" alt="" id="user-reply-image"></div><div class="usercomment-content"> <div class="usercomment-name" ><b id="user-reply-name">'+data.name+'</b> <span id="user-reply-time">'+data.time+'</span></div><div class="usercomment-text"><p id="user-comment-reply">'+data.comment+'</p></div><div class="usercomment-btns"> <a href="javascript:void" onclick="likecomment(\''+data.comment_id+'\',\''+data.post_id+'\',\''+data.community_id+'\',\''+1+'\')" id="like-comm-id'+data.comment_id+'"><img src="'+unlikeimg+'" alt="" ><span id="total-count-unlike'+data.comment_id+'"></span></a><a href="javascript:void" onclick="likecomment(\''+data.comment_id+'\',\''+data.post_id+'\',\''+data.community_id+'\',\''+0+'\')" id="unlike-comm-id'+data.comment_id+'" style="display: none;" ><img src="'+likeimg+'" alt="" style="width:20px;height:20px;"><span id="total-count-like'+data.comment_id+'"></span></a> <a href="javascript:void" onclick="replysec(\''+data.comment_id+'\')">Reply</a> <a href="javascript:void" onclick="report(\''+data.comment_id+'\',\''+data.community_id+'\',\''+data.post_id+'\')">Report</a> </div><div class="editor-c" id="reply-sec'+data.comment_id+'" style="margin-top: 15px;display: none;"> <textarea class="form-control full-featured-non-premium" name="comment" id="comment-reply-sec'+data.comment_id+'"></textarea> <span id="" style="margin-top: 5px;color: red;">Maximum words 400</span><button class="common-btn" id="spin-reply-btn'+data.comment_id+'" style="display: none;float: right;margin-top: 10px;"> <span class="spinner-border spinner-border-sm"></span></button> <button type="button" class="common-btn" id="reply-btn'+data.comment_id+'" style="float: right;margin-top: 10px;" onclick="postreply(\''+data.comment_id+'\',\''+data.post_id+'\',\''+data.community_id+'\')">Post</button> </div></div></div><div id="user-reply-section'+data.comment_id+'" class="display-comment"></div>');

		           	 	

			           	 	

		           	 	    

		           	 	

		           	 }else if(data.status=='false')

		           	 {

		           	 	$('#login-modal').modal();

		           	 }

		           	 

		           },

                   error: function(jqXHR, textStatus, errorThrown) { console.log(errorThrown); }

		       });

	}

		

</script>

<script type="text/javascript">

	function communitydata()

	{

		var community=$('#community').val();

		$('#other-community').empty();

		$.ajax({

	    		 headers: {

                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	    	    type: 'POST', 

	            url: "{{route('community.search')}}", 

		         data: {community:community},

		         success: function( data ) 

		           {

		           	$('#my-community').hide();

		           	$('#other-community').show();

		           	console.log(data.community.title);

		           	if(data.total==1)

		           	{

		           		var totalmem=data.total+' Member';

		           	}else

		           	{

		           		var totalmem=data.total+' Members';

		           	}

		           	if(data.status==1)

		           	{

		           	var community_image="{{asset('public/community')}}"+"/"+data.community.image;

		           	var comm_url="{{url('community')}}"+"/"+data.community.title;

		           	if(data.user==0 || data.join==0)

		           	{

					  var button='<button type="button" class="comjoin-btn comjoin-btn-active" onclick="join(\''+data.community.id+'\',\''+1+'\')" id="joinnew'+data.community.id+'">Join</button>';

					 }else if(data.user==1){

					 if(data.join==0)

					 {

					 var button='<button type="button" class="comjoin-btn comjoin-btn-active" onclick="join(\''+data.community.id+'\',\''+1+'\')" id="joinnew'+data.community.id+'">Join</button>';

					 }else if(data.join==1)

					 {

					  var button='<button type="button" class="comjoin-btn" onclick="join(\''+data.community.id+'\',\''+0+'\')" id="leaveidnew'+data.community.id+'">Leave</button>';

					  }

					}

		           	 $('#other-community').append('<div class="row"><div class="col-md-4 col-xl-3 col-6"><div class="community-col"><a href="'+comm_url+'"><div class="community-fig"><img src="'+community_image+'" alt=""></div><div class="community-text"><h4 id="title">'+data.community.title+'</h4></a><p id="totalmem'+data.community.id+'}}">'+totalmem+'</p>'+button+'<button type="button" class="comjoin-btn comjoin-btn-active" onclick="join(\''+data.community.id+'\',\''+1+'\')" id="join'+data.community.id+'" style="display:none">Join</button><button type="button" class="comjoin-btn " onclick="join(\''+data.community.id+'\',\''+1+'\')" style="display:none" id="leaveid'+data.community.id+'">Leave</button></div></div></div>');

		           	

		           	}else

		           	{

		           		$('#other-community').append('<div class="row"><div class="col-md-4 col-xl-3 col-6"><div class="community-col">No Community Found</div></div></div>');

		           	}

		           },

                   error: function(jqXHR, textStatus, errorThrown) { console.log(errorThrown); }

		       });

	}

</script>

<script type="text/javascript">

	$("#message-id").on('click',function()

	{



	    if($('#user-subject').val() != '')

	    {

	    	$('#user-sub-error').hide();

	    }else

	    {

	    	$('#user-sub-error').html('Subject is required');

	    	$('#user-sub-error').css('color','red');

	    }

	    

	    if($('#user-message').val() != '')

	    {

	    	$('#user-msg-error').hide();

	    }else

	    {

	    	$('#user-msg-error').html('Message is required');

	    	$('#user-msg-error').css('color','red');

	    } 

	    

	    if(($('#user-subject').val() != '') && ($('#user-message').val() != ''))

	    {
		         var subject= $('#user-subject').val();
		         var message= $('#user-message').val();
		    	// $("#registerform").submit();
		    	// swal('Please Wait....');

				//get data
				var set_radio_valio_val = $("#set_radio_valio").val();
				
				var category_continent_val = $("#category_continent").val();
				var category_category_val = $("#category_category").val();
				
				var subcategory_continent_val = $("#subcategory_continent").val();
				var category_res_val = $("#category_res").val();
				var subcategory_name_val = $("#subcategory_name").val();
				subcategory_name_val1 = $("#subcategory_name_1").val();

		    	$.ajax({
	            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
	            url: "{{route('user.message')}}",
	            type: 'POST', 
		           data: {
					subject:subject, 
					message:message,
					set_radio_valio:set_radio_valio_val,
					category_continent:category_continent_val,
					category_category:category_category_val,
					subcategory_continent:subcategory_continent_val,
					category_res:category_res_val,
					subcategory_name:subcategory_name_val,
					subcategory_name1:subcategory_name_val1
				},
		           success: function( data ) 
		           {
		           	   if(data.status=='true')
		           	   {
		           	   	    $(".modal-body input").val("");
			                swal(data.msg);
			                $('#Message-modal').modal('toggle');
                            $('#Message-modal').modal('hide');
		           	   }else{
		           	   	   swal('Server Error try after some time!');
		           	   } 
		           }
		       });
	    } else
	    {
	    	return false;
	    }
    });



    function getnotification(notification_id,url)

    {

    	$.ajax({

	           headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

	            url: "{{route('user.notification')}}",

	            type: 'POST', 

		           data: {notification_id:notification_id},

		           success: function( data ) 

		           {

		           	   if(data.status=='true')

		           	   {

		           	   	   window.location.href=url;

		           	   }else{

		           	   	   swal('Server Error try after some time!');

		           	   } 

		           }

		       });

    }





</script>

<script type="text/javascript">

   $('#user-comment').keypress(function(e) {

   

   var maxchars = 400;

	    $(this).val($(this).val().substring(0, maxchars));

	    var tlength = $(this).val().length;

	    remain = maxchars - parseInt(tlength);

	    $('#comment-remaining').text(remain);

    });

</script>

<script type="text/javascript">

	var wordLen = 5,

		len; // Maximum word length

$('textarea').keydown(function(event) {	

	len = $('#postid').val().split(/[\s]+/);

	if (len.length > wordLen) { 

		if ( event.keyCode == 46 || event.keyCode == 8 ) {// Allow backspace and delete buttons

    } else if (event.keyCode < 48 || event.keyCode > 57 ) {//all other buttons

    	event.preventDefault();

    }

	}

	console.log(len.length + " words are typed out of an available " + wordLen);

	wordsLeft = (wordLen) - len.length;

	$('#postcontnt').html(wordsLeft+ ' words left');

	if(wordsLeft == 0) {

		$('#postcontnt').css({

			'background':'red'

		}).prepend('<i class="fa fa-exclamation-triangle"></i>');

	}

});

</script>



<script type="text/javascript">

	function openmedia(sel)

	 {

	 	// alert(sel);

	 	$('#postvideoamodalTitle').modal('show');



		if(sel=='video')

		{

			$('#modal-type').val('video');

			$('#videoElement').hide();

			$('#video-preview').hide();

			$('#image-post').hide();

			$('#video-post').show();

			$('#file-vdo').show();

			$('#file-img').hide();

			$('#image-snap').hide();

			$('#canvas').hide();

		}else if(sel=='image')

		{

			$('#modal-type').val('image');

			$('#flie-preview').hide();

			$('#videoElement').hide();

			$('#file-vdo').hide();

			$('#image-post').show();

			$('#video-post').hide();

			$('#file-img').show();

			$('#image-snap').hide();

			$('#canvas').hide();

			

		}

	}



	function opencamera(sel)

	 {

	 	var modaltype=$('#modal-type').val();

		if(modaltype=='video')

		{

			$('#videoElement').show();

			$('#file-vdo').hide();

			$('#video-open').show();

			$('#start-record').show();

			$('#image-post').hide();

			$('#video-post').show();

			$('#closevdomodal').hide();

			$('#file-img').hide();

			$('#file-vdo').hide();

		}else if(modaltype=='image')

		{

			$('#videoElement').show();

			$('#file-vdo').hide();

			$('#video-open').hide();

			$('#image-post').show();

			$('#video-post').hide();

			$('#file-img').hide();

			$('#file-vdo').hide();

			$('#image-snap').show();

		}

	}



	function opengallery(sel)

	 {

	 	var modaltype=$('#modal-type').val();

		if(modaltype=='video')

		{

			$('#videoElement').hide();

			$('#file-vdo').show();

			$('#video-open').hide();

			$('#image-post').hide();

			$('#video-post').show();

			$('#file-img').hide();

			$('#download-video').hide();

			$('#closevdomodal').show();

		}else if(modaltype=='image')

		{

			$('#videoElement').hide();

			$('#file-vdo').hide();

			$('#video-open').hide();

			$('#image-post').show();

			$('#closevdomodal').hide();

			$('#video-post').show();

			$('#file-img').show();

			$('#image-snap').hide();

			$('#canvas').hide();

		}

	}



	function previewimage(img)

	{

		$('#blah').hide();

		$('#videoid').hide();

		var filename = $("#file").val();

		var extension = filename.replace(/^.*\./, '');

		var postimage=img.files[0].size;

		var filesizeimg=filesize(postimage);

		var image=(postimage / (1024*1024)).toFixed(2);

		tinstotal = Math.round(image);

		

		if(tinstotal > '20')

		{

			alert('File size is too large it should be max 20 MB');

			return false;

		}

		$('#flie-preview').show();

		$('#blah').show();

		document.getElementById('flie-preview').src = window.URL.createObjectURL(img.files[0]);

		document.getElementById('blah').src = window.URL.createObjectURL(img.files[0]);

		var file = img.files[0];      

    var reader = new FileReader();

  reader.onloadend = function() {

    console.log('RESULT', reader.result)

    $('#camera-snap').val(reader.result);

    

  }

  

  reader.readAsDataURL(file);

  

}



function previewvideo(vdo)

	{

		$('#closevdomodal').show();

		$('#blah').hide();

		$('#videoid').hide();

		var filename = $("#vdofile").val();

		var extension = filename.replace(/^.*\./, '');

		var postimage=vdo.files[0].size;

		var filesizeimg=filesize(postimage);

		var image=(postimage / (1024*1024)).toFixed(2);

		tinstotal = Math.round(image);

		

		if(tinstotal > '20')

		{

			alert('File size is too large it should be max 20 MB');

			return false;

		}

		$('#video-preview').show();

		$('#videoid').show();

		document.getElementById('video-preview').src = window.URL.createObjectURL(vdo.files[0]);

		document.getElementById('videoid').src = window.URL.createObjectURL(vdo.files[0]);

		$('#closevdomodal').prop("disabled", false);

		var file = vdo.files[0];      

    var reader = new FileReader();

  reader.onloadend = function() {

    console.log('RESULT', reader.result)



    $('#camera-snap').val(reader.result);

//     // var daturlvdo=blobToDataURL(reader.result, function(dataurl){

//     // console.log(dataurl);

// });

    

  }



  reader.readAsDataURL(file);

  

}



  

</script>

<script type="text/javascript">

	'use strict'

var video=document.querySelector("#videoElement");

if(navigator.mediaDevices.getUserMedia){

navigator.mediaDevices.getUserMedia({video: true}).then(function(stream){video.srcObject=stream;}).catch(function(err0r){console.log("Something went wrong!");});}



function snapshot() {

         // Draws current image from the video element into the canvas

        video.drawImage(video, 0,0, canvas.width, canvas.height);

        if (navigator.getUserMedia) {

    navigator.getUserMedia({audio: true, video: true}, function(stream) {

    video.src = window.URL.createObjectURL(stream);

    }, errorCallback);

} else {

    video.src = 'somevideo.webm'; // fallback.

}

        

      }





let click_button = document.querySelector("#click-photo");

let canvas = document.querySelector("#canvas");

let camera_button = document.querySelector("#start-camera");

let cameravideo = document.querySelector("#video");

let start_button = document.querySelector("#start-record");

 // video=document.querySelector("#video");



let stop_button = document.querySelector("#stop-record");

let download_link = document.querySelector("#download-video");



click_button.addEventListener('click', function() {

$('#canvas').show();

   	canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

   	let image_data_url = canvas.toDataURL('image/jpeg');



   	// data url of the image

   	let image_url = document.querySelector("#canvas").toDataURL('image/jpeg');

   	$('#camera-snap').val(image_url);

});



let camera_stream = null;

let media_recorder = null;

let blobs_recorded = [];



camera_button.addEventListener('click', async function() {

    camera_stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });

  video.srcObject = camera_stream;

});



start_button.addEventListener('click', function() {

	$('#start-record').hide();

	$('#stop-record').show();

    // set MIME type of recording as video/webm

    media_recorder = new MediaRecorder(camera_stream, { mimeType: 'video/webm' });



    // event : new recorded video blob available 

    media_recorder.addEventListener('dataavailable', function(e) {

    	

    blobs_recorded.push(e.data);



    });



    // event : recording stopped & all blobs sent

    media_recorder.addEventListener('stop', function() {

      // create local object URL from the recorded video blobs

      let video_local = URL.createObjectURL(new Blob(blobs_recorded, { type: 'video/webm' }));

      let recording = new File(blobs_recorded, 'recording.webm', { type: 'video/webm' });

      console.log(recording);

      $('#video-snap').val(video_local);

      

      download_link.href = video_local;

    });



    // start recording with each recorded blob having 1 second video

    media_recorder.start(1000);

});



download_link.addEventListener('click', function() {

	$('#file-vdo').show();

	$('#video-open').hide();

	$('#videoElement').hide();

	});



stop_button.addEventListener('click', function() {

  media_recorder.stop(); 

  $('#stop-record').hide();

  $('#download-btn').show();

});





$('#closemodal').click(function() {

    $('#postvideoamodalTitle').modal('hide');

    $('#imgsec').show();

    var DataURL=dataURItoBlob($('#camera-snap').val());

    var objectURL = URL.createObjectURL(DataURL);

    $('#blah').show();

    $('#videoid').hide();

    $('#media-image-type').val('image');

    document.getElementById('blah').src = objectURL;

    // $('#media-modal-body').html("");

});

$('#closevdomodal').click(function() {



    $('#postvideoamodalTitle').modal('hide');

    $('#imgsec').show();

    var DataURL=($('#video-snap').val());

    console.log(DataURL);

    var objectURL = (DataURL);

    $('#videoid').show();

    $('#blah').hide();

    $('#media-video').hide();

    $('#media-image-type').val('video');

    document.getElementById('videoid').src = objectURL;

    // $('#media-modal-body').html("");

});



// function blobToDataURL(blob, callback) {

//     var a = new FileReader();

//     a.onload = function(e) {callback(e.target.result);}

//     a.readAsDataURL(blob);

// } 

function dataURItoBlob(dataURI) {

  // convert base64 to raw binary data held in a string

  // doesn't handle URLEncoded DataURIs - see SO answer #6850276 for code that does this

  var byteString = atob(dataURI.split(',')[1]);



  // separate out the mime component

  var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]



  // write the bytes of the string to an ArrayBuffer

  var ab = new ArrayBuffer(byteString.length);



  // create a view into the buffer

  var ia = new Uint8Array(ab);



  // set the bytes of the buffer to the correct values

  for (var i = 0; i < byteString.length; i++) {

      ia[i] = byteString.charCodeAt(i);

  }



  // write the ArrayBuffer to a blob, and you're done

  var blob = new Blob([ab], {type: mimeString});

  return blob;



}

</script>
  