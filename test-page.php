<?php
include("includes/common.inc.php");
require_once("includes/DataAccess.inc.php");
require_once("includes/PageUtils.inc.php");
require_once("includes/AdminUtils.inc.php");

//test_password_encryption();
//test_login();
//test_main_navigation();
//test_main_navigation_with_selected_item("HOME");
test_categories();


// Test Password Encryption
function test_password_encryption(){
	$password = "password";
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

function test_categories() {
    global $link;
    $da = new DataAccess($link);
    
    $categories = $da->get_categories();
    foreach ($categories as $cat) {
        echo ($cat['category_name'] . " - " . $cat['category_id'] . "<br>");
    }
}


?>