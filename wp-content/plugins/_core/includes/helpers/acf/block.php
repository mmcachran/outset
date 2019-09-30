<?php

namespace _core\helpers\acf\block;

use Timber;
use function _core\helpers\template\render;
use function _core\helpers\utils\has_key;
use function _core\helpers\utils\merge;
use function _core\helpers\acf\misc\easy_field_transformations;
use function _core\helpers\utils\underscores_to_dashes;
use function Functional\select_keys;

function create( $args = [] ) {
	$required = [
		'name',
		'slug',
		'fields',
	];

	foreach ( $required as $key ) {
		if ( has_key( 'slug', $args ) ) {
			continue;
		}
		wp_die( '<pre>' . var_export( $args, true ) . '</pre>', "Error: {$key} missing" );
	}

	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		merge(
			[
				'align'           => 'full',
				'name'            => 'block-' . underscores_to_dashes($args['slug']),
				'title'           => $args['label'],
				'description'     => $args['description'],
				'category'        => 'layout',
				'icon'            => 'layout', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
				'mode'            => 'preview',
				'keywords'        => $args['slug'],
				'supports'        => [
					'mode'     => 'auto',
					// 'align'    => [ 'full', 'wide' ],
					'align'    => false,
					'multiple' => true,
				],
				'render_callback' => function ( $block, $content = '', $is_preview = false ){
					// var_dump($block);

					render("block/{$block['slug']}",
						apply_filters("_view/block/{$block['slug']}", merge(
							get_fields(),
							select_keys($block, ['align', 'mode', 'title']),
							[
								'base' => $block['slug'],
								'is_preview' => $is_preview,
								'classes' => has_key('className', $block) ? $block['className']: '',
							]
						))
					);
				},
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
			'title'    => __( $args['label'], 'core' ),
			'fields'   => easy_field_transformations($args['slug'], $args['fields'] ),
			'location' => [
				[
					[
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/block-' . underscores_to_dashes($args['slug']),
					],
				],
			],
			3,
		]
	);
}