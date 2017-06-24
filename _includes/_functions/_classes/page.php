<?php

class page {

	public 	$css;
	public 	$name;
	public  $language;
	private $global_content_table;
	private $content_table;
	public  $global_content;
	public  $content;
	private $summarize_content;
	private $alert = array();
	private $success = array();
	public 	$is_https;
	public  $url;

	// construct content array for content with no th value
	private $missing_global_content;
	private $missing_content;
	private $all_content;

	function __construct() {

		global $server;

		// check if page CSS exists, echo CSS style sheet link
		$this->name 						= preg_replace('/.php/',"",basename($_SERVER['PHP_SELF']));
		$this->check_language();
		$this->css 							= $this->get_page_css();
		$this->global_content_table			= "content_global_content";
		$this->content_table				= "content_".$this->name;
		$this->global_content 				= $this->fetch_page_content($this->global_content_table);
		$this->content 						= $this->fetch_page_content($this->content_table);
		$this->summarize_content 			= $server->summarize_content;
		$this->delete_unused_content		= $server->delete_unused_content;
		$this->is_https 					= $this->check_https();
		$this->url 							= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

		if ($this->summarize_content) {
			$this->missing_global_content 		= array();
			$this->missing_content 				= array();
			$this->all_content 					= array();
		}
		
	}// end construct function



	private function check_https() {
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') { return TRUE; }
		else { return FALSE; }
	} // end function
	


	private function check_language() {

		// check and extend cookie
		if (isset($_COOKIE["language"])) {
			if ($_COOKIE["language"] === "en") {
				$this->set_language("en");
			}
			elseif ($_COOKIE["language"] === "th") {
				$this->set_language("th");
			}
			else {
				$this->set_language("th");
			}
		}
		else {
			$this->set_language("th");
		}
	}// end function

	private function set_language($language) {
		$this->language = $language;
		setcookie("language", $this->language, (time() + (86400 * 30)), "/"); // 86400 = 1 day
	}// end function



	public function echo_content($default_content, $is_global) {

		global $server;
		$content = "";

		if (($server->multi_language === TRUE) && ($this->language === "en")) {

			$content_found = FALSE;

			// determines if it's a global content or not
			if ($is_global) {
				foreach ($this->global_content as $value) {
					if ($value->th === $default_content) {
						$content = $value->en;
						$content_found = TRUE;
					}
				}
				if ($this->summarize_content) {
					if (!$content_found) { 
						array_push($this->missing_global_content, $default_content); 
					}
				}

			}
			else {
				foreach ($this->content as $value) {
					if ($value->th === $default_content) {
						$content = $value->en;
						$content_found = TRUE;
					}
				}
				if ($this->summarize_content) {
					array_push($this->all_content, $default_content);
					if (!$content_found) { 
						array_push($this->missing_content, $default_content); 
					}
				}
			}

			if (($server->show_content_error == 1) && empty($content)) { $content = '<span style="color: white; background-color: red; font-weight: bold;"> CONTENT NOT AVAILABLE </span>'; }
			else { $content = (empty($content)) ? $default_content : $content; }

		} // end if dual language feature is turned on
		else { $content = $default_content; }

		echo $content;

	}// end function


	private function fetch_page_content($table_name){

		global $db;

		if ($db->check_table_exists($table_name)) {

			$result = $db->query_and_check("SELECT `id`,`en`,`th` FROM {$table_name};");
			$content_array = array();

			while ($current_row = mysqli_fetch_object($result)) {
				array_push($content_array, $current_row);
			} // end while

			return $content_array;
		}
		else {
			return array();
		}

	}// end function


	public function end_of_page() {
		global $server;
		if ($this->summarize_content) {
			$this->summarize_content();
		}
	} // end function


	private function summarize_content() {

		global $db;

		// clean array of duplicates
		$this->missing_global_content 	= array_unique($this->missing_global_content);
		$this->missing_content 			= array_unique($this->missing_content);

		// summarize global content and add what's missing
		foreach ($this->missing_global_content as $missing_content) {
			$this->insert_new_content($missing_content,TRUE);
		}

		// summarize page-specific content and add what's missing
		foreach ($this->missing_content as $missing_content) {
			// check if table exists if not global
			if (!$db->check_table_exists($this->content_table)) { $this->create_new_content_table(); }
			$this->insert_new_content($missing_content);
		}

		// remove any unused content
		if ($this->delete_unused_content) {
			$this->content = $this->fetch_page_content($this->content_table);
			foreach ($this->content as $value) {
				$returned_key = in_array($value->th, $this->all_content);
				if ($returned_key === FALSE) { // content is still in use
					// if not being use, delete the row by id
					$query = 'DELETE FROM `'.$this->content_table.'` WHERE `id` = '.$value->id.';';
					$db->query_and_check($query);
				}
			}
		}
	} // end fucntion


	private function insert_new_content($missing_content,$is_global = FALSE) {
		global $db;
		$missing_content = mysqli_real_escape_string($db, $missing_content);
		$table_name = ($is_global) ? $this->global_content_table : $this->content_table;

		$query  = 'INSERT INTO `' . $table_name . '` 	(	`th`,
															`en`,
												   			`note`
														  ) VALUES (
															"'.$missing_content.'",
															"",
												   			""
														);';
		$db->query_and_check($query);
		return TRUE;
		
	} // end function


	private function create_new_content_table() {
		global $db;
		$query = '	CREATE TABLE `' . $this->content_table . '` (
					id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					th TEXT NOT NULL,
					en TEXT NULL,
					note VARCHAR(255)
					);';

		$db->query_and_check($query);
		return TRUE;

	} // end function


	private function get_page_css(){

		$css_file_path = "_css/";
		$css_file_name = $this->name . ".css";
		if (file_exists($css_file_path.$css_file_name)){
			return '<!-- PAGE-SPECIFIC CSS -->
			<link href="' . $css_file_path . $css_file_name .'" rel="stylesheet" type="text/css">';
		}
		else {
			return '<!-- NO PAGE-SPECIFIC CSS -->';
		}

	}// end function



	public function add_alert($message_th,$message_en = '') {

		if (($this->language === 'en') && (!empty($message_en))) { array_push($this->alert, $message_en); }
		else { array_push($this->alert, $message_th); }

	} // end function



	public function add_success($message_th,$message_en = '') {

		if (($this->language === 'en') && (!empty($message_en))) { array_push($this->success, $message_en); }
		else { array_push($this->success, $message_th); }

	} // end function



	public function generate_alert(){

		if (!empty($this->alert)) {

			$html  = '<section class="alert_box">';
			$html .= "<ul>";

			foreach ($this->alert as $message) {

				if (!empty($message)) {
					if (substr($message,0,8) === "(header)") {
						$html .= "<li class='header'>";
						$html .= substr($message, 8);
					}
					else {
						$html .= "<li>";
						$html .= $message;
					}

					$html .= "</li>";
				}

			} // end foreach

			$html .= "</ul>";
			$html .= '</section>';

			return $html;
		}

	} // end function



	public function generate_success(){

		if (!empty($this->success)) {

			$html  = '<section class="success_box">';
			$html .= "<ul>";

			foreach ($this->success as $message) {

				if (!empty($message)) {
					if (substr($message,0,8) === "(header)") {
						$html .= "<li class='header'>";
						$html .= substr($message, 8);
					}
					else {
						$html .= "<li>";
						$html .= $message;
					}

					$html .= "</li>";
				}

			} // end foreach

			$html .= "</ul>";
			$html .= '</section>';

			return $html;
		}

	} // end function


}// end class page

?>