<?php


class slide {

	// variables for temporary slide
	public static $temp_slide_keys = array('en_md','en_xl','th_md','th_xl');

	public $id;
	public $arrange;
	public $name;
	public $url;
	public $title_en;
	public $title_th;
	public $note;
	public $enabled;
	public $added_by;
	public $added_time;
	public $updated_by;
	public $updated_time;

	// temporarily constructed
	public $title;
	public $temp_slide;

	function __construct($id = '') {

		if (!empty($id)) {
			$this->load_existing_slide($id);
		} // end if
		else {
			$this->list_temp_slide();
		}

	} // end constructor

	private function load_existing_slide($id) {

		global $db;
		global $page;

		$query 	= 'SELECT * FROM `index_carousel` WHERE `id` = ' . $id . ';';
		$result = $db->query_and_check($query);
		$result = mysqli_fetch_object($result);

		// assign variables
		$this->id 			= $result->id;
		$this->arrange 		= $result->arrange;
		$this->name 		= $result->name;
		$this->url 			= $result->url;
		$this->title_en 	= $result->title_en;
		$this->title_th 	= $result->title_th;
		$this->note 		= $result->note;
		$this->enabled 		= $result->enabled;
		$this->added_by 	= $result->added_by;
		$this->added_time 	= $result->added_time;
		$this->updated_by 	= $result->updated_by;
		$this->updated_time = $result->updated_time;

		$this->title = ($page->language === 'en') ? $this->title_en : $this->title_th;

	} // end function


	public function save_temp_slide() {
		
		global $db;
		global $page;

		$slide_info 	= $db->clean_array($_POST);
		$error_found 	= FALSE;

		// assign variables
		$this->name 		= $slide_info['slide_name'];
		$this->url 			= $slide_info['slide_url'];
		$this->title_en 	= $slide_info['slide_title_en'];
		$this->title_th 	= $slide_info['slide_title_th'];

		foreach ($this::$temp_slide_keys as $temp_slide_key) {
		
			if (isset($_FILES[$temp_slide_key])) {
				if ($_FILES[$temp_slide_key]["error"] != 4) {

					$file_ok = TRUE;

					$file_extension = pathinfo($_FILES[$temp_slide_key]["name"],PATHINFO_EXTENSION);
					if ($file_extension !== "jpg") {
						$page->add_alert('อัพโหลดได้เฉพาะไฟล์ .jpg เท่านั้น',"Only .jpg file can be uploaded");
						$file_ok = FALSE;
						$error_found = TRUE;
					} // end if

					if ($file_ok) {
						$file_size = filesize($_FILES[$temp_slide_key]["tmp_name"]);
						if ($file_size > 1048576) {
							$mb = (($size_allowed/1024)/1024);
							$page->add_alert('ไฟล์ใหญ่เกิน '.$mb.' เม็กกะไบต์, กรุณาอัพโหลดไฟล์ที่เล็กกว่านี้','File exceeds '.$mb.' Mb size limit. Please upload a smaller image');
							$file_ok = FALSE;
							$error_found = TRUE;
						} // end if
					} // end if

					// if it's still ok then move it
					if ($file_ok) {
						
						$file_path = SITE_ROOT . 'public/_images/_index/carousel/_temp/' . $temp_slide_key . '.jpg';
						if (file_exists($file_path)) { unlink($file_path); } // delete if file exists
						move_uploaded_file($_FILES[$temp_slide_key]["tmp_name"], $file_path);

					} // end if

				} // end if
			} // end if

		} // end foreach

		// refresh temp slide
		$this->list_temp_slide();

		if ($error_found) { return FALSE; }
		else { return TRUE; }

	} // end function

	public function save_new_slide() {
		global $db;
		global $page;
		global $admin;

		$all_ok = TRUE;

		if (strlen($this->name) > 50) { $page->add_alert('ชื่อยาวเกินไป','Name is too long'); $all_ok = FALSE; }
		if (strlen($this->title_en) > 50) { $page->add_alert('คำอธิบายภาษาไทยยาวเกินไป','Title (EN) is too long'); $all_ok = FALSE; }
		if (strlen($this->title_th) > 50) { $page->add_alert('คำอธิบายภาษาอังกฤษยาวเกินไป','Title (TH) is too long'); $all_ok = FALSE; }
		if ((strlen($this->url) < 10) || (strlen($this->url) > 255)) { $page->add_alert('','Link can only be between 10 - 255 characters long'); $all_ok = FALSE; }

		if (!in_array('en_md.jpg', $this->temp_slide)) { $page->add_alert('ขาดไฟล์สไลด์ขนาดกลางภาษาอังกฤษ','Medium slide (EN) is missing'); $all_ok = FALSE; }
		if (!in_array('en_xl.jpg', $this->temp_slide)) { $page->add_alert('ขาดไฟล์สไลด์ขนาดใหญ่ภาษาอังกฤษ','Large slide (EN) is missing'); $all_ok = FALSE; }
		if (!in_array('th_md.jpg', $this->temp_slide)) { $page->add_alert('ขาดไฟล์สไลด์ขนาดกลางภาษาไทย','Medium slide (TH) is missing'); $all_ok = FALSE; }
		if (!in_array('th_xl.jpg', $this->temp_slide)) { $page->add_alert('ขาดไฟล์สไลด์ขนาดใหญ่ภาษาไทย','Large slide (TH) is missing'); $all_ok = FALSE; }

		if ($all_ok) {

			// increment the arrange column
			$query = 'UPDATE `index_carousel` SET `arrange` = `arrange` + 1;';
			$db->query_and_check($query);

			$query = 'INSERT INTO `index_carousel` 	( 	`arrange`,
													`name`,
													`url`,
													`title_en`,
													`title_th`,
													`added_by`,
													`added_time`
												  ) VALUES (
													0,
													"'.$this->name.'",
													"'.$this->url.'",
													"'.$this->title_en.'",
													"'.$this->title_th.'",
													"'.$admin->username.'",
													"'.time().'" );';
			// if insertion is successful then query to get the slide id
			if (!!$db->query_and_check($query)) {
				$query = 'SELECT `id` FROM `index_carousel` WHERE `arrange` = 0;';
				$result = $db->query_and_check($query);
				$slide_id = mysqli_fetch_array($result)[0];

				$all_files_moved = TRUE;

				// move files
				foreach ($this::$temp_slide_keys as $temp_slide_key) {

					$original_path = SITE_ROOT . 'public/_images/_index/carousel/_temp/' . $temp_slide_key . '.jpg';

					$language 	= substr($temp_slide_key, 0, 2);
					$size 		= substr($temp_slide_key, 3, 2);

					$destination_path 	= SITE_ROOT . 'public/_images/_index/carousel/' . $language . '/' . $size . '/' . $slide_id . '.jpg';
					if (!rename($original_path,$destination_path)) { $all_files_moved = FALSE; }

				} // end foreach

				return $all_files_moved;

			} // end if

		} // end if

	} // end function

	private function list_temp_slide() {
		$this->temp_slide = file_system::list_files(SITE_ROOT . 'public/_images/_index/carousel/_temp','.jpg');
	} // end function


	public static function clear_slide() {
		foreach (self::$temp_slide_keys as $slide_key) {
			$file_path = SITE_ROOT . 'public/_images/_index/carousel/_temp/' . $slide_key . '.jpg';
			if (file_exists($file_path)) { unlink($file_path); } // delete if file exists
		} // end foreach
	} // end function


	public static function generate_index_carousel($size) {

		global $db;
		global $page;

		$html 					= '';
		$carousel_slide_array 	= array();

		// customizable variables
		$path_to_images 	= '_images/_index/carousel/' . $page->language . '/' . $size . '/';
		$image_extension 	= '.jpg';

		// get carousel slides
		$carousel_slide_array = self::list_all_slides(TRUE);

		if (sizeof($carousel_slide_array) > 0) {

			$html .= 	'
						<div class="carousel_container">
						<div id="carousel_indicators" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">';
			foreach ($carousel_slide_array as $key => $value) {
				$html .= 		'<li data-target="#carousel_indicators" data-slide-to="' . $key . '" class="';
				if ($key == 0) { $html .= 'active'; }
				$html .= 		'"></li>';
			} // end foreach
			$html .= 		'</ol>
							<div class="carousel-inner" role="listbox">';
			foreach ($carousel_slide_array as $key => $value) {
				$html .= 	'<div class="carousel-item';
				if ($key == 0) { $html .= ' active'; }
				$html .= 	'">
								<a href="' . $value->url . '" title="' . $value->title . '">
									<img class="d-block img-fluid" src="' . $path_to_images . $value->id . $image_extension . '" title="' . $value->title . '">
								</a>
							</div>';
			} // end foreach
			$html .= 		'</div>';
			$html .= 		'<a class="carousel-control-prev" href="#carousel_indicators" role="button" data-slide="prev">
								<i class="fa fa-chevron-left"></i>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carousel_indicators" role="button" data-slide="next">
								<i class="fa fa-chevron-right"></i>
								<span class="sr-only">Next</span>
							</a>
						</div>
						</div>
						';

		} // end if carousel_slide_array is not empty
					
		return $html;

	} // end function


	public static function list_all_slides($exclude_disabled = FALSE) {

		global $db;

		$carousel_slide_array 	= array();

		// get carousel item result
		$query  = 'SELECT `id` FROM `index_carousel`';
		$query .= ($exclude_disabled) ? ' WHERE `enabled` = 1' : '';
		$query .= ' ORDER BY `arrange`;';

		$result = $db->query_and_check($query);
		while ($slide_id = mysqli_fetch_array($result)[0]) {
			$slide = new self($slide_id);
			array_push($carousel_slide_array, $slide);
		} // end while

		return $carousel_slide_array;

	} // end function



	public static function rearrange_slides($id_array) {

		global $db;
		$all_ok = TRUE;

		// loop through id array
		foreach ($id_array as $key => $id) {
			if (!is_numeric($id)) { return FALSE; }
			$query  = 'UPDATE `index_carousel` SET `arrange` = ' . $key . ' WHERE `id` = ' . $id . ';';
			if (!$db->query_and_check($query)) { $all_ok = FALSE; }
		} // end foreach

		return $all_ok;

	} // end function



	public static function toggle_slide_status($slide_id) {

		global $db;

		if (!is_numeric($slide_id)) { exit("Invalid ID (not numeric) supplied to toggle_slide_status function"); }

		$enabled = $db->fetch_single_entry_where("index_carousel", "enabled", "id", $slide_id);
		if ($enabled == '1') {
			$query = "UPDATE `index_carousel` SET `enabled` = 0 WHERE `id` = '{$slide_id}';";
			$new_status = FALSE;
		} // end if
		else {
			$query = "UPDATE `index_carousel` SET `enabled` = 1 WHERE `id` = '{$slide_id}';";
			$new_status = TRUE;
		}

		$db->query_and_check($query);
		return $new_status;

	} // end function


	public static function delete_slide($slide_id) {

		global $db;

		if (!is_numeric($slide_id)) { exit("Invalid ID (not numeric) supplied to delete_slide function"); }

		$query = "DELETE FROM `index_carousel` WHERE `id` = '{$slide_id}' LIMIT 1;";

		$all_ok = !!$db->query_and_check($query);


		// delete image files
		foreach (self::$temp_slide_keys as $slide_key) {

			$language 	= substr($slide_key, 0, 2);
			$size 		= substr($slide_key, 3, 2);

			$delete_path 	= SITE_ROOT . 'public/_images/_index/carousel/' . $language . '/' . $size . '/' . $slide_id . '.jpg';
			if (file_exists($delete_path)) {
				if (!unlink($delete_path)) { $all_ok = FALSE; }
			} // end if file exists
			
		} // end foreach

		return $all_ok;

	} // end function



} // end slide class




?>