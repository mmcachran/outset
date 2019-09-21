<?php

namespace _core\helpers\wp\post_type;

use function _core\helpers\utils\merge;
use function _core\helpers\has_key;

function create( $args ) {
	$required = [
		'slug',
		'singular',
		'plural',
	];

	foreach ( $required as $key ) {
		if ( has_key( $key, $args ) ) {
			continue;
		}
		return new WP_Error( 'broke', __( 'Arguments "' . $key . '" is required', 'core' ) );
	}

	$singular     = $args['singular'];
	$plural       = $args['plural'];
	$slug         = $args['slug'];
	$plural_lower = strtolower( $plural );
	$plural_slug  = sanitize_title( $plural_lower );

	return merge(
		[
			'capability_type'     => 'post', // http://justintadlock.com/archives/2010/07/10/meta-capabilities-for-custom-post-types
		// 'capabilities'          => [],
			'description'         => '',
			'exclude_from_search' => false,
			'has_archive'         => true,
			'hierarchical'        => false,
			'labels'              => [
				'name'               => __( "{$singular}", 'core' ),
				'single_name'        => __( "{$singular}", 'core' ),
				'add_new_item'       => __( "Add New {$singular}", 'core' ),
				'edit_item'          => __( "Edit {$singular}", 'core' ),
				'new_item'           => __( "New {$singular}", 'core' ),
				'all_items'          => __( "All {$plural}", 'core' ),
				'view_item'          => __( "View {$singular}", 'core' ),
				'search_items'       => __( "Search {$plural}", 'core' ),
				'not_found'          => __( "No {$plural_lower} found", 'core' ),
				'not_found_in_trash' => __( "No {$plural_lower} found in the Trash", 'core' ),
				'parent_item_colon'  => __( '', 'core' ),
				'menu_name'          => __( "{$plural}", 'core' ),
			],
			'map_meta_cap'        => true, // https://codex.wordpress.org/Function_Reference/register_post_type#capability_type
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-admin-generic',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'supports'            => [
				'editor',
				'title',
				'thumbnail',
				'excerpt',
				// 'author',
				// 'revisions',
			],
			'rest_base'           => $slug,
			'rewrite'             => [
				'slug'       => $plural_slug,
				'with_front' => true,
			],
		],
		$args
	);
}
