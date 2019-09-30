<?php

namespace _view\setup;

function theme_supports(){
    // General
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' ); // Gives site some extra RSS support
    add_theme_support( 'title-tag' ); // Gives control of <head>'s <title> values
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) ); // adds modern HTML support
    // Block Editor Support
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('dark-editor-style');
    add_theme_support('disable-custom-colors');
    add_theme_support('disable-custom-font-sizes');
    add_theme_support('editor-color-pallete');
    add_theme_support('editor-font-sizes');
    add_theme_support('editor-styles,');
    add_theme_support('wp-block-styles');
}

function menus(){
    register_nav_menus( array(
		'primary' => 'Primary Menu',
		'footer' => 'Footer menu',
	) );
}