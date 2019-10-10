<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function basic( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'basic',
			'label'       => __( 'Basic', 'core' ),
			'description' => __( 'The Basic Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'basic', 'custom' ],
			'fields'      => [
				field\heading(),
				field\content(),
			],
		]
	);
}
