<?php

namespace _core\filters\blocks;

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
				field\heading(),
				field\content(),
			],
		]
	);
}

function hero_basic( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'hero-basic',
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
