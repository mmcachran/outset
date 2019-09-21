<?php

namespace _core\helpers\acf\option_page;

use function _core\helpers\utils\merge;

function create( $args ) {
	$required = [
		'name',
		'slug',
	];

	foreach ( $required as $key ) {
		if ( has_key( $key, $args ) ) {
			continue;
		}
		return new WP_Error( 'broke', __( 'Arguments "' . $key . '" is required', 'core' ) );
	}

	// https://www.advancedcustomfields.com/resources/acf_add_options_page/
	return merge(
		[
			'page_title'      => __( sprintf( '%s', $args['name'] ), 'core' ),
			'menu_title'      => __( sprintf( '%s', $args['name'] ), 'core' ),
			'menu_slug'       => $args['slug'],
			'capability'      => 'edit_posts',
			'position'        => false,
			'parent_slug'     => '',
			'icon_url'        => false, // https://developer.wordpress.org/resource/dashicons
			'redirect'        => true,
			'post_id'         => $args['slug'],
			'autoload'        => false,
			'update_button'   => __( 'Update', 'core' ),
			'updated_message' => __( sprintf( '%s Updated', $args['name'] ), 'core' ),
		],
		$args
	);
}
