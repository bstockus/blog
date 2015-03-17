<?php
// custom error handling code
include("custom_error_handler.inc.php");

// Store Session info in DataBase
require_once('SessionManager.inc.php');

function log_error($error) {
    echo $error;
}

define("MODE", "development");

// global configuration settings
if (MODE === "development") {
	// DEV ENVIRONMENT SETTINGS
	error_reporting(E_ALL);
	define("DEBUG_MODE", true);
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "falcon16");
	define("DB_NAME", "blog_db");
	define("ROOT_DIR", "/final-project/");
} else {
	// PRODUCTION SETTINGS
	define("DEBUG_MODE", false);
	define("DB_HOST", "production db server goes here");
	define("DB_USER", "production user name goes here");
	define("DB_PASSWORD", "production password goes here");
	define("DB_NAME", "production db name goes here");
	define("ROOT_DIR", "production url root location goes here");
}

function get_nav_menus() {
    return array(
	    "main" => array(
	        array("url" => "index.php", "text" => "HOME"),
		    array("url" => "blog.php", "text" => "BLOG"),
		    array("url" => "contact.php", "text" => "CONTACT")
	    ), "control-panel" => array(
	        array("url" => "control-panel/index.php", "text" => "HOME"),
		    array("url" => "control-panel/categories/index.php", "text" => "CATEGORIES"),
		    array("url" => "control-panel/posts/index.php", "text" => "POSTS"),
		    array("url" => "control-panel/images/index.php", "text" => "IMAGES")
	    )
	);
}

// get a connection to the database
$link = db_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

// start a session (you may want to store session data in the db!!!)
$sh = new SessionManager(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD,$link);
session_set_save_handler(
	array(&$sh, '_open'), 
	array(&$sh, '_close'), 
	array(&$sh, '_read'), 
	array(&$sh, '_write'), 
	array(&$sh, '_destroy'), 
	array(&$sh, '_clean') 
);
session_start();

// global functions
function db_connect($db_hostname, $db_user, $db_password, $db_database) {

	$link = mysqli_connect($db_hostname, $db_user, $db_password, $db_database);

	if (!$link) {
		log_error(mysqli_connect_error());
	}

	return $link;

}

function is_development_mode() {
    return (MODE === "development");
}

function is_production_mode() {
    return (MODE === "production");
}

function global_url($url) {
    return ROOT_DIR . $url;
}

function echo_global_url($url) {
    echo global_url($url);
}

?>