<!DOCTYPE html>
<html>
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="{$page_description}">
    <meta name="viewport" content="width=device-width">
    
    <title><?php echo $page_title ?></title>
    
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo_global_url('css/sticky.css'); ?>" type="text/css">
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
  </head>
  <body>
    <?php echo $navbar; ?>
    
    <div class='container'>
        <?php echo $content; ?>
    </div>
    
    <footer class="footer">
    	<div class="container">
    		&copy; 2015 Bryan Stockus, All Rights Reserved.    |    
    		<a href="<?php echo_global_url('privacy-policy'); ?>">Privacy Policy</a>    |    
    		<a href="<?php echo_global_url('contact'); ?>">Contact</a>
    	</div>
    </footer>
  </body>
</html>