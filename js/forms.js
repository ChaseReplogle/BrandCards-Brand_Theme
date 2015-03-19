
$( document ).ready(function() {
	var startColor = $('.color_picker_field input').val();
	$('.color_picker').css('background','#'+startColor);

	$('.color_picker_field input').colpick({
	layout:'rgbhex',
	submit:0,
	colorScheme:'light',
	onChange:function(hsb,hex,rgb,el,bySetColor) {
		$('.color_picker').css('background','#'+hex);
		$('.brand-cover-logo').css('background','#'+hex);
		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		if(!bySetColor) $(el).val(hex);
	}

}).keyup(function(){
	$(this).colpickSetColor(this.value);
});
});





$(document).ready( function() {
	function readURL(input) {
    	if (input.files && input.files[0]) {
     	   var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#image').attr('src', e.target.result);
	        }

        	reader.readAsDataURL(input.files[0]);
    	}
	}

    $(".upload .ginput_container input.large").change(function () {
        readURL(this);
	});
});





$( document ).ready(function() {
$( "#image" ).each(function( i ) {
	var img = $("#image");
	var imageWidth = img.width();
	var imageHeight = img.height();

	if(imageHeight >imageWidth)
	    $("#image").attr('style',"height:100%;");
	else
	    $("#image").attr('style',"width:100%;");


	$( window ).load(function() {
	 $('#image').css({
	        left: ($(".card-inner").width() - $('#image').outerWidth())/2,
	        top: ($(".card-inner").height() - $('#image').outerHeight())/2
	    });
	 });

	$( window ).resize(function() {
	 $('#image').css({
	        left: ($(".card-inner").width() - $('#image').outerWidth())/2,
	        top: ($(".card-inner").height() - $('#image').outerHeight())/2
	    });
	 });

	$( '#image' ).load(function() {

	var img = $("#image");
	var imageWidth = img.width();
	var imageHeight = img.height();

	if(imageHeight >imageWidth)
	    $("#image").attr('style',"height:100%;");
	else
	    $("#image").attr('style',"width:100%;");

	 $('#image').css({
	        left: ($(".card-inner").width() - $('#image').outerWidth())/2,
	        top: ($(".card-inner").height() - $('#image').outerHeight())/2
	    });
	 });
});
});


$( document ).ready(function() {
	$('.username a').click(function(event) {
		event.preventDefault();
	    $(this).toggle();
	    $(this).closest('.col').children('.user-links').toggle();
	});
});

$( document ).ready(function() {
	$('.user-item img').click(function(event) {
		event.preventDefault();
	    $(this).parents('.user-item').find('.username a').toggle();
	    $(this).parents('.user-item').find('.user-links').toggle();
	});
});