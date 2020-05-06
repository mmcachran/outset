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
				field\heading(),
				field\description(),
				field\repeater(
					[
						'sub_fields' => [
							field\select(
								[
									'label'   => __( 'Select', 'core' ),
									'slug'    => 'select',
									'choices' => [
										'icon1' => 'Icon 1',
										'icon2' => 'Icon 2',
										'icon3' => 'Icon 3',
									],
								]
							),
							field\heading(),
							field\description(),
						],
					]
				),

			],
		]
	);
}
