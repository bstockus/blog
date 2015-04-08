<?php

// Blog Home route
Flight::route('GET /blog', function (){
    
});

// Blog Post route
Flight::route('GET /blog/posts/@id', function ($id){
    global $da;
    $post = $da->get_post($id);
    if ($post !== null) {
        render_page('blog/post', 'Blog - Post - ' . $post['post_title'], 'BLOG', array('post'=>$post));
    } else {
        die('Not Found!');
    }
});

// Blog Category List route
Flight::route('GET /blog/categories/@id', function ($id){
    
});

// Blog Months route
Flight::route('GET /blog/@year/@month', function ($year, $month){
    
});