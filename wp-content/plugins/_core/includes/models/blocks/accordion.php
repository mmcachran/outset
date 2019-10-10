<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function accordion( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'accordion',
			'label'       => __( 'Accordion', 'core' ),
			'description' => __( 'The Accordion Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'cta', 'custom' ],
			'fields'      => [
				field\heading(),
				field\content(),
				field\repeater(
					[
						'sub_fields' => [
							field\heading(),
							field\content(),
						],
					]
				),

			],
		]
	);
}
