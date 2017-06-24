<?php

require_once("../../../../_yoi_connections/config.php");
require_once(SITE_ROOT."_includes/_functions/functions.php");

// PHP objects intialization
$db 	= new mysql_db(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$server = new server();
$page 	= new page();
$server->check_maintenance_mode(FALSE);

?>