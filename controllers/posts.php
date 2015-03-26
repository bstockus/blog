<?php

// Posts List Page
Flight::route('GET /admin/posts', function (){
    global $da;
    $posts = $da->get_posts();
    render_page('admin/posts/index', 'Admin - Posts', 'POSTS', array('posts' => $posts), 'control-panel');
});

//Posts Create Page
Flight::route('/admin/posts/create', function (){
    global $da;
    $categories = $da->get_categories();
    $post = array('post_id'=>"", 'post_title'=>"", 'post_description'=>"", 'category_id'=>"", 'post_active'=>"no");
    render_page('admin/posts/create', 'Admin - Posts - Create', 'POSTS', array('post' => $post, 'categories' => $categories, 'errors' => array()), 'control-panel');
});

// Posts Edit Page
Flight::route('/admin/posts/@id/edit', function ($id){
    global $da;
    $post = $da->get_post($id);
    $categories = $da->get_categories();
    //die(var_dump($post));
    if ($post !== null) {
        render_page('admin/posts/edit', 'Admin - Posts - Edit', 'POSTS', array('post' => $post, 'categories' => $categories, 'error' => ""), 'control-panel');
    } else {
        die('Not Found!');
    }
});

// Posts Create Handler
Flight::route('POST /admin/posts', function (){
    global $da;
    $categories = $da->get_categories();
    $post = array('post_id'=>"", 'post_title'=>"", 'post_description'=>"", 'category_id'=>"", 'post_active'=>"no");
    $errors = array();
    $valid = true;
    if (isset($_POST['post_title'])) {
        $post['post_title'] = $_POST['post_title'];
    }
    if (isset($_POST['post_description'])) {
        $post['post_description'] = $_POST['post_description'];
    }
    if (isset($_POST['category_id'])) {
        $valid = false;
        foreach($categories as $category) {
            if ($category['category_id'] == $_POST['category_id']) {
                $valid = true;
                break;
            }
        }
        if (!$valid) {
            die('Invalid Category ID');
        } else {
            $post['category_id'] = $_POST['category_id'];
        }
    }
    if (!isset($_POST['post_active'])) {
        $post['post_active'] = "no";
    } else {
        $post['post_active'] = "yes";
    }
    if ($post['post_title'] === "") {
        $valid = false;
        $errors['post_title'] = "Title can't be empty!";
    }
    if ($post['post_description'] === "") {
        $valid = false;
        $errors['post_description'] = "Description can't be empty!";
    }
    if (!$valid) {
        render_page('admin/posts/create', 'Admin - Posts - Create', 'POSTS', array('post' => $post, 'categories' => $categories, 'errors' => $errors), 'control-panel');
        return;
    } else {
        if ($da->create_post($post) !== null) {
            Flight::redirect(global_url('admin/posts'));
        } else {
            die('Post Create Error!');
        }
    }
});

// Posts Update Handler
Flight::route('POST /admin/posts/@id', function ($id){
    global $da;
    $post = $da->get_post($id);
    $categories = $da->get_categories();
    //die(var_dump($_POST));
    if (isset($_POST['post_title'])) {
        $post['post_title'] = $_POST['post_title'];
    }
    if (isset($_POST['post_description'])) {
        $post['post_description'] = $_POST['post_description'];
    }
    if (isset($_POST['category_id'])) {
        $valid = false;
        foreach($categories as $category) {
            if ($category['category_id'] == $_POST['category_id']) {
                $valid = true;
                break;
            }
        }
        if (!$valid) {
            die('Invalid Category ID');
        } else {
            $post['category_id'] = $_POST['category_id'];
        }
    }
    if (!isset($_POST['post_active'])) {
        $post['post_active'] = "no";
    } else {
        $post['post_active'] = "yes";
    }
    if($post !== null) {
        if ($da->update_post($id, $post)) {
            Flight::redirect(global_url('admin/posts'));
        } else {
            render_page('admin/posts/edit', 'Admin - Posts - Edit', 'POSTS', array('post' => $post, 'categories' => $categories, 'error' => "Unable to Update Post!"), 'control-panel');
        }
    } else {
        die('Not Found!');
    }
});

?>