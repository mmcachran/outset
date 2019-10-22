<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function testimonials( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'testimonials',
			'label'       => __( 'Testimonials', 'core' ),
			'description' => __( 'The Testimonials Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'testimonials', 'custom' ],
			'fields'      => [
				field\heading(),
				field\description(),
				field\post_object(
					[
						'label'        => __( 'Select Testimonials', 'core' ),
						'instructions' => __( 'Optional, will default to most recent.', 'core' ),
						'slug'         => 'testimonials',
						'post_type'    => 'testimonial',
					]
				),
			],
		]
	);
}
