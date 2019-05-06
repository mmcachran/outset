<?php
define( 'WP_USE_THEMES', true );
$env = (object) parse_ini_file( '.env' );
require dirname( __FILE__ ) . "/{$env->dir_wp_core}/wp-blog-header.php";