<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function tabs( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'tabs',
			'label'       => __( 'Tabs', 'core' ),
			'description' => __( 'The Tabs Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'tabs', 'custom' ],
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
