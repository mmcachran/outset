<?php

namespace _core\filters\views;

use _core\helpers\query;
use _core\helpers\menu;

use function _core\helpers\utils\merge;

function search( $data ) {
	return merge(
		$data,
		query\posts(),
		[
			'query' => get_search_query(),
		]
	);
}

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
			'urls'   => [
				'home' => esc_url( get_home_url() ),
			],
			'global' => function_exists( 'get_field' ) ? get_field( 'footer', 'globals' ) : [],
			'menus'  => [
				'footer'  => menu\get( 'footer' ),
				'details' => menu\get( 'details' ),
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

function home( $data ) {
	$fields = get_fields();

	$content = $fields;

	return merge(
		$data,
		$content
	);
}
