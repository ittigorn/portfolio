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



$(document).ready(function() {

	// call function on ready
	calculate_bottom_bar_position();

	// call function on resize
	$(window).resize(function() { calculate_bottom_bar_position(); });

});