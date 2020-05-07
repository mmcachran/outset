<?php

namespace _view\enqueues;

use function _view\utils\register_script;
use function _view\utils\register_style;
use function _view\utils\load_style;
use function _view\utils\load_script;
use function _view\utils\localize_script_data;

function admin_registrations() {
	$current_screen = get_current_screen();

	if ( $current_screen->is_block_editor() ) {
		// block editor specific
	}

	register_style( 'admin', 'dist/styles/admin.css' );
	load_style( 'admin' );

	register_script( 'admin', 'dist/scripts/admin.js' );
	load_script( 'admin' );
}

function registrations() {
	$localized = [
		'debug'        => WP_DEBUG,
		'is_search'    => is_search(),
		'is_logged_in' => is_user_logged_in(),
		'urls'         => [
			'endpoint'  => esc_url_raw( get_rest_url( null, 'wp/v2/' ) ),
			'root'      => home_url(),
			'local'     => wp_parse_url( home_url(), PHP_URL_HOST ),
			'ajax'      => admin_url( 'admin-ajax.php' ),
			'admin'     => admin_url(),
			'theme'     => get_template_directory_uri(),
			'edit_post' => admin_url( 'post.php?post=%%post_id%%&action=edit' ),
		],
		'site'         => [
			'name' => get_bloginfo( 'name' ),
		],
	];

	register_script( 'main', 'dist/scripts/main.js', null, 1.0, false, true, true );
	localize_script_data( 'main', 'globals', $localized );
	load_script( 'main' );
	register_style( 'home', 'dist/styles/home.css' );

	register_style( 'normalize', 'dist/styles/normalize.css' );
	load_style( 'normalize' );

	register_style( 'tailwind', 'dist/styles/tailwind.css' );
	load_style( 'tailwind' );

	register_style( 'main', 'dist/styles/main.css' );
	load_style( 'main' );

	register_script( 'lozad', 'dist/vendors/lozad.js' );
	load_script( 'lozad' );

	register_style( 'flickity', 'dist/vendors/flickity.css' );
	load_style( 'flickity' );

	register_style( 'flickity-fade', 'dist/vendors/flickity-fade.css' );
	load_style( 'flickity-fade' );

	register_script( 'flickity', 'dist/vendors/flickity.pkgd.min.js' );
	load_script( 'flickity' );

	register_script( 'flickity-fade', 'dist/vendors/flickity-fade.js' );
	load_style( 'flickity-fade' );
}

function handle_async( $html, $handle, $src ) {
	if ( in_array( $handle, apply_filters( 'view/enqueues/async', [] ), true ) ) {
		return substr_replace( $html, "async='async' ", strpos( $html, "type='text/javascript' " ), 0 );
	}

	return $html;
}

function handle_defer( $html, $handle, $src ) {
	if ( in_array( $handle, apply_filters( 'view/enqueues/defer', [] ), true ) ) {
		return substr_replace( $html, "defer='defer' ", strpos( $html, "type='text/javascript' " ), 0 );
	}

	return $html;
}
