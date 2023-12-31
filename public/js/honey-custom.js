$(".top-notify").click(function(){
$("#notification").toggle();
});
$(".addmorespec").hide();
var count = 0;
$("#addspec").on('click',function(){
$('.addmorespec:eq('+count+')').show();	
count++;	
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


$("#categories-slider").owlCarousel({
nav:true,
dots:false,
loop:true,
autoplay:true,
mouseDrag:true,
autoplayHoverPause:true,
navText : ["<span><i class='las la-arrow-left'></i></span>","<span><i class='las la-arrow-right'></i></span>"],
responsiveClass: true,
responsive: {
0: {
items: 1
},
600: {
items: 3,
margin:15	

},
700: {
items: 4,
loop: true,
margin:15
},
1100: {
items: 5,
loop: true,
margin:15
}		
}
});

$('.owl-carousel').owlCarousel({
loop: true,
responsiveClass: true,
responsive: {
  0: {
	items: 1,
	nav: true
  },
  600: {
	items: 3,
	nav: false
  },
  1000: {
	items: 3,
	nav: false,
	loop: true,
	margin:30
  }
}
});


jQuery(window).scroll(function(){ 
	var scroll = jQuery(window).scrollTop();
	if (scroll>=50){ 
		jQuery('header').addClass('fixed-nav');
	}
	else{
		jQuery('header').removeClass('fixed-nav');
	}
});

function checkRadioValue(val){
	if(val == "category"){
		//display continent dropdown and category name textbox
		$("#category_div").show();
		$("#subcategory_div").hide();
		$("#set_radio_valio").val("category");
	}else if(val == "subcategory"){
	    //display continent dropdown, category dropdown and sub category name textbox
		$("#category_div").hide();
		$("#subcategory_div").show();
		$("#set_radio_valio").val("subcategory");
	}
}

function displayCategoryContact() {
	$.ajax({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				 },
		url: "getcategoryresult",
		type: 'POST', 
		data: {continentId:$("#subcategory_continent").val()},
		success: function(data) {
					$("#subcategory_div_1").empty().html(data);
			}
		});
}