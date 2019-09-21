<?php

namespace _core\models\blocks;

use _core\helpers\fields;
use function _core\helpers\utils\push;

function cta( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'cta',
			'label'       => __( 'Call To Action', 'core' ),
			'description' => __( 'The CTA Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'cta', 'custom' ],
			'fields'      => [
				fields\tab_general(),
				fields\heading(),
				fields\content(),
			],
		]
	);
}

function hero( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'hero',
			'label'       => __( 'Hero', 'core' ),
			'description' => __( 'The Hero Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'hero', 'custom' ],
			'fields'      => [
				fields\heading(),
				fields\content(),
			],
		]
	);
}
