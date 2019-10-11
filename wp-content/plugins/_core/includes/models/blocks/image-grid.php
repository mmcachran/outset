<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function image_grid( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'image-grid',
			'label'       => __( 'Image Grid', 'core' ),
			'description' => __( 'The Image Grid Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'grid', 'image', 'custom' ],
			'fields'      => [
				field\heading(),
				field\content(),
				field\repeater(
					[
						'sub_fields' => [
							field\image(),
							field\heading(),
							field\link(),
						],
					]
				),

			],
		]
	);
}
