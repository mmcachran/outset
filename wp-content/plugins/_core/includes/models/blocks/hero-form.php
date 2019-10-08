<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function hero_form( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'hero-form',
			'label'       => __( 'Hero (basic)', 'core' ),
			'description' => __( 'A simple hero block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'hero', 'custom' ],
			'fields'      => [
				field\heading(),
				field\content(),
			],
		]
	);
}
