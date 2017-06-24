<?php

class gallery {

	

	function __construct($db = NULL) {

		

	}// end construct function


	public function generate_gallery_thumbnails($path_to_thumb_files) {

		// list all files in the immediate folder
		$file_list = scandir($path_to_thumb_files);

		$html = "";

		foreach ($file_list as $file_name) {
			if (($file_name !== ".") && ($file_name !== "..") && (substr($file_name, -4, 4) === ".jpg")) {

				$thumb_id = "pic_id_".preg_replace('/.jpg/', "", $file_name);
				$html .= "<img id='{$thumb_id}' class='img-thumbnail' src='{$path_to_thumb_files}/{$file_name}' />
";
			}// end if
		}// end foreach

		return $html;

	}// end function

	public function generate_gallery_thumbnails_short($path_to_thumb_files) {

		// list all files in the immediate folder
		$file_list = scandir($path_to_thumb_files);

		$html 		= "";
		$limiter 	= 4;  
		$counter 	= 0;


		foreach ($file_list as $file_name) {
			if ($counter === $limiter) { $counter++; break; }
			if (($file_name !== ".") && ($file_name !== "..") && (substr($file_name, -4, 4) === ".jpg")) {

				$thumb_id = "pic_id_".preg_replace('/.jpg/', "", $file_name);
				$html .= "<img id='{$thumb_id}' class='img-thumbnail real_thumb' src='{$path_to_thumb_files}/{$file_name}' />
";
				$counter++;
			}// end if
		}// end foreach

		if ($counter > $limiter) {

			// Include load_more button
			$html .= "<img class='img-thumbnail load_more' src='_images/load_more_";
			if (!isset($_COOKIE["language"])) {
				$html .= "en";
			}
			else {
				if ($_COOKIE["language"] === "en") {
					$html .= "en";
				}
				else {
					$html .= "th";
				}
			}
			$html .= ".jpg' /><input class='thumb_counter' type='text' style='display:none' disable='disabled' value='" . ($counter - 1) . "'>
";

			// Include load_all button
			$html .= "<img class='img-thumbnail load_more' src='_images/load_all_";
			if (!isset($_COOKIE["language"])) {
				$html .= "en";
			}
			else {
				if ($_COOKIE["language"] === "en") {
					$html .= "en";
				}
				else {
					$html .= "th";
				}
			}
			$html .= ".jpg' /><input class='thumb_counter' type='text' style='display:none' disable='disabled' value='" . ($counter - 1) . "'>
";
		}

		return $html;

	}// end function


	public function generate_more_gallery_thumbnails($path_to_thumb_files, $position) {

		// list all files in the immediate folder
		$file_list = scandir(SITE_ROOT . "public/" . $path_to_thumb_files);

		$html 		= "";
		$limiter 	= $position + 5;
		$counter 	= 0;


		foreach ($file_list as $file_name) {
			if ($counter === $limiter) { $counter++; break; }
			if (($file_name !== ".") && ($file_name !== "..") && (substr($file_name, -4, 4) === ".jpg")) {

				$thumb_id = "pic_id_".preg_replace('/.jpg/', "", $file_name);
				$html .= "<img id='{$thumb_id}' class='img-thumbnail real_thumb' src='{$path_to_thumb_files}/{$file_name}' />
";
				$counter++;
			}// end if
		}// end foreach

		if ($counter > $limiter) {

			// Include load_more button
			$html .= "<img class='img-thumbnail load_more' src='_images/load_more_";
			if (!isset($_COOKIE["language"])) {
				$html .= "en";
			}
			else {
				if ($_COOKIE["language"] === "en") {
					$html .= "en";
				}
				else {
					$html .= "th";
				}
			}
			$html .= ".jpg' /><input class='thumb_counter' type='text' style='display:none' disable='disabled' value='" . ($counter - 1) . "'>
";

			// Include load_more button
			$html .= "<img class='img-thumbnail load_more' src='_images/load_all_";
			if (!isset($_COOKIE["language"])) {
				$html .= "en";
			}
			else {
				if ($_COOKIE["language"] === "en") {
					$html .= "en";
				}
				else {
					$html .= "th";
				}
			}
			$html .= ".jpg' /><input class='thumb_counter' type='text' style='display:none' disable='disabled' value='" . ($counter - 1) . "'>
";
		}

		return array(

						"html" => $html,
						"position" => ($counter - 1)

						);

	}// end function



	public function generate_all_gallery_thumbnails($path_to_thumb_files) {

		// list all files in the immediate folder
		$file_list = scandir(SITE_ROOT . "public/" . $path_to_thumb_files);

		$html 		= "";

		foreach ($file_list as $file_name) {
			if (($file_name !== ".") && ($file_name !== "..") && (substr($file_name, -4, 4) === ".jpg")) {

				$thumb_id = "pic_id_".preg_replace('/.jpg/', "", $file_name);
				$html .= "<img id='{$thumb_id}' class='img-thumbnail real_thumb' src='{$path_to_thumb_files}/{$file_name}' />
";
			}// end if
		}// end foreach

		return array("html" => $html);

	}// end function


	public static function generate_file_manager_gallery($file_category) {

		// determine path to files
		if ($file_category === 'product') {
			$path_to_files 	= product::$path_to_half;
			$extension 		= '.jpg';
		}
		elseif (	($file_category === 'beauty_tips') || 
					($file_category === 'beauty_journey') ||
					($file_category === 'product_review')	) {
			$blog 			= blog::instantiate_blog($file_category,'temp');
			$path_to_files 	= $blog->path_to_blog_image_folder;
			$extension 		= array('.jpg','.png','.gif');
		}

		// list all files in the immediate folder
		$file_list = file_system::list_files($path_to_files,$extension);

		$html 		= "";

		return $file_list;

	}// end function
	

}// end class page

?>