<?php
/**
* Utility functions used in the control panel
*
*/

class AdminUtils{
	
	/**
	* Encrypts a string, using an md5 hash
	*
	* @param string $password 	The string to encrypt
	* 
	* @return string the encrypted string
	*/
	function encrypt_password($password){
		return md5($password);
	}

	/**
	* Checks the session variable to see if a user has been authenticated
	* 
	* @param bool $redirect if not authenticated redirect to login page
	* 
	* @return bool
	*/
	function user_authenticated($redirect = false){
		if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true){
			return true;
		}else{
		    if ($redirect) {
		        header('Location: login.php');
		        die();
		    } else {
		        return false;
		    }
		}
	}

}