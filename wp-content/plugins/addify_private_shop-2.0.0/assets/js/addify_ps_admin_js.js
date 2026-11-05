

function ps_image() { 

	var image = wp.media({ 
		title: 'Upload Image',
		// mutiple: true if you want to upload multiple files at once
		multiple: false
	}).open()
	.on('select', function(){
		// This will return the selected image from the Media Uploader, the result is an object
		var uploaded_image = image.state().get('selection').first();
		// We convert uploaded_image to a JSON object to make accessing it easier
		// Output to the console uploaded_image
		//console.log(uploaded_image);
		var image_url = uploaded_image.toJSON().url;
		// Let's assign the url value to the input field
		jQuery('#ps_image_url').val(image_url);
		jQuery('#imgdisplay').html("<img width='200' src='"+image_url+"'/>");
	});

	

}


function ps_video() { 

	var image = wp.media({ 
		title: 'Upload Video',
		// mutiple: true if you want to upload multiple files at once
		multiple: false
	}).open()
	.on('select', function(){
		// This will return the selected image from the Media Uploader, the result is an object
		var uploaded_image = image.state().get('selection').first();
		// We convert uploaded_image to a JSON object to make accessing it easier
		// Output to the console uploaded_image
		//console.log(uploaded_image);
		var image_url = uploaded_image.toJSON().url;
		// Let's assign the url value to the input field
		jQuery('#ps_video_url').val(image_url);
		jQuery('#videp-id').html("<source src='"+image_url+"' type='video/mp4' />");
	});

	

}

function getDefLogin(value) {

	if(value == 'default') {
		
		jQuery('.def_login').hide();
		jQuery('.cus_url_login').hide();
		
	} else if(value == 'custom') {
		jQuery('.def_login').show();
		jQuery('.cus_url_login').hide();
		
	} else if(value == 'custom_url') {

		jQuery('.def_login').hide();
		jQuery('.cus_url_login').show();

	} else if(value == 'addify_popup') {

		jQuery('.def_login').show();
		jQuery('.cus_url_login').hide();
	}
}


function showCoImg(value1) {

	var value3 = $('input[name=ps_default_login]:checked').val();

	if((value3 == 'custom' || value3 == 'addify_popup') && (value1 == 'colour')) {
		jQuery('.back_colour').show();
		jQuery('.back_image').hide();
		jQuery('.customvideo').hide();
		jQuery('.youtubevideo').hide();

		
	} else if((value3 == 'custom' || value3 == 'addify_popup') && (value1 == 'image')) {
		jQuery('.back_image').show();
		jQuery('.back_colour').hide();
		jQuery('.customvideo').hide();
		jQuery('.youtubevideo').hide();
		
	} else if((value3 == 'custom' || value3 == 'addify_popup') && (value1 == 'custom_video')) {
		jQuery('.back_image').hide();
		jQuery('.back_colour').hide();
		jQuery('.customvideo').show();
		jQuery('.youtubevideo').hide();
	} else if((value3 == 'custom' || value3 == 'addify_popup') && (value1 == 'youtube_video')) {

		jQuery('.back_image').hide();
		jQuery('.back_colour').hide();
		jQuery('.customvideo').hide();
		jQuery('.youtubevideo').show();

	} else {
		jQuery('.back_colour').hide();
		jQuery('.back_image').hide();
		jQuery('.customvideo').hide();
		jQuery('.youtubevideo').hide();
		
	}

}




jQuery(document).ready(function($) {
	var value3 = $('input[name=ps_default_login]:checked').val();
	if(value3 == 'default') {
		
		jQuery('.def_login').hide();
		jQuery('.cus_url_login').hide();
		
	} else if(value3 == 'custom') {
		jQuery('.def_login').show();
		jQuery('.cus_url_login').hide();
		
	} else if(value3 == 'custom_url') {

		jQuery('.def_login').hide();
		jQuery('.cus_url_login').show();

	} else if(value3 == 'addify_popup') {

		jQuery('.def_login').show();
		jQuery('.cus_url_login').hide();
	}
	
});

jQuery(document).ready(function() {
    jQuery('.js-example-basic-multiple-product').select2();
});

jQuery(function($) {
  $(".child").on("click",function() {
      $parent = $(this).prevAll(".parent");
      if ($(this).is(":checked")) $parent.prop("checked",true);
      else {
         var len = $(this).parent().find(".child:checked").length;
         $parent.prop("checked",len>0);
      }    
  });
  $(".parent").on("click",function() {
      $(this).parent().find(".child").prop("checked",this.checked);
  });
});

function getMode(value4) {

	if(value4 == 'selected_items') {
		jQuery('.ps_privatize_products').show();
	} else {
		jQuery('.ps_privatize_products').hide();
	}

}



jQuery(document).ready(function($) {
	var value5 = $("#ps_background :selected").val();
	var value3 = $('input[name=ps_default_login]:checked').val();

	if((value3 == 'custom' || value3 == 'addify_popup') && (value5 == 'colour')) {
		jQuery('.back_colour').show();
		jQuery('.back_image').hide();
		jQuery('.customvideo').hide();
		jQuery('.youtubevideo').hide();

		
	} else if((value3 == 'custom' || value3 == 'addify_popup') && (value5 == 'image')) {
		jQuery('.back_image').show();
		jQuery('.back_colour').hide();
		jQuery('.customvideo').hide();
		jQuery('.youtubevideo').hide();
		
	} else if((value3 == 'custom' || value3 == 'addify_popup') && (value5 == 'custom_video')) {
		jQuery('.back_image').hide();
		jQuery('.back_colour').hide();
		jQuery('.customvideo').show();
		jQuery('.youtubevideo').hide();

	} else if((value3 == 'custom' || value3 == 'addify_popup') && (value5 == 'youtube_video')) {

		jQuery('.back_image').hide();
		jQuery('.back_colour').hide();
		jQuery('.customvideo').hide();
		jQuery('.youtubevideo').show();

	} else {
		jQuery('.back_colour').hide();
		jQuery('.back_image').hide();
		jQuery('.customvideo').hide();
		jQuery('.youtubevideo').hide();
		
	}
});



jQuery(document).ready(function($) {
	var checked_val = $('input[name=ps_privatize]:checked').val();
	if(checked_val == 'selected_items') {
		jQuery('.ps_privatize_products').show();
	} else {
		jQuery('.ps_privatize_products').hide();
	}
});




function ps_logo() { 

	var image = wp.media({ 
		title: 'Upload Image',
		// mutiple: true if you want to upload multiple files at once
		multiple: false
	}).open()
	.on('select', function(){
		// This will return the selected image from the Media Uploader, the result is an object
		var uploaded_image = image.state().get('selection').first();
		// We convert uploaded_image to a JSON object to make accessing it easier
		// Output to the console uploaded_image
		//console.log(uploaded_image);
		var image_url = uploaded_image.toJSON().url;
		// Let's assign the url value to the input field
		jQuery('#ps_logo_url').val(image_url);
		jQuery('#logodisplay').html("<img width='200' src='"+image_url+"'/>");
	});

	

}




function getRedirectPage(value7) {

	if(value7 == 'customurl') {

		jQuery('.ps_customURL').show();

	} else {

		jQuery('.ps_customURL').hide();
	}

}


jQuery(document).ready(function($) {
	var value8 = $("#ps_redirect_login :selected").val();

	if(value8 == 'customurl') {

		jQuery('.ps_customURL').show();

	} else {

		jQuery('.ps_customURL').hide();
	}
});











