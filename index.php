<?php
include("includes/common.inc.php");
require_once("includes/PageUtils.inc.php");

$pu = new PageUtils();
$meta_title = "This is the home page";
$meta_description = "This is the description of the page";

echo($pu->get_header($meta_title, $meta_description));
echo($pu->get_main_navigation("HOME"));

$content = <<<EOD
<h3>Welcome to this website, here is some Lorem Ipsum</h3>
<p>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur laoreet, nulla ut fermentum suscipit, est nulla vestibulum urna, vel venenatis nunc dolor vitae nulla. Vestibulum tristique erat id enim sagittis, sed gravida ligula tincidunt. Ut sed tortor a leo molestie varius sed sed lorem. Sed lobortis ante eget lorem accumsan ultrices. Mauris porta lorem eu tellus dictum, ac sollicitudin purus tempus. Fusce nibh tellus, vestibulum sit amet tortor at, convallis ullamcorper diam. Praesent malesuada nisi et maximus varius. Aenean at enim vulputate, porta metus eget, volutpat dui. Sed non justo et lectus euismod facilisis ut vitae sem. Vivamus quis laoreet magna. Praesent augue mi, molestie ut viverra at, lobortis at arcu. Suspendisse potenti. Cras pellentesque quis ligula et sagittis. 
</p>
<p>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur laoreet, nulla ut fermentum suscipit, est nulla vestibulum urna, vel venenatis nunc dolor vitae nulla. Vestibulum tristique erat id enim sagittis, sed gravida ligula tincidunt. Ut sed tortor a leo molestie varius sed sed lorem. Sed lobortis ante eget lorem accumsan ultrices. Mauris porta lorem eu tellus dictum, ac sollicitudin purus tempus. Fusce nibh tellus, vestibulum sit amet tortor at, convallis ullamcorper diam. Praesent malesuada nisi et maximus varius. Aenean at enim vulputate, porta metus eget, volutpat dui. Sed non justo et lectus euismod facilisis ut vitae sem. Vivamus quis laoreet magna. Praesent augue mi, molestie ut viverra at, lobortis at arcu. Suspendisse potenti. Cras pellentesque quis ligula et sagittis. 
</p>
EOD;

echo($pu->get_page_content($content, "Bryan Stockus"));
echo($pu->get_footer());
