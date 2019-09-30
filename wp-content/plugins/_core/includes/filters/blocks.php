<?php

namespace _core\filters\blocks;

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
				fields\repeater([
					'sub_fields' => [
						fields\heading(),
						fields\content(),
					]
				])
			],
		]
	);
}

function hero_basic( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'hero_basic',
			'label'       => __( 'Hero (basic)', 'core' ),
			'description' => __( 'A simple hero block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'hero', 'custom' ],
			'fields'      => [
				fields\heading(),
				fields\content(),
			],
		]
	);
}
