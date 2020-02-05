<?php

namespace _core\filters\block_editor;

/**
 * Enable block editor by post type
 *
 * @param [type] $can_edit
 * @param [type] $post_type
 * @return bool
 * @since 1.0.0
 */
function enable_by_post_type( $can_edit, $post_type ) {
	if ( in_array( $post_type, [ 'post', 'page' ], true ) ) {
		return true;
	}

	return false;
}

/**
 * Enable block editor by template
 *
 * @param [type] $can_edit
 * @param [type] $post_type
 * @return bool
 * @since 1.0.0
 */
function enable_by_page_template( $can_edit, $post ) {
	$page_template = get_page_template_slug( $post->ID );

	if ( $page_template && strpos( $page_template, 'template/' ) !== false ) {
		remove_post_type_support( 'page', 'editor' );
		return false;
	}

	return $can_edit;
}
