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

function page_template( $page_template = 'home.php' ) {
	return [
		[
			[
				'param'    => 'post_template',
				'operator' => '==',
				'value'    => "page-template/{$page_template}",
			],
		],
	];
}

function menu( $menu = 'primary' ) {
	return [
		[
			[
				'param'    => 'nav_menu',
				'operator' => '==',
				'value'    => "location/{$menu}", // register_nav_menus item needs the key to be "primary"
			],
		],
	];
}

function options_page( $option_page = 'site' ) {
	return [
		[
			[
				'param'    => 'options_page',
				'operator' => '==',
				'value'    => $option_page,
			],
		],
	];
}
