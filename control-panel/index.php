<?php
include("../includes/common.inc.php");
include("../includes/AdminUtils.inc.php");


// Make sure the user has been authenticated to view this page!
$au = new AdminUtils();

if(!$au->user_authenticated()){
	die("You are not authorized to view this page");
}else{
	echo("HELLO " . $_SESSION['user_display_name']);
}

?>