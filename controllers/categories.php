<?php

require_once("includes/ViewHelpers.inc.php");

// Categories Validation function
function validate_category($category, &$errors) {
    $valid = true;
    if ($category['category_name'] === "") {
        $valid = false;
        $errors['category_name'] = "Name can't be empty!";
    } else if (strlen($category['category_name']) > 50) {
        $valid = false;
        $errors['category_name'] = "Name can't be longer than 50 characters in length!";
    }
    return $valid;
}

// Categories Processing function
function process_category(&$category) {
    if (isset($_POST['category_name'])) {
        $category['category_name'] = $_POST['category_name'];
    }
}

// Categories List Page
Flight::route('GET /admin/categories', function (){
    global $da;
    $categories = $da->get_categories();
    render_page('admin/categories/index', 'Admin - Categories', 'CATEGORIES', array('categories' => $categories), 'control-panel');
});

// Categories Create Page
Flight::route('/admin/categories/create', function (){
   $category = array('category_name' => "");
   render_form_page('admin/categories/create', 'admin/categories/_form', 'Admin - Category - Create', 'CATEGORIES', array('category' => $category, 'errors' => array(), 'url' => "admin/categories", 'submit' => "Create"), 'control-panel');
});

// Categories Edit Page
Flight::route('/admin/categories/@id/edit', function ($id){
    global $da;
    $category = $da->get_category($id);
    if ($category !== null) {
        render_form_page('admin/categories/edit', 'admin/categories/_form', 'Admin - Category - Create', 'CATEGORIES', array('category' => $category, 'errors' => array(), 'url' => "admin/categories/" . $id, 'submit' => "Save"), 'control-panel');
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
        process_category($category);
        if (validate_category($category, $errors)) {
            if ($da->update_category($id, $_POST['category_name'])) {
                Flight::redirect(global_url('admin/categories'));
                return;
            } else {
                die('Category Update Error!');
            }
        } else {
            render_form_page('admin/categories/edit', 'admin/categories/_form', 'Admin - Category - Create', 'CATEGORIES', array('category' => $category, 'errors' => $errors, 'url' => "admin/categories/" . $id, 'submit' => "Save"), 'control-panel');
        }
        
    } else {
        die('Not Found!');
    }
});

// Categories Create Handler
Flight::route('POST /admin/categories', function (){
    global $da;
    $category = array('category_name' => "");
    process_category($category);
    $errors = array();
    if (!validate_category($category, $errors)) {
        render_form_page('admin/categories/create', 'admin/categories/_form', 'Admin - Category - Create', 'CATEGORIES', array('category' => $category, 'errors' => $errors, 'url' => "admin/categories", 'submit' => "Create"), 'control-panel');
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