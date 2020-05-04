<?php

namespace _core\helpers\field;

use _core\helpers\query;
use function _core\helpers\utils\merge;
use function _view\utils\has_key;
use function Functional\select_keys;

function asset_type( $args = [] ) {
	return merge(
		[
			'label'   => __( 'Asset Type', 'core' ),
			'slug'    => 'asset_type',
			'type'    => 'button_group',
			'choices' => [
				'none'  => 'None',
				'image' => 'Image',
				'video' => 'Video',
			],
			'default' => 'none',
		],
		$args
	);
}

function boolean( $args = [] ) {
	return merge(
		[
			'slug'          => 'boolean',
			'label'         => __( 'Boolean', 'core' ),
			'type'          => 'true_false',
			'instructions'  => '',
			'message'       => '',
			'default_value' => 1,
			'ui'            => 1,
			'ui_on_text'    => 'On',
			'ui_off_text'   => 'Off',
		],
		$args
	);
}

function categories( $args = [] ) {
	return merge(
		[
			'slug'          => 'categories',
			'label'         => __( 'Categories', 'core' ),
			'type'          => 'taxonomy',
			'taxonomy'      => 'category',
			'field_type'    => 'multi_select',
			'allow_null'    => 1,
			'add_term'      => 0,
			'return_format' => 'object',
			'multiple'      => 0,
		],
		$args
	);
}


function heading( $args = [] ) {
	return merge(
		[
			'label' => __( 'Heading', 'core' ),
			'slug'  => 'heading',
			'type'  => 'text',
		],
		$args
	);
}

function lead_in( $args = [] ) {
	return merge(
		[
			'label' => __( 'Lead In', 'core' ),
			'slug'  => 'lead_in',
			'type'  => 'text',
		],
		$args
	);
}

function file( $args = [] ) {
	return merge(
		[
			'label' => __( 'File', 'core' ),
			'slug'  => 'file',
			'type'  => 'file',
		],
		$args
	);
}

function subheading( $args = [] ) {
	return merge(
		[
			'label' => __( 'Subheading', 'core' ),
			'slug'  => 'subheading',
			'type'  => 'text',
		],
		$args
	);
}

function description( $args = [] ) {
	return merge(
		[
			'label' => __( 'Description', 'core' ),
			'slug'  => 'description',
			'type'  => 'textarea',
		],
		$args
	);
}

function select( $args = [] ) {
	return merge(
		[
			'label'   => __( 'Select', 'core' ),
			'slug'    => 'select',
			'type'    => 'select',
			'choices' => [],
		],
		$args
	);
}

function message( $args = [] ) {
	return merge(
		[
			'label'   => __( 'Select', 'core' ),
			'slug'    => 'select',
			'type'    => 'select',
			'choices' => [],
		],
		$args
	);
}

function gallery( $args = [] ) {
	return merge(
		[
			'label'   => __( 'Images', 'core' ),
			'slug'    => 'images',
			'type'    => 'gallery',
			'insert'  => 'append',
			'library' => 'all',
		],
		$args
	);
}


function wysiwyg( $args = [] ) {
	return merge(
		[
			'label'        => __( 'WYSIWYG', 'core' ),
			'slug'         => 'wysiwyg',
			'type'         => 'wysiwyg',
			'toolbar'      => 'basic',
			'media_upload' => 0,
			'delay'        => 1,
		],
		$args
	);
}


function tab( $args = [] ) {
	return merge(
		[
			'label'     => __( 'Tab', 'core' ),
			'slug'      => 'tab',
			'type'      => 'tab',
			'placement' => 'left',
		],
		$args
	);
}

function number( $args = [] ) {
	return merge(
		[
			'label' => __( 'Number', 'core' ),
			'slug'  => 'number',
			'type'  => 'number',
		],
		$args
	);
}

function date( $args = [] ) {
	return merge(
		[
			'label' => __( 'Date', 'core' ),
			'slug'  => 'date',
			'type'  => 'date_picker',
		],
		$args
	);
}


function datetime( $args = [] ) {
	return merge(
		[
			'label' => __( 'Date and Time', 'core' ),
			'slug'  => 'date_time',
			'type'  => 'date_time_picker',
		],
		$args
	);
}


function button_group( $args = [] ) {
	return merge(
		[
			'label'   => __( 'Choices', 'core' ),
			'slug'    => 'choices',
			'type'    => 'button_group',
			'choices' => [],
		],
		$args
	);
}


function group( $args = [] ) {
	return merge(
		[
			'label'      => __( 'Group', 'core' ),
			'slug'       => 'group',
			'layout'     => 'block', // block, table, row
			'type'       => 'group',
			'sub_fields' => [],
		],
		$args
	);
}


function text( $args = [] ) {
	return merge(
		[
			'label' => __( 'Text', 'core' ),
			'slug'  => 'text',
			'type'  => 'text',
		],
		$args
	);
}


function link( $args = [] ) {
	return merge(
		[
			'label' => __( 'Link', 'core' ),
			'slug'  => 'link',
			'type'  => 'link',
		],
		$args
	);
}


function image( $args = [] ) {
	return merge(
		[
			'label'         => __( 'Image', 'core' ),
			'slug'          => 'image',
			'type'          => 'image',
			'preview_size'  => 'medium',
			'return_format' => 'id',
		],
		$args
	);
}


function post_object( $args = [] ) {
	return merge(
		[
			'label'         => __( 'Post', 'core' ),
			'slug'          => 'post_object',
			'type'          => 'post_object',
			'multiple'      => true,
			'return_format' => 'id',
			'post_type'     => [
				'post',
			],
		],
		$args
	);
}


function range( $args = [] ) {
	return merge(
		[
			'label'         => __( 'Range', 'core' ),
			'slug'          => 'range',
			'type'          => 'range',
			'instructions'  => '',
			'default_value' => 70,
			'min'           => '',
			'max'           => '',
			'step'          => 10,
		],
		$args
	);
}


function video( $args = [] ) {
	return merge(
		[
			'label' => __( 'Video (oEmbed)', 'core' ),
			'slug'  => 'video',
			'type'  => 'oembed',
		],
		$args
	);
}


function repeater( $args = [] ) {
	return merge(
		[
			'label'        => __( 'Items', 'core' ),
			'slug'         => 'items',
			'type'         => 'repeater',
			'layout'       => 'block',
			'button_label' => __( 'Add Item', 'core' ),
			'sub_fields'   => [],
		],
		$args
	);
}


function forms( $args = [] ) {
	return merge(
		[
			'label'   => __( 'Form', 'core' ),
			'slug'    => 'form',
			'type'    => 'select',
			'choices' => [],
		],
		$args
	);
}

function menus( $args = [] ) {
	return merge(
		[
			'label'   => __( 'Menu', 'core' ),
			'slug'    => 'menu',
			'type'    => 'select',
			'choices' => [],
		],
		$args
	);
}

function slider( $args = [] ) {
	return [
		'label'        => __( 'Slides', 'core' ),
		'slug'         => 'slides',
		'type'         => 'repeater',
		'layout'       => 'row',
		'button_label' => 'Add Slide',
		'sub_fields'   => [],
	];
}

function content( $args = [] ) {
	return merge(
		[
			'label'        => __( 'Content', 'core' ),
			'slug'         => 'content',
			'type'         => 'wysiwyg',
			'toolbar'      => 'basic',
			'media_upload' => 0,
			'delay'        => 1,
		],
		$args
	);
}

function width( $args = [] ) {
	return merge(
		[
			'label'         => __( 'Width', 'core' ),
			'slug'          => 'width',
			'choices'       => [
				'width--full'   => 'Full',
				'width--wide'   => 'Wide',
				'width--normal' => 'Normal',
			],
			'default_value' => 'wide',
		],
		$args
	);
}

function opacity( $args = [] ) {
	return merge(
		[
			'label'         => __( 'Opacity', 'core' ),
			'slug'          => 'opacity',
			'type'          => 'range',
			'default_value' => 70,
			'step'          => 1,
		],
		$args
	);
}

function tab_general( $args = [] ) {
	return merge(
		[
			'label'     => __( 'General', 'core' ),
			'slug'      => 'general',
			'type'      => 'tab',
			'placement' => 'top',
		],
		$args
	);
}

function tab_advanced( $args = [] ) {
	return merge(
		[
			'label'     => __( 'Advanced', 'core' ),
			'slug'      => 'advanced',
			'type'      => 'tab',
			'placement' => 'top',
		],
		$args
	);
}

function color( $args = [] ) {
	return merge(
		[
			'label'         => __( 'Color', 'core' ),
			'slug'          => 'color',
			'type'          => 'swatch',
			'allow_null'    => 1,
			'choices'       => [],
			'default_value' => 'transparent',
			'layout'        => 'horizontal',
		],
		$args
	);
}

function tags( $args = [] ) {
	return merge(
		[
			'slug'          => 'tags',
			'label'         => __( 'Tags', 'core' ),
			'type'          => 'taxonomy',
			'taxonomy'      => 'post_tag',
			'field_type'    => 'multi_select',
			'allow_null'    => 1,
			'add_term'      => 0,
			'return_format' => 'object',
			'multiple'      => 0,
		],
		$args
	);
}

function post_type( $args = [] ) {

	// TODO: consider refactoring to something like Functional/reindex
	$all_post_types = [];

	foreach ( query\post_types() as $post_type ) {
		$all_post_types[ $post_type->name ] = $post_type->label;
	};

	return merge(
		[
			'label'   => __( 'Post Type', 'core' ),
			'slug'    => 'post_type',
			'type'    => 'select',
			'choices' => has_key( 'post_types', $args ) ? select_keys( $all_post_types, $args['post_types'] ) : $all_post_types,
		],
		$args
	);
}

function accordion( $args = [] ) {
	return merge(
		[
			'slug'  => 'accordion',
			'label' => __( 'Accordion', 'core' ),
			'type'  => 'accordion',
		],
		$args
	);
}

function appearance( $args = [] ) {
	return merge(
		[

			'label'   => __( 'Appearance', 'core' ),
			'slug'    => 'appearance',
			'type'    => 'button_group',
			'choices' => [
				'light' => 'Light',
				'dark'  => 'Dark',
			],
			'default' => 'light',
		],
		$args
	);
}

function alignment( $args = [] ) {
	return merge(
		[
			'label'   => __( 'Alignment', 'core' ),
			'slug'    => 'alignment',
			'type'    => 'button_group',
			'choices' => [
				'left'  => 'Left',
				'right' => 'Right',
			],
			'default' => 'left',
		],
		$args
	);
}

function height( $args = [] ) {
	return merge(
		[
			'label'   => __( 'Height', 'core' ),
			'slug'    => 'height',
			'type'    => 'button_group',
			'choices' => [
				'full'  => 'Tall',
				'mid'   => 'Normal',
				'short' => 'Short',
			],
			'default' => 'mid',
		],
		$args
	);
}


/**
 * Basic Conditional logic
 *
 * Matching the structure of ACF's deep array structure, which we don't often need.
 * ...yes, it's silly, but useful.
 *
 * @param [type] $condition
 * @return void
 */
function basic_condition( $field, $value, $operator = '==' ) {
	return [
		[
			[
				'field'    => $field,
				'operator' => $operator,
				'value'    => $value,
			],
		],
	];
}
