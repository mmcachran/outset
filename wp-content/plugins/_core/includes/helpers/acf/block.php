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

	acf_register_block_type(
		merge(
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
					'align'    => [], //  full, wide, left, right, center
					'multiple' => true,
				],
				'render_callback' => __NAMESPACE__ . '\render_callback_handler',
			],
			$args
		)
	);

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		[
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
			3,
		]
	);
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
					'classes'    => has_key( 'className', $block ) ? $block['className'] : '',
				]
			)
		)
	);
}
