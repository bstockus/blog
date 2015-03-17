<?php
/**
* Handles all calls to the database for the entire application
*/
class DataAccess{
	
	/**
	* @var resource $link 	The connection to the database
	*/
	private $link;
	
	/**
	* Constructor method
	* 
	* @param resource $link 	Sets the $link property
	*/
	function __construct($link){
		$this->link = $link;
	}

	/**
	* Authenticates a user for accessing the control panel
	* 
	* @param string email
	* @param string password
	* 
	* @return assoc array if login is authenticated, returns false if authentication fails
	*/
	function login($email, $password){
	
		$email = mysqli_real_escape_string($this->link, $email);
		$password = mysqli_real_escape_string($this->link, $password);

		$qStr = "SELECT user_display_name FROM users WHERE user_email = '$email' AND user_password = '$password' AND user_active = 'yes'";
		//die($qStr);

		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
		$num_rows = $result->num_rows;
		
		if($num_rows == 1){
			// NOTE: not the diff between msqli_fetch_array() and mysqli_fetch_assoc()
			// return mysqli_fetch_array($result);
			return mysqli_fetch_assoc($result);
		}elseif($num_rows > 1){
			$this->handle_error("Duplicate email and passwords in DB!");
			return false;
		}else{
			return false;
		}
	}

	function handle_error($err_msg){
		if(DEBUG_MODE){
			die($err_msg);
		}else{
			//TODO: handle errors in production
		}
	}
	
	/**
	 * Fetch all categories ordered by category_name
	 * 
	 * @return array
	 */
	function get_categories() {
	    $qStr = "SELECT category_id, category_name FROM categories ORDER BY category_name";
	    $result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	    $categories = array();
	    while ($row = mysqli_fetch_assoc($result)) {
	        $categories[] = $row;
	    }
	    
	    return $categories;
	}
	
	/**
	 * Fetch all images ordered by image_filename
	 * 
	 * @return array
	 */
	function get_images() {
	    $qStr = "SELECT image_id, image_filename, image_active FROM images ORDER BY image_filename";
	    $result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	    $images = array();
	    while ($row = mysqli_fetch_assoc($result)) {
	        $images[] = $row;
	    }
	    
	    return $images;
	}
	
	/**
	 * Fetch all posts ordered by post_date
	 * 
	 * @return array
	 */
	function get_posts() {
	    $qStr = "SELECT post_id, post_date, post_title, post_active FROM posts ORDER BY post_date";
	    $result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	    $posts = array();
	    while ($row = mysqli_fetch_assoc($result)) {
	        $posts[] = $row;
	    }
	    
	    return $posts;
	}
	
}
// notice there is no closing php delimiter for files that are meant to be embedded