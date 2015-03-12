<?php

	include("../includes/common.inc.php");

	// clear out the session variables any time a user comes to this page
	unset($_SESSION['user_display_name']);
	unset($_SESSION['authenticated']);

	$email = "";
	$password = "";

	$error_messages = array();

	$login_failed_message = "";

	if(isset($_POST['btnSubmit'])){
		
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

			include("../includes/DataAccess.inc.php");
			include("../includes/AdminUtils.inc.php");
			$da = new DataAccess($link);
			$au = new AdminUtils();

			$user = $da->login($email, $au->encrypt_password($password));

			if($user !== false){
				$_SESSION['user_display_name'] = $user['user_display_name'];
				$_SESSION['authenticated'] = true;
				header('Location: index.php');
				die();
			}else{
				$login_failed_message = "UNABLE TO LOG IN. PLEASE TRY AGAIN";
				$email = "";
				$password = "";
			}
		}
	}


?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	  <?php 
	  	if(!empty($login_failed_message)){
	  		echo($login_failed_message);
	  	}
	  ?>
	  <div class="row">
          <div class="label">
          	  <?php if(isset($error_messages['email'])) echo($error_messages['email']); ?>
              Login:
          </div>
          <div class="control">
              <input type="text" name="email" value="<?php echo($email); ?>" />
          </div>
      </div>

      <div class="row">
          <div class="label">
          	  <?php if(isset($error_messages['password'])) echo($error_messages['password']); ?>
              Password:
          </div>
          <div class="control">
              <input type="password" name="password" value="<?php echo($password); ?>" />
          </div>
      </div>

      <div class="row">
          <div class="label">
              
          </div>
          <div class="control">
              <input type="submit" name="btnSubmit" value="Sign In" />
          </div>
      </div>
</form>