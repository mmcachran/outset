<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function featurette( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'featurette',
			'label'       => __( 'Featurette', 'core' ),
			'description' => __( 'The Featurette Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'featurette', 'custom' ],
			'fields'      => [
				field\asset_type(
					[
						'label' => __( 'Image', 'core' ),
						'slug'  => 'type',
					]
				),
				field\image(
					[
						'slug'              => 'image',
						'conditional_logic' => field\basic_condition( 'hero-basic/type', 'image' ),
					]
				),
				field\file(
					[
						'slug'              => 'video',
						'conditional_logic' => field\basic_condition( 'hero-basic/type', 'video' ),
					]
				),
				field\lead_in(),
				field\heading(),
				field\content(),
				field\link(),
			],
		]
	);
}
