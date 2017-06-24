<?php

class server {

	public $maintenance_mode;
	public $timezone;
	public $multi_language;
	public $show_content_error;
	public $delete_unused_content;
	public $summarize_content;
	public $host;
	public $use_recaptcha_public;
	public $use_recaptcha_admin;
	public $use_recaptcha_localhost;
	public $contact_form;
	public $customer_service_email;
	public $contact_form_email_destination;
	public $security_email_origin;
	public $security_email_destination;
	public $https_redirect_public;
	public $https_redirect_admin;
	public $name_en;
	public $name_th;
	public $opening_time;
	public $closing_time;
	public $force_closed;
	public $address_en;
	public $address_th;
	public $phone;
	public $line;
	public $facebook;
	public $instagram;
	public $linkedin;
	public $viewbug;

	// allow sharing?
	public $share_facebook;
	public $share_line;

	// temporary variables
	public $recaptcha_secret;
	public $recaptcha_sitekey;


	function __construct(){

		global $db;

		$server_info = $db->fetch_single_row_table("server");

		$this->maintenance_mode 				= ($server_info->maintenance_mode == 1) ? TRUE : FALSE;
		$this->timezone 						= $server_info->timezone;
		$this->multi_language 					= ($server_info->multi_language == 1) ? TRUE : FALSE;
		$this->show_content_error 				= ($server_info->show_content_error == 1) ? TRUE : FALSE;
		$this->summarize_content 				= ($server_info->summarize_content == 1) ? TRUE : FALSE;
		$this->delete_unused_content			= ($server_info->delete_unused_content == 1) ? TRUE : FALSE;
		$this->host 							= $_SERVER["HTTP_HOST"];
		$this->use_recaptcha_public				= ($server_info->use_recaptcha_public == 1) ? TRUE : FALSE;
		$this->use_recaptcha_admin				= ($server_info->use_recaptcha_admin == 1) ? TRUE : FALSE;
		$this->use_recaptcha_localhost			= ($server_info->use_recaptcha_localhost == 1) ? TRUE : FALSE;
		$this->contact_form						= ($server_info->contact_form == 1) ? TRUE : FALSE;
		$this->customer_service_email 			= $server_info->customer_service_email;
		$this->contact_form_email_destination 	= $server_info->contact_form_email_destination;
		$this->security_email_origin 			= $server_info->security_email_origin;
		$this->security_email_destination 		= $server_info->security_email_destination;
		$this->https_redirect_public 			= ($server_info->https_redirect_public == 1) ? TRUE : FALSE;
		$this->https_redirect_admin 			= ($server_info->https_redirect_admin == 1) ? TRUE : FALSE;
		$this->name_en 							= $server_info->name_en;
		$this->name_th 							= $server_info->name_th;
		$this->opening_time						= $server_info->opening_time;
		$this->closing_time						= $server_info->closing_time;
		$this->force_closed 					= $server_info->force_closed;
		$this->address_en 						= $server_info->address_en;
		$this->address_th 						= $server_info->address_th;
		$this->phone 							= $server_info->phone;
		$this->line 							= $server_info->line;
		$this->facebook 						= $server_info->facebook;
		$this->instagram 						= $server_info->instagram;
		$this->linkedin 						= $server_info->linkedin;
		$this->viewbug 							= $server_info->viewbug;
		$this->share_facebook 					= ($server_info->share_facebook == 1) ? TRUE : FALSE;
		$this->share_line 						= ($server_info->share_line == 1) ? TRUE : FALSE;

		// construct temporary variables
		$this->recaptcha_secret 		= ($this->host === "localhost") ? $server_info->recaptcha_secret_local : $server_info->recaptcha_secret_live;
		$this->recaptcha_sitekey 		= ($this->host === "localhost") ? $server_info->recaptcha_sitekey_local : $server_info->recaptcha_sitekey_live;

		// set timezone
		date_default_timezone_set($this->timezone);

	} // end constructor



	public function check_maintenance_mode($admin = FALSE) {

		global $page;

		if ($this->maintenance_mode !== FALSE) {
			if (!isset($_SESSION)) { session_start(); }
			if (!isset($_SESSION["maintenance_mode_user"])) {
				if (($admin) && ($page->name !== "maintenance_mode_login")) { redirect("../maintenance_mode_login.php"); }
				elseif ($page->name !== "maintenance_mode_login") { redirect("maintenance_mode_login.php"); }
			}
		}

	} // end function



	public function validate_recaptcha($recaptcha_response,$is_public_recaptcha = TRUE) { // verify Google's ReCaptcha

			if ($is_public_recaptcha) {
				$use_recaptcha = $this->use_recaptcha_public;
			}
			else {
				$use_recaptcha = $this->use_recaptcha_admin;
			}

		if ((($this->host === 'localhost') && ($this->use_recaptcha_localhost)) || (($this->host !== 'localhost') && ($use_recaptcha))) {

			$validation = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$this->recaptcha_secret."&response=".$recaptcha_response);
			$validation = json_decode($validation, TRUE);

			if ($validation["success"] === TRUE) { return TRUE; }
			else { return FALSE; }
		}
		else { return TRUE; }

	}// end function



	public function toggle($column_name) {

		global $db;

		$current_status = $db->fetch_single_entry('server', $column_name);
		if ($current_status == 1) {
			$db->query_and_check("UPDATE `server` SET `{$column_name}` = 0;");
			return FALSE;
		}
		else {
			$db->query_and_check("UPDATE `server` SET `{$column_name}` = 1;");
			return TRUE;
		}

	} // end function



	public function update_config($column_name,$new_value) {

		global $db;

		if (($column_name === 'customer_service_email') || ($column_name === 'contact_form_email_destination')) {
			if (!validate_email($new_value)) {
				exit();
			}
		}

		$db->query_and_check("UPDATE `server` SET `{$column_name}` = '{$new_value}';");
		return TRUE;

	} // end function

}// end class server

?>