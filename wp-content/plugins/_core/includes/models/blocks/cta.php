<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function cta( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'cta',
			'label'       => __( 'Call To Acton', 'core' ),
			'description' => __( 'The Call To Action Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'cta', 'custom' ],
			'fields'      => [
				field\image(),
				field\lead_in(),
				field\heading(),
				field\description(),
				field\link(
					[
						'slug' => 'primary_link',
					]
				),
				field\link(
					[
						'slug' => 'secondary_link',
					]
				),
			],
		]
	);
}
