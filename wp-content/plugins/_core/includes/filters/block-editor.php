<?php

namespace _core\filters\block_editor;

/**
 * Enable block editor by post type
 *
 * @param [type] $can_edit
 * @param [type] $post_type
 * @return bool
 */
function enable_by_post_type( $can_edit, $post_type ) {
	if ( in_array( $post_type, [ 'post', 'page' ], true ) ) {
		return true;
	}

	return false;
}
