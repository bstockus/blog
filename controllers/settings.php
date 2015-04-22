<?php

Flight::route('GET /admin/settings', function (){
    global $da;
    $settings = $da->get_settings();
    //$settings = $settings[0];
    $errors = array();
    render_page('admin/settings/settings', "Settings", "SETTINGS", array('settings'=>$settings, 'errors'=>$errors, 'flash'=>""), 'control-panel');
});

Flight::route('POST /admin/settings', function (){
    global $da;
    
    $settings = array("notification_email_address"=>"", "homepage_content"=>"");
    $errors = array();
    
    if (isset($_POST['notification_email_address'])) {
        $settings['notification_email_address'] = $_POST['notification_email_address'];
    }
    
    if (isset($_POST['homepage_content'])) {
        $settings['homepage_content'] = $_POST['homepage_content'];
    }
    
    $valid = true;
    $valid = validateNotEmptyAndMaxLength($valid, $settings, 'notification_email_address', $errors, 'Notification Email', 255);
    $valid = validateNotEmpty($valid, $settings, 'homepage_content', $errors, 'Homepage Content');
    
    if ($valid && !filter_var($settings['notification_email_address'], FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $errors['notification_email_address'] = "Please enter a valid email address.";
    }
    
    if ($valid) {
        $da->set_settings($settings);
        render_page('admin/settings/settings', "Settings", "SETTINGS", array('settings'=>$settings, 'errors'=>$errors, 'flash'=>"Setings Saved."), 'control-panel');
    } else {
        render_page('admin/settings/settings', "Settings", "SETTINGS", array('settings'=>$settings, 'errors'=>$errors, 'flash'=>""), 'control-panel');
    }
    
});