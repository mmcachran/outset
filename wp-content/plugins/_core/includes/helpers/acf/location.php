<?php

namespace _core\helpers\acf\location;

function post_type( $post_type = 'post' ) {
	return [
		[
			[
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => $post_type,
			],
		],
	];
}


function social_menu() {
	return [
		[
			[
				'param'    => 'nav_menu_item',
				'operator' => '==',
				'value'    => 'location/social', // register_nav_menus item needs the key to be "social"
			],
		],
	];
}
