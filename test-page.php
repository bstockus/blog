<?php
include("includes/common.inc.php");
include("includes/DataAccess.inc.php");
include("includes/PageUtils.inc.php");
include("includes/AdminUtils.inc.php");

//test_password_encryption();
//test_login();
//test_main_navigation();
//test_main_navigation_with_selected_item("HOME");


// Test Password Encryption
function test_password_encryption(){
	$password = "test";
	$au = new AdminUtils();
	$encrypted_password = $au->encrypt_password($password);
	echo($encrypted_password);
}

// Test Login
function test_login(){
	global $link;
	$da = new DataAccess($link);
	$au = new AdminUtils();

	$returnValue = $da->login("nk@nk.com",$au->encrypt_password("test"));
	var_dump($returnValue);
}

// Test main navigation
function test_main_navigation(){
	$pu = new PageUtils();
	$nav = $pu->get_navigation();
	echo($nav);
}

function test_main_navigation_with_selected_item($selected_item){
	$pu = new PageUtils();
	$nav = $pu->get_navigation($selected_item);
	echo($nav);
}


?>