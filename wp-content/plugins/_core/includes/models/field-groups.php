<?php

namespace _core\models\field_groups;

use _core\helpers\acf\location;
use _core\helpers\field;

use function _core\helpers\utils\push;

function testimonial( $field_groups ) {
	$post_type = get_post_type_object( 'testimonial' );
	return push(
		$field_groups,
		[
			'slug'     => $post_type->name,
			'name'     => __( 'Additional Information', 'core' ),
			'fields'   => [
				field\text(
					[
						'label' => __( 'Location', 'core' ),
						'slug'  => 'location',
					]
				),
				field\text(
					[
						'label' => __( 'Position', 'core' ),
						'slug'  => 'position',
					]
				),
			],
			'position' => 'side',
			'location' => location\post_type( $post_type->name ),
		]
	);
}

function social_menu_item( $field_groups ) {
	return push(
		$field_groups,
		[
			'slug'     => 'social_menu_item',
			'name'     => 'Social Menu',
			'fields'   => [
				field\text(
					[
						'label' => __( 'Icon', 'core' ),
						'slug'  => 'icon',
					]
				),
			],
			'position' => 'normal',
			'location' => location\menu( 'social' ),
		]
	);
}

function event( $field_groups ) {
	$post_type = get_post_type_object( 'event' );

	return push(
		$field_groups,
		[
			'slug'     => $post_type->name,
			'name'     => __( 'Additional Information', 'core' ),
			'fields'   => [
				field\text(),
			],
			'position' => 'side',
			'location' => location\post_type( $post_type->name ),
		]
	);
}

function page( $field_groups ) {
	$post_type = get_post_type_object( 'page' );

	return push(
		$field_groups,
		[
			'slug'     => $post_type->name,
			'name'     => __( 'Header Options', 'core' ),
			'fields'   => [
				field\button_group(
					[
						'label'   => 'Header Style',
						'slug'    => 'header_style',
						'choices' => [
							'light'       => 'Light',
							'transparent' => 'Transparent',
						],
					]
				),
			],
			'position' => 'side',
			'location' => location\post_type( $post_type->name ),
		]
	);
}

function career( $field_groups ) {
	$post_type = get_post_type_object( 'career' );
	return push(
		$field_groups,
		[
			'slug'     => $post_type->name,
			'name'     => __( 'Additional Information', 'core' ),
			'fields'   => [
				field\text(
					[
						'label' => __( 'Location', 'core' ),
						'slug'  => 'location',
					]
				),
			],
			'position' => 'side',
			'location' => location\post_type( $post_type->name ),
		]
	);
}

function home( $field_groups ) {
	return push(
		$field_groups,
		[
			'slug'     => 'home',
			'name'     => __( 'Home Page Content', 'core' ),
			'fields'   => [
				field\tab(
					[
						'label' => 'Hero',
						'slug'  => 'hero_tab',
					]
				),
				field\group(
					[
						'label'      => 'Hero',
						'slug'       => 'hero',
						'sub_fields' => [
							field\heading(),
							field\text(
								[
									'label' => __( 'Sub-Heading', 'core' ),
									'slug'  => 'subheading',
								]
							),
							field\image(
								[
									'label' => __( 'Background Image (desktop)', 'core' ),
									'slug'  => 'background_desktop',
								]
							),
							field\image(
								[
									'label' => __( 'Background Image (mobile)', 'core' ),
									'slug'  => 'background_mobile',
								]
							),
							field\boolean(
								[
									'label'         => __( 'Background Overlay', 'core' ),
									'slug'          => 'hero_image_overlay',
									'default_value' => 0,
								]
							),
							field\link(),
							field\link(
								[
									'label' => 'Secondary Link',
									'slug'  => 'secondary_link',
								]
							),
							field\post_type(),
						],
					]
				),
			],
			'position' => 'normal',
			'location' => location\page_template(),
		]
	);
}
