<?php
include("../includes/common.inc.php");
require_once("../includes/AdminUtils.inc.php");
require_once("../includes/PageUtils.inc.php");

// Make sure the user has been authenticated to view this page!
$au = new AdminUtils();
$au->user_authenticated(true);

$pu = new PageUtils();
$meta_title = "Control Panel";

echo($pu->get_header($meta_title));
echo($pu->get_control_panel_navigation("HOME"));

$content = "HELLO " . $_SESSION['user_display_name'];

echo($pu->get_page_content($content, "Control Panel"));
echo($pu->get_footer());

?>