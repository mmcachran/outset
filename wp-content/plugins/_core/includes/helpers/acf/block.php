<?php

namespace _core\helpers\acf\block;

use function _core\helpers\template\render;
use function _core\helpers\utils\has_key;
use function _core\helpers\utils\merge;
use function _core\helpers\acf\misc\easy_field_transformations;

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

	acf_register_block_type(
		merge(
			[
				'align'           => 'full',
				'name'            => $args['slug'],
				'title'           => $args['label'],
				'description'     => $args['description'],
				'category'        => 'layout',
				'icon'            => 'layout', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
				'mode'            => 'preview',
				'keywords'        => $args['slug'],
				'supports'        => [
					'mode'     => 'auto',
					'align'    => [ 'full', 'wide' ],
					'multiple' => true,
				],
				'render_callback' => function ( $block, $content = '', $is_preview = false ) use ( $args ) {
					// render_callback(merge([
					//     'block'   => $block,
					//     'content' => $content,
					// ], $args));
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
			'fields'   => easy_field_transformations( 'block', $args['fields'] ),
			'location' => [
				[
					[
						'param'    => 'block',
						'operator' => '==',
						'value'    => "acf/{$args['slug']}",
					],
				],
			],
			3,
		]
	);
}

function render_callback( $args = [] ) {
	var_dump( $args );
	die;
	// Render the block.
	render( $view_path, apply_filters( "Blocks/{$args['view']}", [] ) );
}
