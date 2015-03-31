<?php

$navs = "<ul class='nav navbar-nav'>";

foreach($nav_links as $link){
	
	$selected_class_name = "";
	$url = global_url($link['url']);
	$text = $link['text'];

	if($text == $selected_item){
		$selected_class_name = "active";
	}

	$navs .= "<li class=\"{$selected_class_name}\"><a href=\"{$url}\">{$text}</a>";
}

$navs .= "</ul>";

$au = new AdminUtils();
$user = "";
if ($au->user_authenticated()) {
    $user = "<ul class='nav navbar-nav navbar-right'><li><a href='#'><i class='fa fa-user'></i> " . $_SESSION['user_display_name'] . "</a></li></ul>";
}

?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Bryan Stockus</a>
        </div>
        <div id='navbar' class='collapse navbar-collapse'>
            <?php echo $navs; ?>
            <?php echo $user; ?>
        </div>
    </div>
</nav>