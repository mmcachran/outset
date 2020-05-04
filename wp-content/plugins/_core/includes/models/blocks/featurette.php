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
				// Using this in favor over built alignment due to dashboard css issues
				field\alignment(),
				field\asset_type(
					[
						'label'   => __( 'Media Type', 'core' ),
						'slug'    => 'type',
						'choices' => [
							'image' => 'Image',
							'video' => 'Video',
						],
					]
				),
				field\image(
					[
						'conditional_logic' => field\basic_condition( 'featurette/type', 'image' ),
					]
				),
				field\file(
					[
						'label'             => __( 'Image', 'core' ),
						'slug'              => 'video',
						'conditional_logic' => field\basic_condition( 'featurette/type', 'video' ),
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
