<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function posts( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'posts',
			'label'       => __( 'Posts', 'core' ),
			'description' => __( 'The Posts Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'posts', 'custom' ],
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
