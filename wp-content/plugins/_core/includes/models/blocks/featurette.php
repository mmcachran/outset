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
				field\heading(),
				field\content(),
			],
		]
	);
}
