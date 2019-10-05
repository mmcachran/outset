<?php

namespace _core\helpers\wp\post_type;

use function _core\helpers\utils\has_every_key;
use function _core\helpers\utils\merge;
use function _core\helpers\utils\has_key;

/**
 * Uses the same argument as register_post_type, but uses 'slug' as the post type
 */
function create( $args ) {

	if ( ! has_every_key( [ 'slug', 'singular', 'plural' ], $args ) ) {
		return;
	}

	foreach ( $required as $key ) {
		if ( has_key( $key, $args ) ) {
			continue;
		}
		return;
	}

	$singular     = $args['singular'];
	$plural       = $args['plural'];
	$slug         = $args['slug'];
	$plural_lower = strtolower( $plural );
	$plural_slug  = sanitize_title( $plural_lower );

	$post_type = merge(
		[
			'capability_type'     => 'post', // http://justintadlock.com/archives/2010/07/10/meta-capabilities-for-custom-post-types
			'description'         => '',
			'exclude_from_search' => false,
			'has_archive'         => true,
			'hierarchical'        => false,
			'labels'              => [
				// phpcs:disable WordPress.WP.I18n.NoEmptyStrings
				// translators: %s: Name of post type
				'name'               => sprintf( __( '%s', 'core' ), $singular ),
				// translators: %s: Single name of post type
				'single_name'        => sprintf( __( '%s', 'core' ), $singular ),
				// translators: %s: Text to indicate adding new post
				'add_new_item'       => sprintf( __( 'Add New %s', 'core' ), $singular ),
				// translators: %s: Text to indicate editing post
				'edit_item'          => sprintf( __( 'Edit %s', 'core' ), $singular ),
				// translators: %s: Text to indicate adding new post
				'new_item'           => sprintf( __( 'New %s', 'core' ), $singular ),
				// translators: %s: Text to indicate viewing all posts
				'all_items'          => sprintf( __( 'All %s', 'core' ), $plural ),
				// translators: %s: Text to indicate viewing single post
				'view_item'          => sprintf( __( 'View %s', 'core' ), $singular ),
				// translators: %s: Text to indicate searching posts
				'search_items'       => sprintf( __( 'Search %s', 'core' ), $singular ),
				// translators: %s: Text to indicate no results for posts
				'not_found'          => sprintf( __( 'No %s found', 'core' ), $plural_lower ),
				// translators: %s: Text to indicate no results for posts in trash
				'not_found_in_trash' => sprintf( __( 'No %s found in the Trash', 'core' ), $plural_lower ),
				// translators: %s: Text to indicate no results for posts in trash
				'menu_name'          => sprintf( __( '%s', 'core' ), $plural ),
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
				// title, editor, excerpt, thumbnail, revisions, author, comments, trackbacks, page-attributes, post-formats, custom-fields
				'title',
				'editor',
				'thumbnail',
				'excerpt',
			],
			'rest_base'           => $slug,
			'rewrite'             => [
				'slug'       => $plural_slug,
				'with_front' => true,
			],
		],
		$args
	);

	register_post_type( $slug, $post_type );

	return $post_type;
}
