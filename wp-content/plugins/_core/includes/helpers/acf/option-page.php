<?php

namespace _core\helpers\acf\option_page;

use function _core\helpers\utils\has_every_key;
use function _core\helpers\utils\merge;

function create( $args ) {
	if ( ! has_every_key( [ 'slug', 'name' ], $args ) ) {
		return;
	}

	// https://www.advancedcustomfields.com/resources/acf_add_options_page/
	acf_add_options_page(
		merge(
			[
				// phpcs:disable WordPress.WP.I18n.NoEmptyStrings
				// translators: %s: Name of option page
				'page_title'      => sprintf( __( '%s', 'core' ), $args['name'] ),
				// translators: %s: Name of option page for menu
				'menu_title'      => sprintf( __( '%s', 'core' ), $args['name'] ),
				'menu_slug'       => $args['slug'],
				'capability'      => 'edit_posts',
				'position'        => '2',
				'parent_slug'     => '',
				'icon_url'        => false, // https://developer.wordpress.org/resource/dashicons
				'redirect'        => true,
				'post_id'         => $args['slug'],
				'autoload'        => false,
				'update_button'   => __( 'Update', 'core' ),
				// translators: %s: Text to indicate options have been updated
				'updated_message' => sprintf( __( '%s Updated', 'core' ), $args['name'] ),
			],
			$args
		)
	);
}
