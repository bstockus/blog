<?php
/**
* Utility class for pages
*
* This class contains methods that are useful in constructing pages.
*
*/

require_once('AdminUtils.inc.php');

class PageUtils{
		
	function __construct(){
		
	}

	/**
	* Assembles the header tags for pages, including the doc-type declaraion
	* and the opening body tag
	*
	* @param string $page_title 		the title tag for the page
	* @param string $page_description 	(optional) the meta description tag for the page
	*
	* @return string the html markup for the doc-type declaration to the openining body tag
	*/
	function get_header($page_title, $page_description = ""){
        
        $css_dir_url = global_url('css');
        
        //<link REL=StyleSheet HREF="{$normalize_css_url}" TYPE="text/css">
        //<link REL=StyleSheet HREF="{$style_css_url}" TYPE="text/css">
        //<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        
$str = <<<EOD
<!DOCTYPE html>
<html>
  <head
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="{$page_description}">
    <meta name="viewport" content="width=device-width"
    
    <title>{$page_title}</title>
    
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{$css_dir_url}/sticky.css" type="text/css">
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
  </head>
  <body>
EOD;
		return $str;
	}

	/**
	* Assembles the markup for the page footer, including the closing body and html tags
	*
	* @return string the footer div and closing body and html tags
	*/
	function get_footer(){
	    
	    $privacy_policy_link_url = global_url('privacy-policy.php');
	    $contact_link_url = global_url('contact.php');
	    
	    $mode = "";
	    if (is_development_mode()) {
	        $mode = "<span class='label label-danger'>DEVELOPMENT</span>";
	    }
	    
$str = <<<EOD
<footer class="footer">
	<div class="container">
	    <span class="pull-right">{$mode}</span>
		&copy; 2015 Bryan Stockus, All Rights Reserved.    |    
		<a href="{$privacy_policy_link_url}">Privacy Policy</a>    |    
		<a href="{$contact_link_url}">Contact</a>
	</div>
</footer>
</body>
</html>
EOD;
		return $str;		
	}
    
    /**
     * Assembles the markup for the main navigation bar
     * 
     * @param string $selected_item the item in the navigation menu that should be selected
     */
    function get_main_navigation($selected_item = "") {
        
        return $this->get_navigation($selected_item);
        
    }
    
    /**
     * Assembles the markup for the control panel navigation bar
     * 
     * @param string $selected_item the item in the navigation menu that should be selected
     */
    function get_control_panel_navigation($selected_item = "") {
        
        return $this->get_navigation($selected_item, "control-panel");
        
    }

	/**
	* Assembles the markup for the navigation bar
	*
	* @param string $selected_item the item in the navigation menu that should be selected
	* @param string $menu_id the menu to be used
	*
	* @return string 
	*/
	function get_navigation($selected_item = "", $menu_id = "main"){
		
		return $this->wrap_navigation($selected_item, get_nav_menus()[$menu_id], "Bryan Stockus");
				
	}
	
	/**
	 * Wraps the Passed Navlinks in the Navigation Bar StyleSheet
	 * 
	 * @param array $nav_links the array of navlinks to use
	 * @param string $selected_item the item in the navigation menu that should be selected
	 * 
	 * @return string
	 */
	private function wrap_nav_links($nav_links, $selected_item = "") {
	    
	    $str = "<ul class='nav navbar-nav'>";

		foreach($nav_links as $link){
			
			$selected_class_name = "";
			$url = global_url($link['url']);
			$text = $link['text'];

			if($text == $selected_item){
				$selected_class_name = "active";
			}

			$str .= "<li><a href=\"{$url}\" class=\"{$selected_class_name}\">{$text}</a>";
		}

		$str .= "</ul>";

		return $str;
	    
	}
	
	private function wrap_navigation($selected_item, $menu, $nav_title) {
	    
	    $nav_links = $this->wrap_nav_links($menu, $selected_item);
	    $user = $this->wrap_user();
	    
$str = <<<EOD
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{$nav_title}</a>
        </div>
        <div id='navbar' class='collapse navbar-collapse'>
            {$nav_links}
            {$user}
        </div>
    </div>
</nav>
EOD;

        return $str;
	}
	
	private function wrap_user() {
	    
	    $au = new AdminUtils();
	    $user = "";
	    if ($au->user_authenticated()) {
	        $user .= $_SESSION['user_display_name'];
	    } else {
	        return "";
	    }
	    
$str = <<<EOD
<ul class="nav navbar-nav navbar-right">
    <li><a href="#"><i class="fa fa-user"></i> {$user}</a></li>
</ul>
EOD;
	    
	    return $str;
	    
	}
	
	/**
	* Assembles the markup for the page banner
	* 
	* @param string $title the title for the banner
	* @param string $subtitle the sub-title for the banner
	* @param string $button the banner button
	*
	* @return string the html markup for the banner
	*/
	function get_banner($title, $subtitle = "", $button = ""){

$str = <<<EOD
<div class='page-header'>
    <h1>
        <span class='pull-right'>{$button}</span>
        {$title}
        <small>{$subtitle}</small>
    </h1>
</div>
EOD;
		return $str;		
	}

	/**
	* Assembles the markup for the main content of the page, the content get wrapped
	* divs that allow for consistent styling
	*
	* @param string $content the content of the page
	* @param string $title the title of the page
	*
	* @return string the html markup for the content
	*/
	function get_page_content($content, $title){
	    
$str = <<<EOD
<div class='container'>
    <div class='page-header'>
        <h1>{$title}</h1>
    </div>
    {$content}
</div>
EOD;
		return $str;
	}
	
	/**
	 * Starts the pages content block
	 * 
	 * @return string
	 */
	function get_content_start() {
	    return "<div class='container'>";
	}
	
	/**
	 * Ends the pages content block
	 * 
	 * @return string
	 */
	function get_content_end() {
	    return "</div>";
	}


	/**
	* Wraps a div with the validation class around a message
	* 
	* @param string $msg 	the message to be wrapped
	* @return string 		the html markup wrapped around the message
	*/
	function wrap_validation_msg($msg){
		return "<div class=\"validation\">{$msg}</div>"; 
	}


}

// notice there is no closing php delimiter for files that are meant to be embedded