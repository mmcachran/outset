<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function hero( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'hero-basic',
			'label'       => __( 'Hero (basic)', 'core' ),
			'description' => __( 'A simple hero block', 'core' ),
			'icon'        => 'laptop',
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
						'slug'              => 'background_image',
						'conditional_logic' => field\basic_condition( 'hero-basic/type', 'image' ),
					]
				),
				field\file(
					[
						'slug'              => 'background_video',
						'conditional_logic' => field\basic_condition( 'hero-basic/type', 'video' ),
					]
				),
				field\heading(),
				field\content(),
			],
		]
	);
}
