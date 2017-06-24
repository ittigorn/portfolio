<?php 

	require_once("../../_includes/ajax_run_first_addon.php");

	$error 			= FALSE;
	$error_message 	= "invalid request";

	function generate_index_carousel($size) {
		global $db;
		global $error_message;
		if (($size === 'xs') || ($size === 'sm') || ($size === 'md') || ($size === 'lg') || ($size === 'xl')) {
			$html  = '';
		} // end if
		else { exit('Invalid Carousel Size'); }
	} // end function

	if (isset($_POST["request_type"])) {

		// manipulating stores
		if ($_POST["request_type"] === "generate_index_carousel") {
			$size 		= $db->clean_input($_POST["size"]);
			$response 	= array("size" => $size, "html" => slide::generate_index_carousel($size));
			echo_json($response);
		} // end if
		else { $error = TRUE; }
	} // end if
	else { $error = TRUE; }

	if ($error) {
		exit($error_message);
	}
	
?>