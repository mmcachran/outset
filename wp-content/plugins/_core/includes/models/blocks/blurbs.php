<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function blurbs( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'blurbs',
			'label'       => __( 'Blurbs', 'core' ),
			'description' => __( 'The Blurbs Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'blurbs', 'custom' ],
			'fields'      => [
				field\heading(),
				field\content(),
				field\repeater(
					[
						'sub_fields' => [
							field\image(),
							field\heading(),
							field\content(),
						],
					]
				),

			],
		]
	);
}
