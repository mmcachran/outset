<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function comparison_cards( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'comparison-cards',
			'label'       => __( 'Comparison Cards', 'core' ),
			'description' => __( 'The Comparison Cards Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'comparison', 'cards', 'custom' ],
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
