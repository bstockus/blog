<?php

// Middleware Route for Ensuring Session is Authenticated
function authenticate() {
    global $au;
    $au->user_authenticated(false);
    $request = Flight::request();
    if ($au->user_authenticated()) {
        // Session is authenticated, pass the request to the control panel page
        return true;
    } else {
        // Session is not authenticated, user will need to be authenticated
        Flight::redirect(global_url('login?redirect=' . $request->url));
    }
}

// Control Panel, Login Middleware Route
Flight::route('/admin*', 'authenticate');
Flight::route('/admin/*', 'authenticate');

// Control Panel Home page
Flight::route('/admin', function (){
    render_page('admin/index', 'Admin', 'HOME', array(), 'control-panel');
});

?>