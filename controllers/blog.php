<?php

$month_names = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");

// Blog Home route
Flight::route('GET /blog', function (){
    global $da;
    $posts = $da->get_posts(true);
    $categories = $da->get_categories();
    render_page('blog/index', 'Blog - Home', 'BLOG', array('posts'=>$posts, 'categories'=>$categories));
});

// Blog Post route
Flight::route('GET /blog/posts/@id', function ($id){
    global $da;
    $post = $da->get_post($id, true);
    if ($post !== null) {
        render_page('blog/post', 'Blog - Post - ' . $post['post_title'], 'BLOG', array('post'=>$post));
    } else {
        die('Not Found!');
    }
});

// Blog Category List route
Flight::route('GET /blog/categories/@id', function ($id){
    global $da;
    $category = $da->get_category($id);
    if ($category !== null) {
        render_page('blog/list', 'Blog - Category - ' . $category['category_name'], 'BLOG', array('title'=> $category['category_name'], 'posts'=>$da->get_posts_for_category($id, true)));
    } else {
        die('Category Not Found!');
    }
});

// Blog Users route
Flight::route('GET /blog/users/@id', function ($id){
    global $da;
    $user = $da->get_user($id);
    if ($user !== null) {
        render_page('blog/list', 'Blog - User - ' . $user['user_display_name'], 'BLOG', array('title'=> 'User ' . $user['user_display_name'], 'posts'=>$da->get_posts_for_user($id, true)));
    } else {
        die('User Not Found!');
    }
});

// Blog Months route
Flight::route('GET /blog/@year/@month', function ($year, $month){
    global $da;
    global $month_names;
    if (is_numeric($year) && is_numeric($month) && $month > 0 && $month < 13) {
        $month_name = $month_names[$month];
        $posts = $da->get_posts_for_date_range($year . '-' . $month . '-01', $year . '-' . $month . '-31', true);
        render_page('blog/list', 'Blog - ' . $month_name . ' ' . $year, 'BLOG', array('title'=> $month_name . ' ' . $year, 'posts'=>$posts));
    } else {
        die('Invalid Date Range!');
    }
    
});