<?php

namespace view\rest_api;

use function view\utils\map_wp_image;

function register_routes() {
	register_rest_route(
		'custom/v1',
		'/frontpage',
		[
			'methods'  => 'GET',
			'callback' => 'pyxl\view\rest_api\get_frontpage',
		]
	);
}

// Callback function.
function get_frontpage( $object ) {
	// Get WP options front page from settings > reading.
	$frontpage_id = get_option( 'page_on_front' );

	// Handle if error.
	if ( empty( $frontpage_id ) ) {
		// return error
		return 'error';
	}

	// Create request from pages endpoint by frontpage id.
	$request = new \WP_REST_Request( 'GET', '/wp/v2/pages/' . $frontpage_id );

	// Parse request to get data.
	$response = rest_do_request( $request );

	// Handle if error.
	if ( $response->is_error() ) {
		return 'error';
	}

	return $response->get_data();
}


function add_page_meta( $data, $post, $context ) {
	if ( ! function_exists( 'get_field' ) ) {
		return;
	}

	$data->data['template_name'] = basename( get_page_template(), '.php' );

	$data->data['fields'] = get_fields( $post->id );

	return $data;
}


function add_client_meta( $data, $post, $context ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $data;
	}

	$image_id           = get_field( 'logo', $post->ID );
	$data->data['logo'] = [
		'src'    => wp_get_attachment_image_url( $image_id ),
		'alt'    => get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?: __( 'Pyxl Image', 'view' ),
		'srcset' => wp_get_attachment_image_srcset( $image_id ),
	];

	return $data;
}


function add_post_meta( $data, $post, $context ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $data;
	}

	$image_id                     = get_post_thumbnail_id( $post->ID );
	$data->data['featured_image'] = [
		'src' => wp_get_attachment_image_url( $image_id, 'large' ),
		'alt' => get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?: __( 'Pyxl Image', 'view' ),
	];

	$author_id            = get_the_author_meta( 'id' );
	$data->data['author'] = [
		'name'        => get_the_author_meta( 'display_name', $author_id ),
		'description' => get_the_author_meta( 'description', $author_id ),
	];

	$data->data['posted_on'] = get_the_date( 'F j, Y', $post->ID );

	$data->data['cta'] = [
		wp_rand(
			0,
			count(
				[
					'What are you working on?',
					"You love marketing, we love marketing, Let's Chat!",
					'Continue the conversation',
				]
			) - 1
		),
	];

	return $data;
}
