<?php

namespace _core\helpers\wp\taxonomy;

use function _core\helpers\utils\merge;
use function _core\helpers\utils\has_key;

function create( $args ) {
	$required = [
		'slug',
		'types',
		'singular',
		'plural',
	];

	foreach ( $required as $key ) {
		if ( has_key( $key, $args ) ) {
			continue;
		}
		return new WP_Error( 'broke', __( 'Arguments "' . $key . '" is required', 'core' ) );
	}

	$taxonomy = merge(
		[
			'labels'             => [
				'name'          => $args['plural'],
				'singular_name' => $args['singular'],
				'add_new_item'  => 'Add New ' . $args['singular'],
				'edit_item'     => 'Edit ' . $args['singular'],
				'view_item'     => 'View ' . $args['singular'],
				'update_item'   => 'Update ' . $args['singular'],
				'not_found'     => 'No ' . $args['plural'] . ' found.',
			],
			'description'        => '',
			'public'             => true,
			'menu_position'      => 5,
			// 'publicly_queryable' => true,
			'hierarchical'       => true,
			'show_ui'            => true,
			// 'show_in_menu'       => true,
			// 'show_in_nav_menus'  => true,
			'show_in_rest'       => true,
			// 'rest_base'          => true,
			// 'rest_controller_class' => '', // Default is 'WP_REST_Terms_Controller'
			// 'show_tagcloud'         => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
			// 'meta_box_cb'           => '',
			// 'capabilities'          => [],
			// 'rewrite'               => [],
			// 'query_var'             => '',
			// 'update_count_callback' => '',
		],
		$args
	);

	register_taxonomy( $args['slug'], $args['types'], $taxonomy );

	return $taxonomy;
}
