<?php

namespace _core\filters\views;

use _core\helpers\query;
use _core\helpers\menu;

use function _core\helpers\utils\merge;

function head( $data ) {
	return merge(
		$data,
		[
			'charset' => get_bloginfo( 'charset' ),
		]
	);
}

function header( $data ) {
	return merge(
		$data,
		[
			'urls'  => [
				'home' => esc_url( get_home_url() ),
			],
			'menus' => [
				'social'  => menu\get( 'social' ),
				'primary' => menu\get( 'primary' ),
			],
		]
	);
}

function footer( $data ) {
	return merge(
		$data,
		[
			'urls'  => [
				'home' => esc_url( get_home_url() ),
			],
			'menus' => [
				'footer' => menu\get( 'footer' ),
			],
		]
	);
}

function singular( $data ) {
	return merge(
		$data,
		query\post()
	);
}

function archive( $data ) {
	return merge(
		$data,
		query\posts()
	);
}
