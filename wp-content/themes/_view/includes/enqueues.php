<?php

namespace _view\enqueues;

use function _view\utils\register_script;
use function _view\utils\register_style;
use function _view\utils\load_style;
use function _view\utils\load_script;
use function _view\utils\localize_script_data;

function registrations() {
	global $is_IE;

	$localized = [
		'debug'           => WP_DEBUG,
		'is_search'       => is_search(),
		'is_logged_in'    => is_user_logged_in(),
		'urls'            => [
			'endpoint'  => esc_url_raw( get_rest_url( null, 'wp/v2/' ) ),
			'root'      => home_url(),
			'local'     => wp_parse_url( home_url(), PHP_URL_HOST ),
			'ajax'      => admin_url( 'admin-ajax.php' ),
			'admin'     => admin_url(),
			'theme'     => get_template_directory_uri(),
			'edit_post' => admin_url( 'post.php?post=%%post_id%%&action=edit' ),
		],
		'site'            => [
			'name' => get_bloginfo( 'name' ),
		],
	];

	register_script( 'main', 'dist/scripts/main.js', null, 1.0, false, true, true);
	localize_script_data( 'main', 'globals', $localized );
	load_script('main');

	register_style( 'main', 'dist/styles/main.css' );
	load_style( 'main' );

	register_script( 'lozad', 'dist/vendors/lozad.js' );
	load_style( 'lozad' );

	if ( $is_IE ) {
		register_script( 'hubspot-legacy', '//js.hsforms.net/forms/v2-legacy.js', [], '2.0', true );
		load_script('hubspot-legacy');
	}
	register_script( 'hubspot', '//js.hsforms.net/forms/v2-legacy.js', [], '2.0', true );
	load_script('hubspot');
}

function handle_async($html, $handle, $src)
{
    // Async
    if (in_array($handle, apply_filters('view/enqueues/async', []))) {
        return substr_replace($html, "async='async' ", strpos($html, "type='text/javascript' "), 0);
    }

    return $html;
}

function handle_defer($html, $handle, $src)
{
       // Defer
       if (in_array($handle, apply_filters('view/enqueues/defer', []))) {
        return substr_replace($html, "defer='defer' ", strpos($html, "type='text/javascript' "), 0);
    }

    return $html;
}