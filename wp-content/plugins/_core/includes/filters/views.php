<?php

namespace _core\filters\views;

use _core\helpers\query;
use _core\helpers\menu;

use function _core\helpers\utils\merge;

function head( $data ) {
	return merge(
		$data,
		[
			'charset' => esc_html( get_bloginfo( 'charset' ) ),
		]
	);
}

function header( $data ) {
	global $post;

	return merge(
		$data,
		[
			'urls'         => [
				'home' => esc_url( get_home_url() ),
			],
			'header_style' => $post ? get_post_meta( $post->ID, 'header_style', true ) : 'light',
			'menus'        => [
				'secondary' => menu\get( 'secondary', [], [ 'icon' ] ),
				'primary'   => menu\get( 'primary', [], [ 'icon' ] ),
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
