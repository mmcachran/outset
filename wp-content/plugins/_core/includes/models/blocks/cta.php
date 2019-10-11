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
				field\lead_in(),
				field\heading(),
				field\content(),
			],
		]
	);
}
