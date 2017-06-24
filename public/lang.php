<?php

require_once("../_includes/run_first_addon.php"); 

if (isset($_POST["switch_language"])) {

	$previous_page = $_POST["switch_language"];

	// if previos page doesn't have any file extension then default to index.php
	if (!strpos($previous_page, '.')) {
		$previous_page = 'index.php';
	}

	// if $page->language pref is not set
	if ($page->language === "en") {
		$new_language = "th";
	}
	elseif ($page->language === "th") {
		$new_language = "en";
	}
	else {
		$new_language = "th"; // default language
	}

	setcookie("language", $new_language, (time() + (86400 * 30)), "/"); // 86400 = 1 day
	redirect($previous_page);

}
else {
	redirect("index.php");
}
?>