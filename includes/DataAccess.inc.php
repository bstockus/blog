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

		$qStr = "SELECT user_display_name, user_id FROM users WHERE user_email = '$email' AND user_password = '$password' AND user_active = 'yes'";
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
			echo($err_msg);
		}else{
			echo($err_msg);
		}
	}
	
	function get_user($id) {
	    $qStr = "SELECT user_id, user_display_name FROM users WHERE user_id = ?";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("i", $id)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    $user = mysqli_fetch_assoc($stmt->get_result());
	    return $user;
	}
	
	/**
	 * Fetch all categories ordered by category_name
	 * 
	 * @return array
	 */
	function get_categories() {
	    $qStr = "SELECT category_id, category_name FROM categories ORDER BY category_name";
	    $result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
	
	function get_categories_with_post_counts($exclude_inactive = false) {
	    $qStr = "SELECT categories.category_id AS category_id, category_name, COUNT(*) AS posts_count FROM posts INNER JOIN categories ON posts.category_id = categories.category_id GROUP BY posts.category_id";
	    if ($exclude_inactive) {
	        $qStr = "SELECT categories.category_id AS category_id, category_name, COUNT(*) AS posts_count FROM posts INNER JOIN categories ON posts.category_id = categories.category_id WHERE post_active = 'yes' GROUP BY posts.category_id ORDER BY categories.category_name";
	    }
	    $result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
	
	function get_category($id) {
	    $qStr = "SELECT category_id, category_name FROM categories WHERE category_id = ?";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("i", $id)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    $category = mysqli_fetch_assoc($stmt->get_result());
	    return $category;
	}
	
	function create_category($category) {
	    $qStr = "INSERT INTO categories(category_name) VALUES (?)";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("s", $category['category_name'])  or $this->handle_error(mysqli_error($this->link));
	    $result = $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    if ($result) {
	        return $this->link->insert_id;
	    } else {
	        return null;
	    }
	}
	
	function update_category($id, $category_name) {
	    $qStr = "UPDATE categories SET category_name=? WHERE category_id=?";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("si", $category_name, $id)  or $this->handle_error(mysqli_error($this->link));
	    return $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	}
	
	/**
	 * Fetch all images ordered by image_filename
	 * 
	 * @return array
	 */
	function get_images() {
	    $qStr = "SELECT image_id, image_filename, image_active FROM images ORDER BY image_filename";
	    $result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
	
	function get_image($id, $exclude_inactive = false) {
	    $qStr = "SELECT image_id, image_filename, image_active FROM images WHERE image_id = ?";
	    if ($exclude_inactive) {
	        $qStr = "SELECT image_id, image_filename, image_active FROM images WHERE image_id = ? AND image_active = 'yes'";
	    }
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("i", $id)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    $image = mysqli_fetch_assoc($stmt->get_result());
	    return $image;
	}
	
	function create_image($image) {
	    $qStr = "INSERT INTO images(image_filename, image_active) VALUES (?, ?)";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("ss", $image['image_filename'], $image['image_active'])  or $this->handle_error(mysqli_error($this->link));
	    $result = $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    if ($result) {
	        return $this->link->insert_id;
	    } else {
	        return null;
	    }
	}
	
	function update_image($id, $image) {
	    $qStr = "UPDATE images SET image_filename=?, image_active=? WHERE image_id=?";
	    $stmt = $this->link->prepare($qStr) or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("ssi", $image['image_filename'], $image['image_active'], $id)  or $this->handle_error(mysqli_error($this->link));
	    return $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	}
	
	function delete_image($id) {
	    $qStr = "DELETE FROM images WHERE image_id=?";
	    $stmt = $this->link->prepare($qStr) or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("i", $id) or $this->handle_error(mysqli_error($this->link));
	    return $stmt->execute() or $this->handle_error(mysqli_error($this->link));
	}
	
	/**
	 * Fetch all posts ordered by post_date
	 * 
	 * @return array
	 */
	function get_posts($exclude_inactive = false) {
	    $qStr = "SELECT post_id, post_title, post_short_title, post_date, post_active, posts.user_id AS user_id, posts.category_id AS category_id, post_description, post_content, user_display_name, category_name FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id ORDER BY post_date";
	    if ($exclude_inactive) {
	        $qStr = "SELECT post_id, post_title, post_date, post_active, posts.user_id AS user_id, posts.category_id AS category_id, post_description, post_content, user_display_name, category_name FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE post_active = 'yes' ORDER BY post_date";
	    }
	    $result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
	
	function get_post($id, $exclude_inactive = false) {
	    $qStr = "SELECT post_id, post_title, post_date, post_active, post_type, post_short_title, posts.user_id AS user_id, posts.category_id AS category_id, post_description, post_content, user_display_name, category_name FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE post_id = ?";
	    if ($exclude_inactive) {
	        $qStr = "SELECT post_id, post_title, post_date, post_active, post_type, post_short_title, posts.user_id AS user_id, posts.category_id AS category_id, post_description, post_content, user_display_name, category_name FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE post_id = ? AND post_active = 'yes'";
	    }
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("i", $id)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    $post = mysqli_fetch_assoc($stmt->get_result());
	    return $post;
	}
	
	function get_posts_for_search_query($query, $exclude_inactive = false) {
	    $qStr = "SELECT post_id, post_date, post_title, post_active, post_description, category_name, user_display_name, posts.category_id AS category_id, posts.user_id AS user_id FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE MATCH(posts.post_raw_content) AGAINST(?);";
	    if ($exclude_inactive) {
	        $qStr = "SELECT post_id, post_date, post_title, post_active, post_description, category_name, user_display_name, posts.category_id AS category_id, posts.user_id AS user_id FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE MATCH(posts.post_raw_content) AGAINST(?) AND post_active = 'yes' ORDER BY post_date";
	    }
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("s", $query)  or $this->handle_error(mysqli_error($this->link));
	    
	    $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($stmt->get_result(), MYSQLI_ASSOC);
	}
	
	function get_post_for_short_title($short_title, $exclude_inactive = false) {
	    $qStr = "SELECT post_id, post_title, post_short_title, post_date, post_active, posts.user_id AS user_id, posts.category_id AS category_id, post_description, post_content, user_display_name, category_name FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE post_short_title = ? ORDER BY post_date";
	    if ($exclude_inactive) {
	        $qStr = "SELECT post_id, post_title, post_date, post_active, posts.user_id AS user_id, posts.category_id AS category_id, post_description, post_content, user_display_name, category_name FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE post_active = 'yes' AND post_short_title = ? ORDER BY post_date";
	    }
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("s", $short_title)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_assoc($stmt->get_result());
	}
	
	function get_posts_for_category($category_id, $exclude_inactive = false) {
	    $qStr = "SELECT post_id, post_date, post_title, post_active, post_description, category_name, user_display_name, posts.category_id AS category_id, posts.user_id AS user_id FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE posts.category_id=? ORDER BY post_date";
	    if ($exclude_inactive) {
	        $qStr = "SELECT post_id, post_date, post_title, post_active, post_description, category_name, user_display_name, posts.category_id AS category_id, posts.user_id AS user_id FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE posts.category_id=? AND post_active = 'yes' ORDER BY post_date";
	    }
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("i", $category_id)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($stmt->get_result(), MYSQLI_ASSOC);
	}
	
	function get_posts_for_user($user_id, $exclude_inactive = false) {
	    $qStr = "SELECT post_id, post_date, post_title, post_active, post_description, category_name, user_display_name, posts.category_id AS category_id, posts.user_id AS user_id FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE users.user_id=? ORDER BY post_date";
	    if ($exclude_inactive) {
	        $qStr = "SELECT post_id, post_date, post_title, post_active, post_description, category_name, user_display_name, posts.category_id AS category_id, posts.user_id AS user_id FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE users.user_id=? AND post_active = 'yes' ORDER BY post_date";
	    }
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("i", $user_id)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($stmt->get_result(), MYSQLI_ASSOC);
	}
	
	function get_posts_for_date_range($year, $month, $exclude_inactive = false) {
	    $qStr = "SELECT post_id, post_date, post_title, post_active, post_description, category_name, user_display_name, posts.category_id AS category_id, posts.user_id AS user_id FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE (YEAR(post_date) = ? AND MONTH(post_date) = ?) ORDER BY post_date";
	    if ($exclude_inactive) {
	        $qStr = "SELECT post_id, post_date, post_title, post_active, post_description, category_name, user_display_name, posts.category_id AS category_id, posts.user_id AS user_id FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN users ON posts.user_id = users.user_id WHERE (YEAR(post_date) = ? AND MONTH(post_date) = ?) AND post_active = 'yes' ORDER BY post_date";
	    }
	    $stmt = $this->link->prepare($qStr) or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("ss", $year, $month) or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute() or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($stmt->get_result(), MYSQLI_ASSOC);
	}
	
	function get_posts_by_date($exclude_inactive = false) {
	    $qStr = "SELECT post_date, COUNT(*) AS posts_count FROM posts GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date";
	    if ($exclude_inactive) {
	        $qStr = "SELECT post_date, COUNT(*) AS posts_count FROM posts WHERE post_active = 'yes' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date";
	    }
	    $stmt = $this->link->prepare($qStr) or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute() or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($stmt->get_result(), MYSQLI_ASSOC);
	}
	
	function create_post($post) {
	    $post['post_raw_content'] = strip_tags($post['post_content']);
	    $qStr = "INSERT INTO posts(post_title, post_short_title, post_description, post_active, category_id, post_content, post_raw_content, user_id) VALUES (?,?,?,?,?,?,?,?)";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("ssssissi", $post['post_title'], $post['post_short_title'], $post['post_description'], $post['post_active'], $post['category_id'], $post['post_content'], $post['post_raw_content'], $post['user_id'])  or $this->handle_error(mysqli_error($this->link));
	    $result = $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    if ($result) {
	        return $this->link->insert_id;
	    } else {
	        return null;
	    }
	}
	
	function update_post($id, $post) {
	    $post['post_raw_content'] = strip_tags($post['post_content']);
	    $qStr = "UPDATE posts SET post_title=?, post_short_title=?, post_active=?, post_description=?, category_id=?, post_content=?, post_raw_content=? WHERE post_id=?";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("ssssissi", $post['post_title'], $post['post_short_title'], $post['post_active'], $post['post_description'], $post['category_id'], $post['post_content'], $post['post_raw_content'], $id)  or $this->handle_error(mysqli_error($this->link));
	    return $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	}
	
	function delete_post($id) {
	    $qStr = "DELETE FROM posts WHERE post_id=?";
	    $stmt = $this->link->prepare($qStr) or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("i", $id) or $this->handle_error(mysqli_error($this->link));
	    return $stmt->execute() or $this->handle_error(mysqli_error($this->link));
	}
	
	function create_contact($contact) {
	    $qStr = "INSERT INTO contacts(contact_name, contact_email, contact_comment) VALUES (?,?,?)";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("sss", $contact['contact_name'], $contact['contact_email'], $contact['contact_comment'])  or $this->handle_error(mysqli_error($this->link));
	    $result = $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    if ($result) {
	        return $this->link->insert_id;
	    } else {
	        return null;
	    }
	}
	
	function get_contacts() {
	    $qStr = "SELECT contact_id, contact_name, contact_email, contact_comment FROM contacts";
	    $result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
	
	function get_contact($id) {
	    $qStr = "SELECT contact_id, contact_name, contact_email, contact_comment FROM contacts WHERE contact_id=?";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("i", $id)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_assoc($stmt->get_result());
	}
	
	function get_notification_email_address() {
	    $qStr = "SELECT notification_email_address FROM settings";
	    $stmt = $this->link->prepare($qStr) or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute() or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($stmt->get_result(), MYSQLI_ASSOC)[0]['notification_email_address'];
	}
	
	function set_notification_email_address($notification_email_address) {
	    $qStr = "UPDATE settings SET notifcation_email_address=?";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("s", $notification_email_address)  or $this->handle_error(mysqli_error($this->link));
	    return $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	}
	
	function get_homepage_content() {
	     $qStr = "SELECT homepage_content FROM settings";
	    $stmt = $this->link->prepare($qStr) or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute() or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($stmt->get_result(), MYSQLI_ASSOC)[0]['homepage_content'];
	}
	
	function set_homepage_content($homepage_content) {
	    $qStr = "UPDATE settings SET homepage_content=?";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("s", $homepage_content)  or $this->handle_error(mysqli_error($this->link));
	    return $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	}
	
	function set_settings($settings) {
	    $qStr = "UPDATE settings SET homepage_content=?, notification_email_address=?";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->bind_param("ss", $settings['homepage_content'], $settings['notification_email_address'])  or $this->handle_error(mysqli_error($this->link));
	    return $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	}
	
	function get_settings() {
	    $qStr = "SELECT homepage_content, notification_email_address FROM settings";
	    $stmt = $this->link->prepare($qStr) or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute() or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($stmt->get_result(), MYSQLI_ASSOC)[0];
	}
	
	function get_users() {
	    $qStr = "SELECT user_id, user_email, user_password, user_display_name, user_role, user_active, user_display_name FROM users";
	    $stmt = $this->link->prepare($qStr)  or $this->handle_error(mysqli_error($this->link));
	    $stmt->execute()  or $this->handle_error(mysqli_error($this->link));
	    return mysqli_fetch_all($stmt->get_result(), MYSQLI_ASSOC);
	}
	
}