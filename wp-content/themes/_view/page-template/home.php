<?php
/**
* Template Name: Home Template
* Template Post Type: page
*/

get_header();
do_action( '_view/template/home', apply_filters( '_view/template/home/data', [] ) );
get_footer();
