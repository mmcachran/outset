<?php

/**
 *
 * Admin Views
 *
 * @param string $name name of view to render
 * @return HTML Return file located at /views/admin/$name.php
 *
 **/
function pyxl_admin_view( $name ) {

	if ( is_admin() ) {
		$filename;
		$base_path = PATH . 'views/admin';
		$filename  = $base_path . '/' . $name . '.php';
		do_action( 'before_admin_view' );
		if ( file_exists( $filename ) ) {
			do_action( 'before_admin_' . $name );
			include $filename;
			do_action( 'after_admin_' . $name );
		}
		do_action( 'after_admin_view' );
	}

}

/**
 *
 * Frontend Views
 *
 * @param string $name name of view to render
 * @return HTML Return file located at /views/frontend/$name.php
 *
 **/
function pyxl_frontend_view( $name ) {

	global $filename, $data;
	$base_path = PATH . 'views/frontend';
	$filename  = $base_path . '/' . $name . '.php';
	do_action( 'before_frontend_view' );
	if ( file_exists( $filename ) ) {
		do_action( 'before_frontend_' . $name );
		include $filename;
		do_action( 'after_frontend_' . $name );
	}
	do_action( 'after_frontend_view' );

}

/**
 *
 * Shows the filename of the view if WP_DEBUG is true
 *
 * @return HTML Returns the filename being displayed in an html comment
 *
 **/
function display_filename() {
	global $filename;
	if ( WP_DEBUG == true ) {
		echo '<!-- ' . $filename . ' -->';
	}
}

add_action( 'before_admin_view', 'display_filename', 30, 0 );
add_action( 'before_frontend_view', 'display_filename', 30, 0 );



if ( ! function_exists( 'write_log' ) ) {
	function write_log( $log ) {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}

function sort_by_specified_key( $array, $key, $desc = false ) {
	usort(
		$array,
		function ( $a, $b ) use ( $key ) {
			return $a[ $key ] > $b[ $key ];
		}
	);
	if ( $desc ) {
		$array = array_reverse( $array );
	}
	return $array;
}

function pyxl_get_template_content( $template, $id, array $settings = null ) {
	$return = include trailingslashit( dirname( __DIR__ ) ) . $template;
	return apply_filters( "pyxl_pre_return_content_$template", $return, $id );
}

function pyxl_get_jobs_for_listing( array $settings = [] ) {
	$careers = [];
	$args    = [
		'post_type'      => 'job-opening',
		'posts_per_page' => isset( $settings['limit'] ) ? $settings['limit'] : -1,
		'orderby'        => 'menu_order',
		'order'          => 'asc',
	];
	if ( isset( $settings['location'] ) ) {
		$args['meta_query'] = [
			[
				'key'     => 'location_tied_to',
				'value'   => $settings['location'],
				'compare' => 'LIKE',
			],
		];
	}
	$career_obj = new WP_Query( $args );
	while ( $career_obj->have_posts() ) {
		$career_obj->the_post();
		$selected_locations = get_field( 'location_tied_to', get_the_id() );
		if ( $selected_locations ) {
			$locations = null;
			array_walk(
				$selected_locations,
				function ( $item ) use ( &$locations ) {
					if ( is_null( $locations ) ) {
						$locations = $item->post_title . ', ' . get_field( 'state_abbreviation', $item->ID );
					} else {
						$locations .= ', ' . $item->post_title . ', ' . get_field( 'state_abbreviation', $item->ID );
					}
				}
			);
		}
		$careers[] = [
			'url'      => get_permalink( get_the_ID() ),
			'title'    => get_the_title(),
			'location' => $locations,
		];
	}
	wp_reset_postdata();
	return $careers;
}

function pyxl_get_clients_for_talent( $id ) {
	/**
	 * get client posts
	 **/
	$args         = [
		'post_type'      => 'clients',
		'posts_per_page' => 5,
		'orderby'        => 'menu_order',
		'meta_query'     => [
			[
				'key'     => 'services_utilized',
				'value'   => '"' . $id . '"',
				'compare' => 'LIKE',
			],
		],
	];
	$client_posts = get_posts( $args );
	$clients      = [];
	foreach ( $client_posts as $client_post ) {
		$cs_url    = get_field( 'case_study', $client_post->ID ) ?
			parse_url( get_permalink( get_field( 'case_study', $client_post->ID )->ID ), PHP_URL_PATH ) :
			false;
		$clients[] = [
			'title'      => get_the_title( $client_post->ID ),
			'logo'       => get_field( 'logo', $client_post->ID ),
			'case_study' => $cs_url,
		];
	}
	wp_reset_postdata();
	wp_reset_query();
	return $clients;
}

function pyxl_get_offices_for_listing( array $settings = [] ) {
	$offices = [];
	$args    = [
		'post_type'      => 'offices',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
	];
	if ( isset( $settings['exclude'] ) ) {
		$args['post__not_in'] = $settings['exclude'];
	}
	$office_obj = new WP_Query( $args );
	$a          = 1;
	while ( $office_obj->have_posts() ) {
		$office_obj->the_post();
		$offices[] = [
			'id'    => 'location-' . $a,
			'url'   => get_permalink( get_the_ID() ),
			'title' => get_the_title(),
			'image' => get_field( 'main_office_image' ),
		];
		$a++;
	}
	wp_reset_postdata();
	return $offices;
}

function pyxl_get_resources_for_listing( array $args, $return_page_count = null ) {
	global $post;
	$args['post_status'] = 'publish';
	$resources_object    = new WP_Query( $args );
	$pages               = $resources_object->max_num_pages;
	$resources           = [];
	while ( $resources_object->have_posts() ) {
		$resources_object->the_post();
		$landing_page = pyxl_check_for_landing_page( get_the_ID() );
		if ( $args['post_type'] == 'resources' ) {
			$terms  = get_the_terms( get_the_ID(), 'type' );
			$author = get_field( 'author' );
			$author = $author->post_title;
		} else {
			$terms  = get_the_terms( get_the_ID(), 'topic' );
			$author = get_userdata( $resources_object->post->post_author )->data->display_name;
		}
		$selected_term = false;
		if ( is_array( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( ! $selected_term ) {
					$selected_term = $term->name;
				} else {
					$selected_term .= ', ' . $term->name;
				}
			}
		}
		$industries        = get_the_terms( get_the_ID(), 'industry' );
		$selected_industry = false;
		if ( is_array( $industries ) ) {
			foreach ( $industries as $industry ) {
				if ( ! $selected_industry ) {
					$selected_industry = $industry->name;
				} else {
					$selected_industry .= ', ' . $industry->name;
				}
			}
		}
		//if( $args['post_type'] == 'resources' ) {
		//$posted_on = get_the_date('m.d.y');
		//} else {
		$posted_on = get_the_date( 'F j, Y', $resources_object->post->ID );
		//}
		$permalink   = $landing_page ? get_permalink( $landing_page->ID ) : get_permalink( $resources_object->post->ID );
		$image       = get_field( 'listing_image', $resources_object->post->ID );
		$resources[] = [
			'is_post'   => $args['post_type'] == 'post',
			'title'     => get_the_title( $resources_object->post->ID ),
			'industry'  => $selected_industry,
			'term'      => $selected_term,
			'image'     => $image,
			'author'    => $author,
			'posted_on' => $posted_on,
			'url'       => $permalink,
		];
	}
	wp_reset_postdata();
	if ( $return_page_count ) {
		return [
			'items' => $resources,
			'pages' => $resources_object->max_num_pages,
		];
	} else {
		return $resources;
	}
}

function pyxl_check_for_landing_page( $id ) {
	$args         = [
		'post_type'      => 'landing-page',
		'posts_per_page' => 1,
		'meta_query'     => [
			[
				'key'     => 'gate_for',
				'value'   => $id,
				'compare' => 'LIKE',
			],
		],
	];
	$landing_page = new WP_Query( $args );
	if ( $landing_page->have_posts() ) {
		$landing_page_obj = $landing_page->posts[0];
		$cookie           = isset( $_COOKIE[ 'form_submitted_' . $landing_page_obj->ID ] ) ? $_COOKIE[ 'form_submitted_' . $landing_page_obj->ID ] : false;
		if ( $cookie && $cookie == parse_url( get_permalink( $id ), PHP_URL_PATH ) ) {
			return false;
		}
		return $landing_page_obj;
	}
	wp_reset_postdata();
	return false;
}

function get_terms_by_post_type( $taxonomies, $post_types ) {

	global $wpdb;

	$query = $wpdb->prepare(
		"SELECT t.*, COUNT(*) from $wpdb->terms AS t
        INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id
        INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id
        INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id
        WHERE p.post_type IN('%s') AND tt.taxonomy IN('%s')
        GROUP BY t.term_id",
		join( "', '", $post_types ),
		join( "', '", $taxonomies )
	);

	$results = $wpdb->get_results( $query );

	return $results;

}

function pyxl_extract_links( $data ) {
	global $links;

	if ( empty( $links ) ) {
		return [];
	}

	foreach ( $data as $key => $value ) {
		if ( ! is_array( $value ) && ! is_object( $value ) ) {
			// var_dump($key); echo '<br>';
			// print_r($value);
			if ( preg_match( '~https?://(?![^" ]*(?:jpg|png|gif|json))[^" ]+~', $value, $match ) ) {
				foreach ( $match as $link ) {
					$links[] = $link;
				}
			}
			continue;
		}
		pyxl_extract_links( (array) $value );
	}
}

function pyxl_print_page_links( $content ) {
	global $links;
	$links = [];
	pyxl_extract_links( $content );
	foreach ( $links as $link ) {
		echo '<a href="' . $link . '" class="show-for-sr">' . $link . '</a>';
	}
}


function pyxl_body_classes( $classes = [] ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return implode( ' ', $classes );
}
