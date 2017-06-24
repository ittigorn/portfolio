<!--
THIS MODULE ENABLES THE PAGE TO ENLARGE PHOTO WHEN CLICKED

REQUIREMENTS:
- jQuery
- loading.gif (http://loading.io/ is a good place to start)
- Define the width and height of your loading.gif
- Also add a link to view_photo.css
- Make sure .fader is already hidden in global.scss

-->

<div class="fader view_photo_fader" style="background-color: #000000;"></div>
<div class="large_photo">
	<img class="loading" src="_images/loading.gif">
	<img class="photo" src="">
</div>

<script type="text/javascript">
	
	$(document).ready(function(){

		// DECLARING ADJUSTABLE VARIABLES
		var $loading_dimension = {
					"height" : 170, 
			        "width" : 170
				};
		var $effect_duration 	= 100;
		var $padding 			= .1; // padding for large_picture in percentage of 1

		// DECLARING VARIABLES
		var $win = {};

		// DECLARING FUNCTIONS

		function convert_thumb_src_to_large_photo_src($thumb_src) {

			var $large_photo_src 		= $thumb_src.split('/');
			var $length 				= $large_photo_src.length;

			$large_photo_src.splice(($length - 2), 1); // removes the element before the last one
			$large_photo_src 		= $large_photo_src.join("/");

			return $large_photo_src;

		} // end function

		function view_photo($this) {

			$win = {
					"height" : $(window).height(), 
			        "width" : $(window).width(), 
					"outerHeight" : $(window).outerHeight(), 
					"outerWidth" : $(window).outerWidth() 
				};

			var $large_photo_src = $($this).attr('src'); 

				// styling fader and loading.gif
				$(".view_photo_fader").css({
					"width" : "100%", 
					"height" : "100%", 
					"position" : "fixed", 
					"top" : "0" , 
					"left" : "0", 
					"opacity" : ".65", 
					"z-index" : "200"
				});

				$(".large_photo img.loading").css({
					"width" : ($loading_dimension.height + "px"), 
					"height" : ($loading_dimension.width + "px"), 
					"position" : "fixed", 
					"top" : (($win.height / 2) - ($loading_dimension.height / 2)) + "px" , 
					"left" : (($win.width / 2) - ($loading_dimension.width / 2)) + "px", 
					"opacity": "1" ,
					"z-index" : "300"
				});

				$(".view_photo_fader").fadeIn($effect_duration); 

				$.get($large_photo_src,function() {
					$(".large_photo img.photo").attr("src", $large_photo_src);
				});
		}// end function

		function hide_photo() {
			$(".large_photo img.loading").removeAttr('style');
			$(".view_photo_fader").fadeOut($effect_duration, function() {
				$(".large_photo img.photo").removeAttr("style");
			});
			$(".large_photo img.photo").fadeOut($effect_duration);
		}// end function

		function calculate_large_photo($dom_element) {
			
			$($dom_element).fadeIn($effect_duration);

			$($dom_element).css({
									"width" : "auto", 
									"height" : "auto"
								});

	        var $image = {
		        	"height" : $($dom_element).height(),
		        	"width" : $($dom_element).width()
	        	};

	        if (($win.height >= ($image.height + ($image.height * $padding))) && ($win.width >= ($image.width + ($image.width * $padding)))) {

		        $($dom_element).css({
					"width" : $image.width + "px", 
					"height" : $image.height + "px", 
					"position" : "fixed", 
					"top" : (($win.height / 2) - ($image.height / 2)) + "px", 
					"left" : (($win.width / 2) - ($image.width / 2)) + "px", 
					"z-index" : "300"
				});

		    } // end if
		    else {

		    	var $width_ratio 	= $win.width / $image.width;
		    	var $new_image_size = {
		    							"height" : parseInt(($image.height * $width_ratio) - (($image.height * $width_ratio) * $padding)),
		    							"width"  : parseInt(($image.width * $width_ratio) - (($image.width * $width_ratio) * $padding))
		    							};

		    	if ($new_image_size.height > $win.height) {

		    		var $height_ratio = $win.height / $image.height;

		    			$new_image_size.height 	= parseInt(($image.height * $height_ratio) - (($image.height * $height_ratio) * $padding));
		    			$new_image_size.width 	= parseInt(($image.width * $height_ratio) - (($image.width * $height_ratio) * $padding));

		    	} // end if

		    	$(".large_photo img.loading").removeAttr("style");

		    	$($dom_element).css({
					"width" : $new_image_size.width + "px", 
					"height" : $new_image_size.height + "px", 
					"position" : "fixed", 
					"top" : (($win.height / 2) - ($new_image_size.height / 2)) + "px", 
					"left" : (($win.width / 2) - ($new_image_size.width / 2)) + "px", 
					"z-index" : "300"
				});

		    } // end else
		} // end function

		// END DECLARING FUNCTIONS

		// EVENT LISTONER
		$("button.view_photo").click(function(){
			view_photo($('.product_image .image img'));
		});

		$(".view_photo_fader").click(function(){
			if($(".large_photo img.photo").is(":visible")) { hide_photo(); }
		});

		$(".large_photo").click(function(){
			if($(".large_photo img.photo").is(":visible")) { hide_photo(); }
		});

		$(".large_photo img.photo").on('load', function() {
			calculate_large_photo($(this));
	    });

	    $(window).resize(function(){
	    	if($(".large_photo img.photo").is(":visible")) {
	    		$win = {
					"height" : $(window).height(), 
			        "width" : $(window).width(), 
					"outerHeight" : $(window).outerHeight(), 
					"outerWidth" : $(window).outerWidth() 
				};
	    		calculate_large_photo($(".large_photo img.photo"));
	    	}
	    });

	});

</script>