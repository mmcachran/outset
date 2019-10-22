<?php

namespace _core\filters\misc;

function customize_title( $input ) {
	global $post_type;
	if ( 'testimonial' === $post_type ) {
		return __( 'Enter the reviewer\'s name here', 'core' );
	}
	return $input;
}
