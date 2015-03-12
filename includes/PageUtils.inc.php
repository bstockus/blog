<?php
/**
* Utility class for pages
*
* This class contains methods that are useful in constructing pages.
*
*/
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
        
        $normalize_css_url = global_url('css/normalize.css');
        $style_css_url = global_url('css/style.css');
        
$str = <<<EOD
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="{$page_description}">
    <meta name="viewport" content="width=device-width">
    <title>{$page_title}</title>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    
    <link REL=StyleSheet HREF="{$normalize_css_url}" TYPE="text/css">
    <link REL=StyleSheet HREF="{$style_css_url}" TYPE="text/css">
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
	    
$str = <<<EOD
<div id="footer-ct">
	<div id="footer" class="page-width">
		&copy; 2015 Bryan Stockus, All Rights Reserved.    |    
		<a href="{$privacy_policy_link_url}">Privacy Policy</a>    |    
		<a href="{$contact_link_url}">Contact</a>
	</div>
</div>
</body>
</html>
EOD;
		return $str;		
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

		$nav_menus = get_nav_menus();
		
		$nav_links = $nav_menus[$menu_id];
		
		$str = "<div id=\"main-nav-ct\">
					<div id=\"main-nav\" class=\"page-width\">
						<ul>";

		foreach($nav_links as $link){
			
			$selected_class_name = "";
			$url = global_url($link['url']);
			$text = $link['text'];

			if($text == $selected_item){
				$selected_class_name = "selected";
			}

			$str .= "<li><a href=\"{$url}\" class=\"{$selected_class_name}\">{$text}</a></link>";
		}

		$str .= "</ul>
			</div>
		</div>";

		return $str;		
	}



	/**
	* Assembles the markup for the page banner
	*
	* @return string the html markup for the banner
	*/
	function get_banner(){

$str = <<<EOD
<div id="banner-ct">
	<div id="banner" class="page-width">
		<h1>This is the banner</h1>
	</div>
</div>
EOD;
		return $str;		
	}



	/**
	* Assembles the markup for the main content of the page, the content get wrapped
	* divs that allow for consistent styling
	*
	* @param string $content 	the content of the page
	*
	* @return string the html markup for the content
	*/
	function get_page_content($content){
		$str = "<div class=\"page-width\">
					<div class=\"content\">
					{$content}
					</div>
				</div>";

		return $str;
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