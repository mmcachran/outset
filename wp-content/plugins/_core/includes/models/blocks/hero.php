<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function hero( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'hero',
			'label'       => __( 'Hero', 'core' ),
			'description' => __( 'A hero block', 'core' ),
			'icon'        => 'format-image',
			'keywords'    => [ 'hero', 'custom' ],
			'fields'      => [
				field\asset_type(
					[
						'label' => __( 'Background', 'core' ),
						'slug'  => 'type',
					]
				),
				field\image(
					[
						'slug'              => 'image',
						'conditional_logic' => field\basic_condition( 'hero/type', 'image' ),
					]
				),
				field\file(
					[
						'slug'              => 'video',
						'conditional_logic' => field\basic_condition( 'hero/type', 'video' ),
					]
				),
				field\heading(),
				field\content(),
				field\link(),
			],
		]
	);
}
