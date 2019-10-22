<?php
// phpcs:disable Squiz.PHP.CommentedOutCode.Found
namespace _core\helpers\wp\taxonomy;

use function _core\helpers\utils\has_every_key;
use function _core\helpers\utils\merge;

function create( $args ) {
	if ( ! has_every_key( [ 'slug', 'types', 'singular', 'plural' ], $args ) ) {
		return;
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
