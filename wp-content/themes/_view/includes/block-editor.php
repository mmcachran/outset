<?php

namespace view;

function enable_by_date( $can_edit, $post ) {

	if ( empty( $post->ID ) ) {
		return $can_edit;
	}

	$current = get_current_screen();

	if ( 'post' !== $current->base ) {
		return $can_edit;
	};

	$creation_date = (int) get_the_date( 'Y', $post->ID );

	if ( $creation_date >= 2019 ) {
		return true;
	}

	return false;

}

function handle_conditional_block_editor() {

	$current_screen = get_current_screen();

	if ( ! property_exists( $current_screen, 'base' ) ) {
		return;
	}

	if ( 'post' !== $current_screen->base && 'post' !== $current_screen->post_type ) {
		return;
	}

	add_filter( 'use_block_editor_for_post', '_view\enable_by_date', 10, 2 );
}

function block_editor() {
	// First, Globally disable
	add_filter( 'use_block_editor_for_post', '__return_false', 5 );
	// Then, re-enable conditionally
	add_action( 'current_screen', '_view\handle_conditional_block_editor' );
}
