<?php

namespace _core\models\blocks;

use _core\helpers\field;
use function _core\helpers\utils\push;

function posts( $blocks ) {
	return push(
		$blocks,
		[
			'slug'        => 'posts',
			'label'       => __( 'Posts', 'core' ),
			'description' => __( 'The Posts Block', 'core' ),
			'icon'        => 'laptop',
			'keywords'    => [ 'posts', 'custom' ],
			'fields'      => [
				field\heading(),
				field\description(),
				field\post_type(
					[
						'post_types' => [ 'post', 'event' ],
					]
				),
				field\post_object(
					[
						'label'             => __( 'Select Posts', 'core' ),
						'instructions'      => __( 'Optional, will default to most recent.', 'core' ),
						'conditional_logic' => field\basic_condition( 'posts/post_type', 'post' ),
						'slug'              => 'posts',
						'post_type'         => 'post',
					]
				),
				field\post_object(
					[
						'label'             => __( 'Select Events', 'core' ),
						'instructions'      => __( 'Optional, will default to most recent.', 'core' ),
						'conditional_logic' => field\basic_condition( 'posts/post_type', 'event' ),
						'slug'              => 'events',
						'post_type'         => 'event',
					]
				),
			],
		]
	);
}
