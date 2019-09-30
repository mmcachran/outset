<?php

namespace _core\helpers\fields;

use GravityForm;

use function _core\helpers\utils\merge;

function boolean() {
	return [
		'slug'          => 'boolean',
		'label'         => 'Boolean',
		'type'          => 'true_false',
		'instructions'  => '',
		'message'       => '',
		'default_value' => 1,
		'ui'            => 1,
		'ui_on_text'    => 'On',
		'ui_off_text'   => 'Off',
	];
}

function heading() {
	return [
		'label' => __( 'Heading', 'core' ),
		'slug'  => 'heading',
		'type'  => 'text',
	];
}

function subheading() {
	 return [
		 'label' => __( 'Subheading', 'core' ),
		 'slug'  => 'subheading',
		 'type'  => 'text',
	 ];
}

function select() {
	 return [
		 'label'   => __( 'Select', 'core' ),
		 'slug'    => 'select',
		 'type'    => 'select',
		 'choices' => [],
	 ];
}

function message() {
	return [
		'label'   => __( 'Select', 'core' ),
		'slug'    => 'select',
		'type'    => 'select',
		'choices' => [],
	];
}

function gallery() {
	return [
		'label'   => __( 'Images', 'core' ),
		'slug'    => 'images',
		'type'    => 'gallery',
		'insert'  => 'append',
		'library' => 'all',
	];
}


function wysiwyg() {
	return [
		'label'        => __( 'WYSIWYG', 'core' ),
		'slug'         => 'wysiwyg',
		'type'         => 'wysiwyg',
		'toolbar'      => 'basic',
		'media_upload' => 0,
		'delay'        => 1,
	];
}


function tab() {
	return [
		'label'     => __( 'Tab', 'core' ),
		'slug'      => 'tab',
		'type'      => 'tab',
		'placement' => 'left',
	];
}

function number() {
	 return [
		 'label' => __( 'Number', 'core' ),
		 'slug'  => 'number',
		 'type'  => 'number',
	 ];
}


function button_group() {
	return [
		'label'   => __( 'Choices', 'core' ),
		'slug'    => 'choices',
		'type'    => 'button_group',
		'choices' => [],
	];
}


function group() {
	return [
		'label'      => __( 'Group', 'core' ),
		'slug'       => 'group',
		'type'       => 'group',
		'sub_fields' => [],
	];
}


function text() {
	return [
		'label' => __( 'Text', 'core' ),
		'slug'  => 'text',
		'type'  => 'text',
	];
}


function link() {
	return [
		'label' => __( 'Link', 'core' ),
		'slug'  => 'link',
		'type'  => 'link',
	];
}


function image() {
	return [
		'label'         => __( 'Image', 'core' ),
		'slug'          => 'image',
		'type'          => 'image',
		'preview_size'  => 'medium',
		'return_format' => 'id',
	];
}


function post_object() {
	return [
		'label'     => __( 'Post', 'core' ),
		'slug'      => 'post',
		'type'      => 'post_object',
		'post_type' => [
			'post',
		],
	];
}


function range() {
	return [
		'label'         => __( 'Range', 'core' ),
		'slug'          => 'range',
		'type'          => 'range',
		'instructions'  => '',
		'default_value' => 70,
		'min'           => '',
		'max'           => '',
		'step'          => 10,
	];
}


function video() {
	return [
		'label' => __( 'Video (oEmbed)', 'core' ),
		'slug'  => 'video',
		'type'  => 'oembed',
	];
}


function repeater($args = []) {
	return merge([
		'label'        => __( 'Items', 'core' ),
		'slug'         => 'items',
		'type'         => 'repeater',
		'layout'       => 'block',
		'button_label' => __( 'Add Item', 'core' ),
		'sub_fields'   => [],
	], $args);
}


function forms() {
	return [
		'label'   => __( 'Form', 'core' ),
		'slug'    => 'form',
		'type'    => 'select',
		'choices' => class_exists( GravityForm::class ) ? GravityForms::get_forms_list_for_acf_options() : [],
	];
}


function slider() {
	 return [
		 'label'        => __( 'Slides', 'core' ),
		 'slug'         => 'slides',
		 'type'         => 'repeater',
		 'layout'       => 'row',
		 'button_label' => 'Add Slide',
		 'sub_fields'   => [],
	 ];
}

function content() {
	return [
		'label'        => __( 'Content', 'core' ),
		'slug'         => 'content',
		'type'         => 'wysiwyg',
		'toolbar'      => 'basic',
		'media_upload' => 0,
		'delay'        => 1,
	];
}

function width() {
	return [
		'label'         => __( 'Width', 'core' ),
		'slug'          => 'width',
		'choices'       => [
			'width--full'   => 'Full',
			'width--wide'   => 'Wide',
			'width--normal' => 'Normal',
		],
		'default_value' => 'wide',
	];
}

function opacity() {
	return [
		'label'         => __( 'Opacity', 'core' ),
		'slug'          => 'opacity',
		'type'          => 'range',
		'default_value' => 70,
		'step'          => 1,
	];
}

function tab_general() {
	return [
		'label'     => __( 'General', 'core' ),
		'slug'      => 'general',
		'type'      => 'tab',
		'placement' => 'top',
	];
}

function tab_advanced() {
	return [
		'label'     => __( 'Advanced', 'core' ),
		'slug'      => 'advanced',
		'type'      => 'tab',
		'placement' => 'top',
	];
}

function color() {
	return [
		'label'         => __( 'Color', 'core' ),
		'slug'          => 'color',
		'type'          => 'swatch',
		'allow_null'    => 1,
		'choices'       => [],
		'default_value' => 'transparent',
		'layout'        => 'horizontal',
	];
}

function tags() {
	return [
		'slug'          => 'tags',
		'label'         => 'Tags',
		'type'          => 'taxonomy',
		'taxonomy'      => 'post_tag',
		'field_type'    => 'multi_select',
		'allow_null'    => 1,
		'add_term'      => 0,
		'return_format' => 'object',
		'multiple'      => 0,
	];
}

function categories() {
	 return [
		 'slug'          => 'categories',
		 'label'         => 'Categories',
		 'type'          => 'taxonomy',
		 'taxonomy'      => 'category',
		 'field_type'    => 'multi_select',
		 'allow_null'    => 1,
		 'add_term'      => 0,
		 'return_format' => 'object',
		 'multiple'      => 0,
	 ];
}
