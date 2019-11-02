<?php

namespace _core\filters\misc;

use _core\helpers\utils;

use function _view\utils\merge;
use function Functional\filter;

function customize_title( $input ) {
	global $post_type;
	if ( 'testimonial' === $post_type ) {
		return __( 'Enter the reviewer\'s name here', 'core' );
	}
	return $input;
}


function simplify_page_template_classes( $wp_classes ) {
	if ( ! is_page_template() ) {
		return $wp_classes;
	}

	return merge(
		filter(
			$wp_classes,
			function( $value, $key ) {
				if ( utils\string_contains( 'template', $value ) ) {
					return [];
				}
				return $value;
			}
		),
		[
			'page-template-' . sanitize_title( pathinfo( get_page_template_slug(), PATHINFO_FILENAME ) ),
		]
	);
}
