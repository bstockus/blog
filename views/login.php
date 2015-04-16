<form method="POST" action="<?php echo_global_url("login"); ?>">
	  <?php 
	  	if(!empty($login_failed_message)){
	  		echo($login_failed_message);
	  	}
	  ?>
	  <input type="hidden" name="redirect" value="<?php echo($redirect); ?>" />
	  <div class="form-group">
          <label>
          	  <?php if(isset($error_messages['email'])) echo($error_messages['email']); ?>
              Login:
          </label>
          <div class="control">
              <input type="text" name="email" autofocus value="<?php echo($email); ?>" />
          </div>
      </div>

      <div class="form-group">
          <label>
          	  <?php if(isset($error_messages['password'])) echo($error_messages['password']); ?>
              Password:
          </label>
          <div class="control">
              <input type="password" name="password" />
          </div>
      </div>

      <div class="form-group">
          <div class="label">
              
          </div>
          <div class="control">
              <input type="submit" name="btnSubmit" value="Sign In" />
          </div>
      </div>
</form>