<?php

// Logout route
Flight::route('GET /logout', function (){
    
    unset($_SESSION['user_display_name']);
	unset($_SESSION['authenticated']);
	
	Flight::redirect($_GET['redirect']);
});

// Login GET route
Flight::route('GET /login', function (){
    $redirect = $_GET['redirect'];
    
    // clear out the session variables any time a user comes to this page
	unset($_SESSION['user_display_name']);
	unset($_SESSION['authenticated']);
	
	Flight::render('login', array('login_failed_message' => "", 'error_messages' => "", 'email' => "", 'redirect' => $redirect), 'content');
	Flight::render('layout', array('page_title' => "Login", 'navbar' => ""));
	
});

// Login POST route
Flight::route('POST /login', function (){
    $email = "";
	$password = "";

	$error_messages = array();

	$login_failed_message = "";
	
	// validate email
	if(!empty($_POST['email'])){
		$email = $_POST['email'];
	}else{
		$error_messages['email'] = "You must enter a login name";
	}

	// validate password
	if(!empty($_POST['password'])){
		$password = $_POST['password'];
	}else{
		$error_messages['password'] = "You must enter a password";
	}

	if(!empty($error_messages)){
		
		// wrap each error message with the proper validation markup
		include("../includes/PageUtils.inc.php");
		$pu = new PageUtils();

		foreach($error_messages as $key => $value){
			$error_messages[$key] = $pu->wrap_validation_msg($value);
		}

	}else{
		global $da;
		global $au;

		$user = $da->login($email, $au->encrypt_password($password));

		if($user !== false){
			$_SESSION['user_display_name'] = $user['user_display_name'];
			$_SESSION['authenticated'] = true;
			Flight::redirect($_POST['redirect']);
		}else{
			$login_failed_message = "UNABLE TO LOG IN. PLEASE TRY AGAIN";
			$email = "";
			$password = "";
		}
	}
	
	Flight::render('login', array('login_failed_message' => $login_failed_message, 'error_messages' => $error_messages, 'email' => $email, 'redirect' => $_POST['redirect']), 'content');
	Flight::render('layout', array('page_title' => "Login", 'navbar' => ""));
	
});

?>