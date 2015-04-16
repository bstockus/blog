<?php

require_once('FormHelpers.inc.php');

function render_page($view, $title, $navbar_id, $values, $navbar = 'main') {
    Flight::render('_user', array('navbar' => $navbar), 'user');
    Flight::render('_navbar', array('nav_links' => get_nav_menus()[$navbar], 'selected_item' => $navbar_id, 'navbar' => $navbar), 'navbar');
    Flight::render($view, $values, 'content');
    Flight::render('layout', array('page_title' => $title));
}

function render_form_page($base, $view, $title, $navbar_id, $values, $navbar = 'main') {
    Flight::render($base . '/_form', $values, 'form');
    render_page($base . '/' . $view, $title, $navbar_id, $values, $navbar);
}

function render_form_page_with_image_gallery($base, $view, $title, $navbar_id, $values, $navbar = 'main') {
    //$values['stylesheets'] = array();
    $values['scripts'] = array('https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.1/handlebars.min.js', global_url('js/image-gallery.js'));
    FLight::render($base . '/_imagesPickerModal', array(), 'modal');
    render_form_page($base, $view, $title, $navbar_id, $values, $navbar);
}

function render_list_page($base, $view, $title, $navbar_id, $values, $navbar = 'main') {
    Flight::render($base . '/_list', $values, 'list');
    render_page($base . '/' . $view, $title, $navbar_id, $values, $navbar);
}

function render_blog_list_page($view, $title, $values) {
    Flight::render('blog/_sidebar', $values, 'sidebar');
    Flight::render('blog/_list', $values, 'list');
    render_page('blog/' . $view, $title, 'BLOG', $values);
}

function render_blog_post_page($view, $title, $values) {
    Flight::render('blog/_sidebar', $values, 'sidebar');
    render_page('blog/' . $view, $title, 'BLOG', $values);
}

function exclude_inactive_posts() {
    global $au;
    if ($au->user_authenticated()) {
        return false;
    } else {
        return true;
    }
}

function edits_allowed() {
    global $au;
    if ($au->user_authenticated()) {
        return true;
    } else {
        return false;
    }
}