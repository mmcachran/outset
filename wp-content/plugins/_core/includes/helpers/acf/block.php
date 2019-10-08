<?php

namespace _core\helpers\acf\block;

use Timber;
use function _core\helpers\template\render;
use function _core\helpers\utils\has_key;
use function _core\helpers\utils\merge;
use function _core\helpers\acf\misc\field_shorthand_translator;
use function _core\helpers\utils\has_every_key;
use function _core\helpers\utils\underscores_to_dashes;
use function Functional\select_keys;

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
				'align'    => [ 'wide', 'full' ], //  full, wide, left, right, center
				'multiple' => true,
			],
			'render_callback' => __NAMESPACE__ . '\render_callback_handler',
			'enqueue_style'   => get_stylesheet_directory_uri() . sprintf( '/dist/views/block/%1$s/%2$s.css', $args['slug'], basename( $args['slug'] ) ),
			'enqueue_script'  => get_stylesheet_directory_uri() . sprintf( '/dist/views/block/%1$s/%2$s.js', $args['slug'], basename( $args['slug'] ) ),
		],
		$args
	);
}

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

function render_callback_handler( $block, $content = '', $is_preview = false ) {
	render(
		"block/{$block['slug']}",
		apply_filters(
			sprintf( '_view/block/%s/data', $block['slug'] ),
			merge(
				get_fields(),
				select_keys( $block, [ 'align', 'mode', 'title' ] ),
				[
					'base'       => $block['slug'],
					'is_preview' => $is_preview,
					'classes'    => trim(
						join(
							' ',
							[
								'custom-block',
								has_key( 'align', $block ) ? "align{$block['align']}" : null,
								has_key( 'className', $block ) ? $block['className'] : null,
							]
						)
					),
				]
			)
		)
	);
}
