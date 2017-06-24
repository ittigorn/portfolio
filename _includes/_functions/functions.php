<?php

/////////////////////// DECLARING CONSTANTS ///////////////////////////\
defined('REGEX_ONLY_NUMBERS')   ? null : define('REGEX_ONLY_NUMBERS', '/[^0-9]/');

/////////////////////////// DEBUG FUNCTIONS /////////////////////////

function dump($var){
	echo '<pre>';
	print_r($var);
	echo '</pre>';
} // end function



//////////////////// GLOBAL FACILITATING FUNCTIONS ///////////////////

function resize_image($path_to_file, $w, $h, $crop = FALSE) {
    list($width, $height) = getimagesize($path_to_file);
    $ratio = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width * abs($ratio - $w / $h)));
        } else {
            $height = ceil($height-($height * abs($ratio - $w / $h)));
        }
        $newwidth   = $w;
        $newheight  = $h;
    } else {
        if ($w / $h > $ratio) {
            $newwidth = $h * $ratio;
            $newheight = $h;
        } else {
            $newheight = $w / $ratio;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($path_to_file);
    $dst = imagecreatetruecolor($newwidth, $newheight);

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
} // end function

// this function is set to use with Bangkok time zone
function convert_to_utc($time) {

	if (!empty($time)) {
		if ($time >= 7) {
			$time = $time - 7;
		}
		else {
			$time = ($time + 24) - 7; 
		}
		return $time;
	}
	else {
		return NULL;
	}
	
} // end function

function validate_email($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
} // end function

function phone_format($phone_number) {
	if (is_numeric($phone_number) && !empty($phone_number)) {
		$phone_number = str_split($phone_number);
		if (sizeof($phone_number) == 10) {
			$phone_number 	= 	$phone_number[0] . 
								$phone_number[1] . 
								$phone_number[2] . 
								'-' . 
								$phone_number[3] . 
								$phone_number[4] . 
								$phone_number[5] . 
								'-' . 
								$phone_number[6] . 
								$phone_number[7] . 
								$phone_number[8] . 
								$phone_number[9];
		}
		elseif (sizeof($phone_number) == 9) {
			$phone_number 	= 	$phone_number[0] . 
								$phone_number[1] . 
								'-' . 
								$phone_number[2] . 
								$phone_number[3] . 
								$phone_number[4] . 
								'-' . 
								$phone_number[5] . 
								$phone_number[6] . 
								$phone_number[7] . 
								$phone_number[8];
		}
		return $phone_number;
	}
	else {
		return $phone_number;
	}
} // end function


function coordinate_format($coordinate) {
	return number_format($coordinate,6);
} // end function


function price_format($price) {
	return number_format($price,2);
} // end function


function redirect($location) {
	header("location: ".$location);
	exit;
}// end function


function generate_random_hash() {
	return hash('ripemd160', rand().time());
}// end function


// this function can be used anywhere throughout the site as long as the required files are included and $page is initialized
// this function helps show dual language content easier, if current language doesn't have any content then the function will echo the default content
function lang($default_content, $is_global = FALSE) {
	global $page;
	$page->echo_content($default_content, $is_global);
} // end function


function echo_json($json) {
	header('Content-type:application/json;charset=utf-8');
	echo json_encode($json);
} // end function



/////////////////////////// LOAD CLASSES ///////////////////////////
spl_autoload_register("load_classes");
function load_classes() {
	require_once(SITE_ROOT."_includes/_functions/_classes/page.php");
	require_once(SITE_ROOT."_includes/_functions/_classes/mysql_db.php");
	require_once(SITE_ROOT."_includes/_functions/_classes/gallery.php");
	require_once(SITE_ROOT."_includes/_functions/_classes/server.php");
	require_once(SITE_ROOT."_includes/_functions/_classes/slide.php");
} // end loader
/////////////////////////// END LOAD CLASSES //////////////////////////
?>