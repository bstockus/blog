<?php

// Index Route
Flight::route('/', function (){
    global $da;
    $homepage_content = $da->get_homepage_content();
    render_page('index', 'Bryan Stockus', 'HOME', array('homepage_content'=>$homepage_content));
});

// Image route
Flight::route('/images/@id', function ($id){
    global $da;
    $image = $da->get_image($id, exclude_inactive_posts());
    if ($image !== null) {
        
        if (isset($_GET['thumb'])) {
            $fileName = 'uploads/thumbs/' . $id;
        } else {
            $fileName = 'uploads/' . $id;
        }
        
        //Set the content-type header as appropriate
        $imageInfo = getimagesize($fileName);
        switch ($imageInfo[2]) {
            case IMAGETYPE_JPEG:
                header("Content-Type: image/jpg");
                break;
            case IMAGETYPE_GIF:
                header("Content-Type: image/gif");
                break;
            case IMAGETYPE_PNG:
                header("Content-Type: image/png");
                break;
            default:
                break;
        }
        
        // Set the content-length header
        header('Content-Length: ' . filesize($fileName));
        
        // Write the image bytes to the client
        readfile($fileName);
        
    } else {
        http_response_code(404);
        exit('Not Found');
    }
});