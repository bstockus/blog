<?php

// Categories List Page
Flight::route('GET /admin/categories', function (){
    global $da;
    $categories = $da->get_categories();
    render_page('admin/categories/index', 'Admin - Categories', 'CATEGORIES', array('categories' => $categories), 'control-panel');
});

// Categories Create Page
Flight::route('/admin/categories/create', function (){
   $category = array('category_name' => "");
   render_page('admin/categories/create', 'Admin - Category - Create', 'CATEGORIES', array('category' => $category, 'errors' => array()), 'control-panel');
});

// Categories Edit Page
Flight::route('/admin/categories/@id/edit', function ($id){
    global $da;
    $category = $da->get_category($id);
    if ($category !== null) {
        render_page('admin/categories/edit', 'Admin - Category - Edit', 'CATEGORIES', array('category' => $category, 'error' => ""), 'control-panel');
    } else {
        die('Not Found!');
    }
});

// Categories Update Handler
Flight::route('POST /admin/categories/@id', function ($id){
    global $da;
    $category = $da->get_category($id);
    if ($category !== null) {
        $errors = array();
        $valid = true;
        if (isset($_POST['category_name'])) {
            $category['category_name'] = $_POST['category_name'];
        }
        if ($category['category_name'] === "") {
            $valid = false;
            $errors['category_name'] = "Name can't be empty!";
        }
        if ($valid) {
            if ($da->update_category($id, $_POST['category_name'])) {
                Flight::redirect(global_url('admin/categories'));
                return;
            } else {
                die('Category Update Error!');
            }
        } else {
            render_page('admin/categories/edit', 'Admin - Category - Edit', 'CATEGORIES', array('category' => $category, 'errors' => $errors), 'control-panel');
        }
        
    } else {
        die('Not Found!');
    }
});

// Categories Create Handler
Flight::route('POST /admin/categories', function (){
    global $da;
    $category = array('category_name' => "");
    if (isset($_POST['category_name'])) {
        $category['category_name'] = $_POST['category_name'];
    }
    $errors = array();
    $valid = true;
    if ($category['category_name'] === "") {
        $valid = false;
        $errors['category_name'] = "Name can't be empty!";
    }
    if (!$valid) {
        render_page('admin/categories/create', 'Admin - Categories - Create', 'POSTS', array('category' => $category, 'errors' => $errors), 'control-panel');
        return;
    } else {
        if ($da->create_category($category) !== null) {
            Flight::redirect(global_url('admin/categories'));
        } else {
            die('Category Create Error!');
        }
    }
});

?>