<?php

namespace _view\enqueues;

use function _view\utils\register_script;
use function _view\utils\register_style;
use function _view\utils\load_style;
use function _view\utils\load_script;
use function _view\utils\localize_script_data;

function registrations() {
	global $is_IE;
	global $wp_rewrite;

	$theme_uri      = get_template_directory_uri();
	$vendor_dir_uri = get_stylesheet_directory_uri() . '/dist/vendors';

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
			'theme'     => $theme_uri,
			'routes'    => $wp_rewrite->rules,
			'edit_post' => admin_url( 'post.php?post=%%post_id%%&action=edit' ),
		],
		'site'            => [
			'name' => get_bloginfo( 'name' ),
		],
	];

	if ( $is_IE ) {
		wp_enqueue_script( 'hs-legacy-js', '//js.hsforms.net/forms/v2-legacy.js', [], '2', true );
	}
	wp_enqueue_script( 'hs-js', '//js.hsforms.net/forms/v2.js', [], '2.0', true );
	// wp_enqueue_script( 'axios', $vendor_dir_uri . '/axios.min.js', [], '0.19.0', false );

	// phpcs:disable Squiz.PHP.CommentedOutCode
	// wp_enqueue_script('jquery');
	// wp_enqueue_script('jquery-custom', $vendor_dir_uri . '/jquery.min.js', [], null, false);
	// wp_enqueue_script('jquery-core', $vendor_dir_uri . '/jquery.min.js', [], null, false);
	// wp_enqueue_script('foundation', $vendor_dir_uri . '/foundation.js', [], null, false);
	// wp_enqueue_script('mustache', "{$vendor_dir_uri }/mustache.js", [], null, true);
	// wp_enqueue_script('js-cookie', "{$vendor_dir_uri }/js.cookie.js", [], null, true);
	// wp_enqueue_script('bodymovin', "{$vendor_dir_uri }/bodymovin.js", [], null, true);
	// wp_enqueue_script('navigo', "{$vendor_dir_uri }/navigo.js", [], null, true);
	// wp_enqueue_script('sticky-kit', "{$vendor_dir_uri }/sticky-kit.min.js", [], null, true);
	// wp_enqueue_script('slick', "{$vendor_dir_uri}/slick.js", ['jquery'], null, true);
	// wp_enqueue_script('animejs', "{$vendor_dir_uri}/anime.min.js", [], null, false);
	// wp_enqueue_script('scrollMonitor', "{$vendor_dir_uri }/scrollMonitor.js", [], null, true);
	// wp_enqueue_script('revealFx', "{$vendor_dir_uri }/revealFx.js", ['animejs'], null, true);
	// $full_deps = ['animejs', 'mustache', 'mustache', 'scrollMonitor', 'js-cookie', 'bodymovin', 'navigo', 'sticky-kit', 'slick', 'revealFx'];
	// phpcs:enable

	register_script( 'main', 'dist/scripts/main.js' );
	localize_script_data( 'main', 'globals', $localized );
	load_script('main');

	register_style( 'main', 'dist/styles/main.css' );
	load_style( 'main' );

	register_script( 'lozad', 'dist/vendors/lozad.js' );
	load_style( 'lozad' );
}
