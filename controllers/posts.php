<?php

// Posts Validation function
function validate_post($post, $posts, $categories, &$errors) {
    $valid = false;
    foreach($categories as $category) {
        if ($category['category_id'] == $post['category_id']) {
            $valid = true;
            break;
        }
    }
    if (!$valid) {
        $errors['category_id'] = "You must select a valid Category for this Post!";
    } else {
        $valid = validateNotEmptyAndMaxLength($valid, $post, 'post_short_title', $errors, 'Short Title', 100);
        if ($valid) {
            foreach($posts as $test_post) {
                if($test_post['post_id'] != $post['post_id'] && $test_post['post_short_title'] == $post['post_short_title']) {
                    $valid = false;
                    $errors['post_short_title'] = "You must enter a unique Short Title for this post";
                    break;
                }
            }
        }
    }
    
    $valid = validateNotEmptyAndMaxLength($valid, $post, 'post_title', $errors, 'Title', 100);
    $valid = validateNotEmptyAndMaxLength($valid, $post, 'post_description', $errors, 'Description', 160);
    $valid = validateNotEmpty($valid, $post, 'post_content', $errors, 'Content');
    
    return $valid;
}

// Posts Processing function
function process_post(&$post) {
    if (isset($_POST['post_title'])) {
        $post['post_title'] = $_POST['post_title'];
    }
    if (isset($_POST['post_short_title'])) {
        $post['post_short_title'] = $_POST['post_short_title'];
    }
    if (isset($_POST['post_description'])) {
        $post['post_description'] = $_POST['post_description'];
    }
    if (isset($_POST['category_id'])) {
        $post['category_id'] = $_POST['category_id'];
    }
    if (isset($_POST['post_content'])) {
        $post['post_content'] = $_POST['post_content'];
    }
    if (!isset($_POST['post_active'])) {
        $post['post_active'] = "no";
    } else {
        $post['post_active'] = "yes";
    }
}

// Posts List Page
Flight::route('GET /admin/posts', function (){
    global $da;
    $posts = $da->get_posts();
    render_list_page('admin/posts', 'index', 'Admin - Posts', 'POSTS', array('posts' => $posts), 'control-panel');
});

//Posts Create Page
Flight::route('/admin/posts/create', function (){
    global $da;
    $categories = $da->get_categories();
    $redirect = 'admin/posts';
    if (isset($_GET['redirect'])) {
        $redirect = $_GET['redirect'];
    }
    $post = array('post_id'=>"", 'post_title'=>"", 'post_short_title'=>"", 'post_description'=>"", 'category_id'=>null, 'post_active'=>"no", 'post_content'=>"", 'post_type'=>"html");
    render_form_page_with_image_gallery('admin/posts', 'create', 'Admin - Posts - Create', 'POSTS', array('post' => $post, 'categories' => $categories, 'errors' => array(), 'url' => "admin/posts", 'submit' => "Create", 'redirect' => $redirect), 'control-panel');
});

// Posts Edit Page
Flight::route('/admin/posts/@id/edit', function ($id){
    global $da;
    $post = $da->get_post($id);
    $categories = $da->get_categories();
    $redirect = 'admin/posts';
    if (isset($_GET['redirect'])) {
        $redirect = $_GET['redirect'];
    }
    if ($post !== null) {
        render_form_page_with_image_gallery('admin/posts', 'edit', 'Admin - Posts - Edit', 'POSTS', array('post' => $post, 'categories' => $categories, 'errors' => array(), 'url' => "admin/posts/" . $id, 'submit' => "Save", 'redirect' => $redirect), 'control-panel');
    } else {
        die('Not Found!');
    }
});

// Posts Create Handler
Flight::route('POST /admin/posts', function (){
    //die(var_dump($_POST));
    global $da;
    $categories = $da->get_categories();
    $posts = $da->get_posts();
    $post = array('post_id'=>"", 'post_title'=>"", 'post_description'=>"", 'category_id'=>null, 'post_active'=>"no", 'user_id'=>$_SESSION['user_id'], 'post_short_title'=>"", 'post_type'=>"html");
    $redirect = 'admin/posts';
    if (isset($_POST['redirect'])) {
        $redirect = $_POST['redirect'];
    }
    $errors = array();
    process_post($post);
    if (!validate_post($post, $posts, $categories, $errors)) {
        render_form_page('admin/posts', 'create', 'Admin - Posts - Create', 'POSTS', array('post' => $post, 'categories' => $categories, 'errors' => $errors, 'url' => "admin/posts", 'submit' => "Create", 'redirect' => $redirect), 'control-panel');
        return;
    } else {
        $post['post_raw_content'] = strip_tags($post['post_content']);
        if ($da->create_post($post) !== null) {
            Flight::redirect(global_url($redirect));
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
    $posts = $da->get_posts();
    $redirect = 'admin/posts';
    if (isset($_POST['redirect'])) {
        $redirect = $_POST['redirect'];
    }
    $errors = array();
    process_post($post);
    if($post !== null) {
        if (validate_post($post, $posts, $categories, $errors)) {
            
            if ($da->update_post($id, $post)) {
                Flight::redirect(global_url($redirect));
            } else {
                die('Unable to update post!');
            }
        } else {
            render_form_page('admin/posts', 'edit', 'Admin - Posts - Edit', 'POSTS', array('post' => $post, 'categories' => $categories, 'errors' => $errors, 'url' => "admin/posts/" . $id, 'submit' => "Save", 'redirect' => $redirect), 'control-panel');
        }
        
    } else {
        die('Not Found!');
    }
});

// Posts Delete Page
Flight::route('GET /admin/posts/@id/remove', function ($id){
    global $da;
    $post = $da->get_post($id);
    if($post !== null) {
        $redirect = "admin/posts";
        if (isset($_GET['redirect'])) {
            $redirect = $_GET['redirect'];
        }
        render_admin_page('admin/posts', 'delete', 'Admin - Posts - Delete', 'POSTS', array('post' => $post, 'url' => 'admin/posts/' . $id . '/remove', 'redirect'=>$redirect), 'control-panel');
    } else {
        die('Not Found!');
    }
});

// Posts Delete Handler
Flight::route('POST /admin/posts/@id/remove', function ($id){
    global $da;
    $post = $da->get_post($id);
    if($post !== null) {
        $redirect = "admin/posts";
        if (isset($_POST['redirect'])) {
            $redirect = $_POST['redirect'];
        }
        $da->delete_post($id);
        Flight::redirect(global_url($redirect));
    } else {
        die('Not Found!');
    }
});