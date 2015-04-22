<?php

$navs = "<ul class='nav navbar-nav'>";

foreach($nav_links as $link){
	
	$selected_class_name = "";
	$url = global_url($link['url']);
	$text = $link['text'];

	if($text == $selected_item){
		$selected_class_name = "active";
	}

	$navs .= "<li class=\"{$selected_class_name}\"><a href=\"{$url}\">{$text}</a></li>";
}

$navs .= "</ul>";

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
            <a class="navbar-brand" href="<?php echo_global_url(''); ?>">
                Bryan Stockus
<?php
                if ($navbar === 'control-panel') {
?>
                    <span class="label label-default">CONTROL PANEL</span>
<?php
                }
?>
            </a>
        </div>
        <div id='navbar' class='collapse navbar-collapse'>
            <?php echo $navs; ?>
            <ul class='nav navbar-nav navbar-right'>
                <?php echo $user; ?>
            </ul>
<?php
            if ($navbar !== 'control-panel') {
?>
                <form method="GET" action="<?php echo_global_url('search'); ?>" class="search-form navbar-form navbar-right">
                    <div class="form-group has-feedback">
                		<label for="search" class="sr-only">Search</label>
                		<input type="text" class="form-control" name="q" id="search" placeholder="">
                  		<span class="glyphicon glyphicon-search form-control-feedback"></span>
                	</div>
                </form>
<?php
            }
?>
        </div>
    </div>
</nav>