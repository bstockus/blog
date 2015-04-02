<?php

require_once('FormHelpers.inc.php');

function render_page($view, $title, $navbar_id, $values, $navbar = 'main') {
    Flight::render('_navbar', array('nav_links' => get_nav_menus()[$navbar], 'selected_item' => $navbar_id), 'navbar');
    Flight::render($view, $values, 'content');
    Flight::render('layout', array('page_title' => $title));
}

function render_form_page($base, $view, $title, $navbar_id, $values, $navbar = 'main') {
    Flight::render('_navbar', array('nav_links' => get_nav_menus()[$navbar], 'selected_item' => $navbar_id), 'navbar');
    Flight::render($base . '/_form', $values, 'form');
    Flight::render($base . '/' . $view, $values, 'content');
    Flight::render('layout', array('page_title' => $title));
}

function render_list_page($base, $view, $title, $navbar_id, $values, $navbar = 'main') {
    Flight::render('_navbar', array('nav_links' => get_nav_menus()[$navbar], 'selected_item' => $navbar_id), 'navbar');
    Flight::render($base . '/_list', $values, 'list');
    Flight::render($base . '/' . $view, $values, 'content');
    Flight::render('layout', array('page_title' => $title));
}

?>