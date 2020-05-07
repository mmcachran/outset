<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function staff( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'staff',
			'label'       => __( 'Staff', 'core' ),
			'description' => __( 'The Staff Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'staff', 'custom' ],
			'fields'      => [
				field\heading(),
				field\description(),
				field\post_object(
					[
						'label'        => __( 'Select Staff Members', 'core' ),
						'instructions' => __( 'Optional, will default to most recent.', 'core' ),
						'slug'         => 'staff',
						'post_type'    => 'staff',
					]
				),
			],
		]
	);
}
