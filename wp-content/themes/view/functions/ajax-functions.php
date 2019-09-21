<?php

/**
 *
 * gets a page by name and returns its data for display
 *
 * Action : get_page
 *
 * @return json
 *
 * @uses wp_send_json
 *
 */
function pyxl_ajax_get_page() {
	 global $post;
	$path    = $_POST['path'];
	$page    = array_key_exists( 'page', $_POST ) ? $_POST['page'] : '';
	$filters = isset( $_POST['filters'] ) ? $_POST['filters'] : false;
	$post_id = url_to_postid( $path );

	if ( $post_id ) {
		$post  = get_post( $post_id );
		$title = get_post_meta( $post_id, '_yoast_wpseo_title', true );
		if ( ! $title || $title == '' ) {
			$title = get_the_title( $post_id );
		}
		$template = get_post_meta( $post_id, '_wp_page_template', true );
		if ( $template == 'default' || $template == '' ) {
			$post_type = get_post_type( $post_id );
			$template  = "content/default-$post_type.php";
		}
		$mustache_template = str_replace( [ 'content/', '.php' ], '', $template );
		$data              = [
			'logo'        => $mustache_template == 'front-page' ? 'white' : 'full',
			'post_id'     => $post_id,
			'title'       => html_entity_decode( $title ),
			'slug'        => basename( get_permalink( $post_id ) ),
			'description' => get_post_meta( $post_id, '_yoast_wpseo_metadesc', true ),
			'template'    => $mustache_template,
			'page'        => $page,
			'body_class'  => get_body_class(),
			'content'     => pyxl_get_template_content(
				$template,
				$post_id,
				[
					'page'    => $page,
					'filters' => $filters,
				]
			),
		];
		if ( WP_DEBUG ) {
			$data['debug'] = [
				'_wp_page_template' => $template,
				'post_type'         => get_post_type( $post_id ),
				'filters'           => $filters,
			];
		}
		wp_send_json_success( $data );
	} else {
		$template          = 'content/404.php';
		$mustache_template = str_replace( [ 'content/', '.php' ], '', $template );
		$data              = [
			'logo'    => $mustache_template == 'front-page' ? 'white' : 'full',
			'content' => pyxl_get_template_content(
				$template,
				$post_id,
				[
					'page'    => $page,
					'filters' => $filters,
				]
			),
		];
		wp_send_json_error( $data );
	}
}

add_action( 'wp_ajax_get_page', 'pyxl_ajax_get_page', 10 );
add_action( 'wp_ajax_nopriv_get_page', 'pyxl_ajax_get_page', 10 );

/**
 *
 * gets a page by name and returns its data for display
 *
 * Action : get_pagination
 *
 * @return json
 *
 * @uses wp_send_json
 *
 */
function pyxl_ajax_get_pagination() {
	$hash       = $_POST['hash'];
	$parent     = $_POST['parent'];
	$excludeIds = $_POST['excludeIds'];
	$query      = $_POST['query'];
	// is this a paginated page?
	$page      = $query['paged'];
	$root_page = $_POST['root_page'];
	$title     = ucwords( $parent ) . ' | Page ' . $page . ' | ' . get_bloginfo( 'name' );
	$template  = "content/$parent-pagination.php";
	$data      = [
		'logo_attrs' => [
			'color' => 'full',
		],
		'page'       => $page,
		'title'      => $title,
		'content'    => pyxl_get_template_content(
			$template,
			null,
			[
				'query'      => $query,
				'page'       => $page,
				'excludeIds' => $excludeIds,
				'root_page'  => $root_page,
			]
		),
	];
	if ( WP_DEBUG ) {
		$data['debug'] = [
			'_wp_page_template' => $template,
			'post_type'         => get_post_type( $post_id ),
			'filters'           => $filters,
		];
	}
	wp_send_json_success( $data );
}

add_action( 'wp_ajax_get_pagination', 'pyxl_ajax_get_pagination', 10 );
add_action( 'wp_ajax_nopriv_get_pagination', 'pyxl_ajax_get_pagination', 10 );

/**
 *
 * gets a filtered items based on selections by user
 *
 * Action : get_filtered
 *
 * @return json
 *
 * @uses wp_send_json
 *
 */
function pyxl_ajax_get_filtered_items() {
	$query = $_POST['query'];
	write_log( $query );
	$data = pyxl_get_resources_for_listing( $query, true );
	$a    = 0;
	foreach ( $data['items'] as $key => $resource ) {
		$data['items'][ $key ]['size'] = $a <= 1 ? 'medium-6' : 'medium-4';
		$a++;
	}
	$data['pages'] = range( 1, $data['pages'] );
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		$data['debug'] = [
			'query' => $query,
		];
	}
	wp_send_json_success( $data );
}

add_action( 'wp_ajax_get_filtered', 'pyxl_ajax_get_filtered_items', 10 );
add_action( 'wp_ajax_nopriv_get_filtered', 'pyxl_ajax_get_filtered_items', 10 );
