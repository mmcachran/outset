<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function blurbs( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'blurbs',
			'label'       => __( 'Blurbs', 'core' ),
			'description' => __( 'The Blurbs Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'blurbs', 'custom' ],
			'fields'      => [
				field\max_columns(),
				field\asset_type(
					[
						'slug'          => 'type',
						'default_value' => 'icon',
						'choices'       => [
							'icon'  => 'Icon',
							'image' => 'Image',
						],
					]
				),
				field\heading(),
				field\description(),
				field\repeater(
					[
						'sub_fields' => [
							field\select(
								[
									'label'             => __( 'Select', 'core' ),
									'slug'              => 'icon',
									'conditional_logic' => field\basic_condition( 'blurbs/type', 'icon' ),
									'default_value'     => 'bars',
									'choices'           => [
										'bars'  => 'Icon 1',
										'times' => 'Icon 2',
										'icon3' => 'Icon 3',
									],
								]
							),
							field\image(
								[
									'conditional_logic' => field\basic_condition( 'blurbs/type', 'image' ),
								]
							),
							field\link(),
							field\heading(),
							field\description(),
						],
					]
				),

			],
		]
	);
}
