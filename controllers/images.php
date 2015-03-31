<?php

require_once("includes/ViewHelpers.inc.php");

// Images List Page
Flight::route('GET /admin/images', function (){
    global $da;
    $images = $da->get_images();
    render_page('admin/images/index', 'Admin - Images', 'IMAGES', array('images' => $images), 'control-panel');
});

// Images Upload Page
Flight::route('/admin/images/create', function (){
    render_page('admin/images/upload', 'Admin - Images - Upload', 'IMAGES', array('error' => ""), 'control-panel');
});

// Images Upload Handler
Flight::route('POST /admin/images', function (){
    global $da;
    $image = array();
    if (!isset($_POST['image_filename']) || $_POST['image_filename'] === "") {
        render_page('admin/images/upload', 'Admin - Images - Upload', 'IMAGES', array('error' => "You must specify a filename for the image!"), 'control-panel');
        return;
    } else {
        $image['image_filename'] = $_POST['image_filename'];
    }
    if (!isset($_POST['image_active'])) {
        $image['image_active'] = "no";
    } else {
        $image['image_active'] = "yes";
    }
    $id = $da->create_image($image);
    if ($id !== null) {
        $check = getimagesize($_FILES["image_file"]["tmp_name"]);
        if($check !== false) {
            if (move_uploaded_file($_FILES["image_file"]["tmp_name"], "uploads/" . $id)) {
                Flight::redirect(global_url('admin/images'));
            } else {
                render_page('admin/images/upload', 'Admin - Images - Upload', 'IMAGES', array('error' => "Error Uploading Image!"), 'control-panel');
                $da->delete_image($id);
            }
        } else {
            render_page('admin/images/upload', 'Admin - Images - Upload', 'IMAGES', array('error' => "Not an Image File!"), 'control-panel');
            $da->delete_image($id);
        }
    } else {
        render_page('admin/images/upload', 'Admin - Images - Upload', 'IMAGES', array('error' => "Unable to create image!"), 'control-panel');
    }
});

?>