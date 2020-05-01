<?php

namespace _core\helpers\acf\block;

use function _core\helpers\template\render;
use function _core\helpers\utils\has_key;
use function _core\helpers\utils\merge;
use function _core\helpers\acf\misc\field_shorthand_translator;
use function _core\helpers\utils\has_every_key;
use function _core\helpers\utils\setup_classes;
use function _core\helpers\utils\underscores_to_dashes;
use function Functional\select_keys;
use function _view\utils\env_check;

/**
 * Create arguments for block field registration in ACF.
 *
 * @param [type] $args
 * @return void
 */
function create_register_group_args( $args ) {
	return [
		'key'      => "block/{$args['slug']}",
		// phpcs:disable WordPress.WP.I18n.NoEmptyStrings
		// translators: %s: Title of field group
		'title'    => sprintf( __( '%s', 'core' ), $args['label'] ),
		'fields'   => field_shorthand_translator( $args['slug'], $args['fields'] ),
		'location' => [
			[
				[
					'param'    => 'block',
					'operator' => '==',
					'value'    => 'acf/block-' . underscores_to_dashes( $args['slug'] ),
				],
			],
		],
	];
}

/**
 * Handler to feed data to our rendered template.
 *
 * @param [type] $block
 * @param string $content
 * @param boolean $is_preview
 * @return void
 */
function filter_data_handler( $block, $content = '', $is_preview = false ) {
	return merge(
		get_fields(),
		select_keys( $block, [ 'align', 'mode', 'title' ] ),
		[
			// 'base' is inherited from template.php
			'is_preview' => $is_preview,
			'classes'    => setup_classes(
				[
					'custom-block',
					has_key( 'align', $block ) ? "align{$block['align']}" : null,
					has_key( 'className', $block ) ? $block['className'] : null,
				]
			),
		]
	);
}

/**
 * Render template callback handler with filters.
 *
 * @param [type] $block
 * @param string $content
 * @param boolean $is_preview
 * @return void
 */
function render_callback_handler( $block, $content = '', $is_preview = false ) {
	render(
		"block/{$block['slug']}",
		apply_filters(
			'_core/block/global_data',
			apply_filters(
				"_view/block/{$block['slug']}/data",
				filter_data_handler( $block, $content, $is_preview )
			)
		)
	);
}

/**
 * Register Block for WP Block Editor.
 *
 * @param [type] $args
 * @return void
 */
function create_block_type_args( $args ) {
	return merge(
		[
			'align'           => 'full',
			'name'            => 'block-' . underscores_to_dashes( $args['slug'] ),
			'title'           => $args['label'],
			'description'     => $args['description'],
			'category'        => 'layout',
			'icon'            => 'layout', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
			'mode'            => 'preview',
			'keywords'        => $args['slug'],
			'supports'        => [
				'mode'     => 'auto',
				'align'    => [ 'full' ], // string or array [full, wide, left, right, center]
				'multiple' => true,
			],
			'render_callback' => __NAMESPACE__ . '\render_callback_handler',
			'enqueue_style'   => env_check( sprintf( '/dist/views/block/%1$s/%2$s.css', $args['slug'], basename( $args['slug'] ) ) ),
			'enqueue_script'  => env_check( sprintf( '/dist/views/block/%1$s/%2$s.js', $args['slug'], basename( $args['slug'] ) ) ),
		],
		$args
	);
}

/**
 * Block Creation / Registration entry function.
 *
 * @param array $args
 * @return void
 */
function create( $args = [] ) {
	if ( ! has_every_key( [ 'label', 'slug', 'fields' ], $args ) ) {
		return;
	}

	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type( create_block_type_args( $args ) );

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( create_register_group_args( $args ) );
}
