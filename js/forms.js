
$( document ).ready(function() {
	$('.mobile-menu-icon').click(function(event) {
		event.preventDefault();
	    $( '.wide-nav' ).toggleClass( "mobile-nav-panel" );
	});
});




$( document ).ready(function() {
	var startColor = $('.color_picker_field input').val();
	$('.color_picker').css('background','#'+startColor);

	$('.color_picker_field input').colpick({
	layout:'rgbhex',
	submit:0,
	colorScheme:'light',
	onChange:function(hsb,hex,rgb,el,bySetColor) {
		$('.color_picker').css('background','#'+hex);
		$('.page-template-page-brand-edit .brand-cover-logo, .page-template-page-brand-details .brand-cover-logo').css('background','#'+hex);
		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		if(!bySetColor) $(el).val(hex);
	}

}).keyup(function(){
	$(this).colpickSetColor(this.value);
});
});


$( document ).ready(function() {
	$('li.color_picker').click(function(e) {

	   $('.color_picker_field input').focus()
	   $('.color_picker_field input').trigger('click');
	})
});





$(document).ready( function() {
	function readURL(input) {
    	if (input.files && input.files[0]) {
     	   var reader = new FileReader();

	        reader.onload = function (e) {
	            $('.card-image').attr('src', e.target.result);
	        }

        	reader.readAsDataURL(input.files[0]);
    	}
	}

    $(".upload .ginput_container input.large").change(function () {
        readURL(this);
	});
});




	var	card = $(".card-single-wrapper").height();

	$(".card-sidebar").attr('style','height: '+card+'px; overflow: scroll;');




	function center_image() {
		$( ".card-image" ).each(function() {
			var img = $(this);
			var imageWidth = img.width();
			var imageHeight = img.height();

			if(imageHeight > imageWidth)
			    $(this).attr('style',"height:100%;");
			else
			    $(this).attr('style',"width:100%;");

			 $(this).css({
		        left: ($(this).parent('.card-inner').width() - $(this).width())/2,
		        top: ($(this).parent('.card-inner').height() - $(this).height())/2
		    });
		});
	 }


	$(window).load( function() {
		center_image();
	});

	$(window).resize( function() {
		center_image();
	});

	$(".card-image").load( function() {
		center_image();
	});


$( document ).ready(function() {
	$('.username a').click(function(event) {
		event.preventDefault();
	    $(this).toggle();
	    $(this).parent().parent('.col').children('.email-toggle').toggle();
	    $(this).parent().parent('.col').children('.user-links').toggle();
	});
});

$( document ).ready(function() {
	$('.user-item img').click(function(event) {
		event.preventDefault();
	    $(this).parents('.user-item').find('.username a').toggle();
	    $(this).parents('.user-item').find('.user-links').toggle();
	    $(this).parents('.user-item').find('.email-toggle').toggle();
	});
});


$( document ).ready(function() {
	$('.cardfield').wrapAll( "<div class='cardfields' />");
});



$(document).ready( function() {
	$( ".gfield_list tr td:nth-child(1), .gfield_list tr td:nth-child(2), .gfield_list tr td:nth-child(3), .gfield_list tr td:nth-child(6)" ).after( '<td class="table-space"></td>' );
	$( ".gfield_list thead th:nth-child(1), .gfield_list thead th:nth-child(2), .gfield_list thead th:nth-child(3),.gfield_list thead th:nth-child(6)" ).after( '<td class="table-space"></td>' );
});





	function center_image_card() {
		$( ".card-link .main-img" ).each(function() {
			var img = $(this);
			var imageWidth = img.width();
			var imageHeight = img.height();

			if(imageHeight > imageWidth)
			    $(this).attr('style',"width:100%;");
			else
			    $(this).attr('style',"height:100%;");
		});
	 }


	$(document).ready( function() {
		center_image_card();
	});

	$(window).resize( function() {
		center_image_card();
	});

	$(".card-image").load( function() {
		center_image_card();
	});




$(document).ready( function() {
	$('.card-link').hover(function(){
		$(this).find( ".edit-icon" ).fadeToggle( "fast");
	});
});


$(document).ready( function() {
	$("a[rel*=leanModal]").leanModal({ top : 200, overlay : 0.4, closeButton: ".modal_close" });
});





$(document).ready( function() {
	$('.dashboard-main .bar-nav .toggle a').on('click', function(event){
		event.preventDefault;
		var category = $(this).text().toLowerCase();
		$( ".card-item" ).hide();
		$('.card-link.'+category).parents('.card-item').fadeIn();
		$('.menu-item').removeClass('current-menu-item');
		$(this).parents('.menu-item').addClass('current-menu-item');
	});
});


$(document).ready( function() {
	$('.dashboard-main .bar-nav .all a').on('click', function(event){
		event.preventDefault;
		$( ".card-item" ).fadeIn();
	});
});








		$(document).ready( function() {
			var cardHeight = $(".single-cards .card-single-wrapper .card-link-wrapper").outerHeight()+"px"

			$(".card-right").attr('style',"height:"+ cardHeight);

		});




$(document).ready(function () {

    $(document).keydown(function(e) {
        var url = false;
        if (e.which == 37) {  // Left arrow key code
            url = $('.nav-previous a').attr('href');
        }
        else if (e.which == 39) {  // Right arrow key code
            url = $('.nav-next a').attr('href');
        }
        if (url) {
            window.location = url;
        }
    });

});




  $(document).ready(function(){
    // Target your .container, .wrapper, .post, etc.
    $(".single-cards .card-link").fitVids();
  });



$(document).ready(function(){
	var id = $('article.type-cards').attr('id');
    $('.card-sidebar .cards-grid').find('#'+id).addClass('current-menu-item');
  });







$('button[type="submit"], input[type="submit"]').click(function() {
	$('#pmpro_processing_message').css( 'visibility', 'visible' );
});




$(document).ready(function() {
    $('#selecct_all').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.sub_checkbox').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
        }else{
            $('.sub_checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"
            });
        }
    });

});





$(document).ready(function() {
	$('.activity').css('display', 'none');
    $('a.activity-toggle').click(function( event ) {
  		event.preventDefault();
        $('.activity').slideToggle();
        $('.activity').css('display', 'block');
    });

});