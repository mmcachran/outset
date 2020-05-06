<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function contact( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'contact',
			'label'       => __( 'Contact', 'core' ),
			'description' => __( 'The Contact Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'contact', 'custom' ],
			'fields'      => [
				field\lead_in(),
				field\heading(),
				field\content(),
				// TODO: add form choice (e.g. hubspot, ninja forms, etc.)
			],
		]
	);
}
