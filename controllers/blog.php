<?php

$month_names = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");

function get_sidebar_collections($da, $exclude) {
    $sidebar_collections = array();
    $sidebar_collections['categories'] = $da->get_categories_with_post_counts($exclude);
    $sidebar_collections['dates'] = $da->get_posts_by_date($exclude);
    return $sidebar_collections;
}

// Blog Home route
Flight::route('GET /blog', function (){
    global $da;
    $exclude = exclude_inactive_posts();
    $posts = $da->get_posts($exclude);
    $categories = $da->get_categories_with_post_counts($exclude);
    render_blog_list_page('index', 'Blog - Home', array('posts'=>$posts, 'sidebar_collections'=>get_sidebar_collections($da, $exclude), 'edits_allowed'=>edits_allowed(), 'this_url'=>'blog'));
});

// Blog Post route
Flight::route('GET /blog/posts/@id', function ($id){
    global $da;
    $exclude = exclude_inactive_posts();
    $post = $da->get_post($id, $exclude);
    if ($post !== null) {
        render_blog_post_page('post', 'Blog - Post - ' . $post['post_title'], array('post'=>$post, 'edits_allowed'=>edits_allowed(), 'this_url'=>'blog/posts/' . $id, 'sidebar_collections'=>get_sidebar_collections($da, $exclude), 'edits_allowed'=>edits_allowed()));
    } else {
        die('Not Found!');
    }
});

// Blog Category List route
Flight::route('GET /blog/categories/@id', function ($id){
    global $da;
    $exclude = exclude_inactive_posts();
    $category = $da->get_category($id);
    $categories = $da->get_categories_with_post_counts($exclude);
    if ($category !== null) {
        render_blog_list_page('list', 'Blog - Category - ' . $category['category_name'], array('title'=>"Category Posts" ,'subTitle'=> $category['category_name'], 'posts'=>$da->get_posts_for_category($id, $exclude), 'sidebar_collections'=>get_sidebar_collections($da, $exclude), 'current_category_id'=>$category['category_id'], 'edits_allowed'=>edits_allowed(), 'this_url'=>'blog/categories/' . $id));
    } else {
        die('Category Not Found!');
    }
});

// Blog Users route
Flight::route('GET /blog/users/@id', function ($id){
    global $da;
    $exclude = exclude_inactive_posts();
    $categories = $da->get_categories_with_post_counts(true);
    $user = $da->get_user($id);
    if ($user !== null) {
        render_blog_list_page('list', 'Blog - User - ' . $user['user_display_name'], array('title'=>"User's Posts" ,'subTitle'=> $user['user_display_name'], 'posts'=>$da->get_posts_for_user($id, $exclude), 'sidebar_collections'=>get_sidebar_collections($da, $exclude), 'edits_allowed'=>edits_allowed(), 'this_url'=>'blog/users/' . $id));
    } else {
        die('User Not Found!');
    }
});

// Blog Months route
Flight::route('GET /blog/@year/@month', function ($year, $month){
    global $da;
    global $month_names;
    $exclude = exclude_inactive_posts();
    $categories = $da->get_categories_with_post_counts($exclude);
    if (is_numeric($year) && is_numeric($month) && $month > 0 && $month < 13) {
        $month_name = $month_names[intval($month)];
        $posts = $da->get_posts_for_date_range($year, $month, $exclude);
        render_blog_list_page('list', 'Blog - ' . $month_name . ' ' . $year, array('title'=>"Posts" ,'subTitle'=> $month_name . ' ' . $year, 'posts'=>$posts, 'sidebar_collections'=>get_sidebar_collections($da, $exclude), 'edits_allowed'=>edits_allowed(), 'this_url'=>'blog/' . $year . '/' . $month, 'current_date'=>array('year'=>$year, 'month'=>$month)));
    } else {
        die('Invalid Date Range!');
    }
    
});

// Blog Search route
Flight::route('/search', function (){
    global $da;
    $exclude = exclude_inactive_posts();
    $query = "";
    if (isset($_GET['q'])) {
        $query = $_GET['q'];
    }
    $posts = $da->get_posts_for_search_query($query, $exclude);
    $values = array('query'=>$query, 'posts'=>$posts, 'edits_allowed'=>edits_allowed(), 'this_url'=>'search?q=' . urlencode($query));
    Flight::render('blog/_list', $values, 'list');
    render_page('blog/search', 'Blog - Search', 'BLOG', $values);
});