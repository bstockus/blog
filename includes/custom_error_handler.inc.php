<?php

require_once "EmailHelpers.inc.php";
function myErrorHandler($errno, $errstr, $errfile, $errline){

	$str = "THIS IS OUR CUSTOM ERROR HANDLER<br>";
	$str .= "ERROR NUMBER: " . $errno . "<br>ERROR MSG: " . $errstr . "<br>FILE: " . $errfile . "<br>LINE NUMBER: " . $errline . "<br><br>";
	
	if(DEBUG_MODE){
		echo($str);
		
		$str .= print_r($_POST);
		$str .= print_r($_GET);
		$str .= print_r($_SERVER);
		$str .= print_r($_FILES);
		$str .= print_r($_COOKIE);
		$str .= print_r($_SESSION);
		$str .= print_r($_REQUEST);
		$str .= print_r($_ENV);
		
		sendMessage(notification_email_address(), "PHP ERROR ALERT!", $str);
		
	}else{
		// You might want to send all the super globals with the error message 
		$str .= print_r($_POST);
		$str .= print_r($_GET);
		$str .= print_r($_SERVER);
		$str .= print_r($_FILES);
		$str .= print_r($_COOKIE);
		$str .= print_r($_SESSION);
		$str .= print_r($_REQUEST);
		$str .= print_r($_ENV);
		
		sendMessage(notification_email_address(), "PHP ERROR ALERT!", $str);
		//TODO: echo a nice message to the user, or redirect to an error page
	}
}

set_error_handler("myErrorHandler");

function myExceptionHandler($exception) {
    if(DEBUG_MODE){
		echo($exception->getMessage());
		
		sendMessage(notification_email_address(), "PHP EXCEPTION ALERT!", $str);
	}else{
		//How to handle exceptions???
		
		sendMessage(notification_email_address(), "PHP EXCEPTION ALERT!", $str);
		//TODO: echo a nice message to the user, or redirect to an error page
	}
}

set_exception_handler("myExceptionHandler");