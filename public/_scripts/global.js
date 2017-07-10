/////////////// HELPER FUNCTIONS //////////////

function echo($something) {
	$("#script_output").append($something);
}// end function



function cl($something) {
	console.log($something);
}// end function



function validate_email($email) {
	$email_regex = RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
	return $email_regex.test($email);
} // end FUNCTIONS


/////////////// MAIN NAV COLLAPSE TOGGLE //////////////

// $(document).ready(function() {
// 	$(".main_nav .navbar-header").click(function(){
// 		$(".collapse").slideToggle();
// 	});
// });



/////////////// BOTTOM BAR POSITIONING //////////////



// have to put this outside so I could call it elsewhere

function calculate_bottom_bar_position() {

	//var document_height = $(document).height();

	var body_height = $("body").height();

	var window_height	= $(window).height();

	if ((body_height - 40) <= window_height){

		$("#bottom_bar").css({
			"position": "fixed",
			"clear": "both",
			"bottom": "0",
			"margin": "40px 0 0 0"
		})

	}// end if

	else {
		$("#bottom_bar").removeAttr('style');
	}

}// end function


// take either rgb or rgba values and reassign them with custom alpha value
function reassemble_rgba(rgb,a) {
  var vals = rgb.substring(rgb.indexOf('(') +1, rgb.length -1).split(', ');
  return 'rgba('+vals[0]+','+vals[1]+','+vals[2]+','+a+')';
}



$(document).ready(function() {

	// call function on ready
	calculate_bottom_bar_position();

	// call function on resize
	$(window).resize(function() { calculate_bottom_bar_position(); });

	// event handler on scroll to show bottom border of the navigation bar
	window.main_nav_border_rgb = $('#main_nav').css('border-bottom-color');
	$(window).scroll(function(event) {
		var max_scroll = 300;
		var top = $(window).scrollTop();
		if (top != 0) {
			var alpha = (top/(max_scroll/100)/100);
			if (alpha > 1) { alpha = 1; }
			var rgba = reassemble_rgba(window.main_nav_border_rgb,alpha);
			$('#main_nav').css('border-bottom-color', rgba);
		}
		else {
			$('#main_nav').removeAttr('style');
		}
	});

});