<?php

show_admin_bar( true );

// Add post thumbnail supports.
add_theme_support( 'post-thumbnails' );

// RSS
add_theme_support( 'automatic-feed-links' );

// Add menu support.
add_theme_support( 'menus' );
register_nav_menus(
	[
		'primary' => __( 'Primary Navigation' ),
		// "secondary" => __("Secondary Navigation"),
		'footer'  => __( 'Lower Footer Navigation' ),
	]
);

function get_quick_tags() {
	return apply_filters(
		'pyxl_quick_tags',
		[
			'%%year%%'      => date( 'Y' ),
			'%%site_name%%' => get_bloginfo( 'name' ),
		]
	);
}

function add_location_quicktag( $tags ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $tags;
	}

	global $post, $locations;
	if ( is_object( $post ) && $post->ID ) {
		$selected_locations = get_field( 'location_tied_to', $post->ID );
		if ( $selected_locations ) {
			$locations = null;
			array_walk(
				$selected_locations,
				function ( $item ) {
					global $locations;
					if ( is_null( $locations ) ) {
						$locations = $item->post_title;
					} else {
						$locations .= ', ' . $item->post_title;
					}
				}
			);
			$tags['%%location%%'] = $locations;
		}
	}
	return $tags;
}

add_filter( 'pyxl_quick_tags', 'add_location_quicktag', 10, 1 );
function add_user_defined_quicktags( $tags ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $tags;
	}
	remove_filter( 'acf/load_value/type=text', 'process_quicktags' );
	$user_defined_tags = get_field( 'user_defined_tags', 'options' );
	add_filter( 'acf/load_value/type=text', 'process_quicktags' );
	if ( ! $user_defined_tags ) {
		return $tags;
	}
	foreach ( $user_defined_tags as $tag ) {
		$name                        = $tag['tag'];
		$tags[ '%%' . $name . '%%' ] = $tag['replace_with'];
	}
	return $tags;
}

add_filter( 'pyxl_quick_tags', 'add_user_defined_quicktags', 20, 1 );
function add_form_placement_quicktag_for_landing_pages( $tags ) {
	global $post;
	if ( get_post_type( $post ) == 'landing-page' ) {
		$tags['%%place_form_here%%'] = '<div id="hs-form-holder"></div>';
	}
	return $tags;
}

add_filter( 'pyxl_quick_tags', 'add_form_placement_quicktag_for_landing_pages', 30, 1 );
function process_quicktags( $content ) {
	$tags = get_quick_tags();
	return str_replace( array_keys( $tags ), array_values( $tags ), $content );
}

add_filter( 'acf_the_content', 'process_quicktags', 10, 1 );
add_filter( 'the_content', 'process_quicktags', 10, 1 );
add_filter( 'the_title', 'process_quicktags', 10, 1 );
add_filter( 'the_excerpt', 'process_quicktags', 10, 1 );
if ( ! is_admin() ) {
	add_filter( 'acf/load_value/type=textarea', 'process_quicktags' );
	add_filter( 'acf/load_value/type=text', 'process_quicktags' );
}

add_filter(
	'acf/fields/google_map/api',
	function ( $api ) {
		$api['key'] = 'AIzaSyD-kdZoPCL-tPe6Mu-EqrrPT4NPVIwap3s';
		return $api;
	}
);

add_action( 'init', 'pyxl_unregister_taxonomy' );
function pyxl_unregister_taxonomy() {
	global $wp_taxonomies;
	$taxonomies = [ 'category' ];
	foreach ( $taxonomies as $taxonomy ) {
		if ( taxonomy_exists( $taxonomy ) ) {
			unset( $wp_taxonomies[ $taxonomy ] );
		}
	}
}

add_filter( 'wpseo_add_opengraph_images', 'pyxl_add_image_to_head' );
function pyxl_add_image_to_head( $api ) {
	global $post;

	if ( ! $post ) {
		return;
	}

	$featured_resource = get_field( 'featured_resource', $post->ID ) ? get_field( 'featured_resource', $post->ID ) : get_field( 'post_resource_featured', $post->ID );
	if ( $featured_resource ) {
		$api->add_image( wp_get_attachment_image_src( get_field( 'listing_image', $featured_resource )['id'], 'full' )[0] );
	} elseif ( is_page() ) {
		$ogimg = WPSEO_Meta::get_value( 'opengraph-image', $post->ID );
		$api->add_image( $ogimg );
	}
	if ( is_singular() && ! has_post_thumbnail() ) {
		$api->add_image( get_field( 'listing_image', $post->ID )['url'] );
	}
	return $api;
}

// Blocks/Gutenberg Support
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'disable-custom-font-sizes' );
add_theme_support( 'disable-custom-colors' );
