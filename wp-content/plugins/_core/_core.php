<?php

/**
 * Plugin Name: (custom) Core
 * Plugin URI: https://pyxl.com
 * Description:
 * Version: 1.0.0
 * Author: Pyxl
 * Author URI: https://pyxl.com
 * License: GPLv3+
 */


namespace _core;

defined( 'WPINC' ) || die;

define( __NAMESPACE__ . '\PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( __NAMESPACE__ . '\URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * Composer Autoloader
 */
require_once PATH . 'vendor/autoload.php';

/**
 *  A Convenient pseudo autoloader. As always, consider using composer via https://getcomposer.org/doc/04-schema.md#files
 *  Note, this is available due to being loaded in composer.json
 */
autoloader\simple_glob_require(
	[
		PATH . 'includes/helpers/*.php',
		PATH . 'includes/helpers/acf/*.php',
		PATH . 'includes/helpers/wp/*.php',
		PATH . 'includes/actions/*.php',
		PATH . 'includes/models/*.php',
		PATH . 'includes/models/blocks/*.php',
		PATH . 'includes/filters/*.php',
		PATH . 'includes/filters/blocks/*.php',
	]
);

add_action( 'plugins_loaded', '_core\run' );
function run() {

	/**
	 * Post Types
	 */
	add_filter( '_core/post_types', '_core\models\post_types\career' );
	add_filter( '_core/post_types', '_core\models\post_types\event' );
	add_filter( '_core/post_types', '_core\models\post_types\testimonial' );
	add_action( 'init', '_core\actions\register\post_types' ); // Register post types

	/**
	 * Taxonomies
	 */
	add_filter( '_core/taxonomies', '_core\models\taxonomies\event' );
	add_filter( '_core/taxonomies', '_core\models\taxonomies\location' );
	add_action( 'init', '_core\actions\register\taxonomies' ); // Register taxonomies

	/**
	 * Blocks
	 */
	add_filter( '_core/blocks', '_core\models\blocks\accordion' );

	add_filter( '_core/blocks', '_core\models\blocks\basic' );

	add_filter( '_core/blocks', '_core\models\blocks\blurbs' );

	add_filter( '_core/blocks', '_core\models\blocks\comparison_cards' );

	add_filter( '_core/blocks', '_core\models\blocks\cta' );

	add_filter( '_core/blocks', '_core\models\blocks\featurette' );

	add_filter( '_core/blocks', '_core\models\blocks\hero_basic' );

	add_filter( '_core/blocks', '_core\models\blocks\hero_form' );

	add_filter( '_core/blocks', '_core\models\blocks\image_grid' );

	add_filter( '_core/blocks', '_core\models\blocks\posts' );
	add_filter( '_view/block/posts/data', '_core\filters\blocks\posts' );

	add_filter( '_core/blocks', '_core\models\blocks\tabs' );

	add_filter( '_core/blocks', '_core\models\blocks\testimonials' );

	// Register blocks
	add_action( 'init', '_core\actions\register\blocks' );

	/**
	 * Field Groups
	 */
	add_filter( '_core/field_groups', '_core\models\field_groups\page' );
	add_filter( '_core/field_groups', '_core\models\field_groups\career' );
	add_filter( '_core/field_groups', '_core\models\field_groups\event' );
	add_filter( '_core/field_groups', '_core\models\field_groups\testimonial' );
	add_filter( '_core/field_groups', '_core\models\field_groups\social_menu_item' );
	add_action( 'init', '_core\actions\register\field_groups' ); // Register blocks

	/**
	 * Options
	 */
	add_filter( '_core/option_pages', '_core\filters\option_pages\general' );

	/**
	 * Views
	 */
	add_filter( '_view/global/head/data', '_core\filters\views\head' );
	add_action( '_view/global/head', '_core\actions\views\head' );

	add_filter( '_view/global/header/data', '_core\filters\views\header' );
	add_action( '_view/global/header', '_core\actions\views\header' );

	add_filter( '_view/global/footer/data', '_core\filters\views\footer' );
	add_action( '_view/global/footer', '_core\actions\views\footer' );

	add_filter( '_view/four-oh-four', '_core\filters\views\four_oh_four' );
	add_action( '_view/four-oh-four', '_core\actions\views\four_oh_four' );

	add_filter( '_view/archive/post-type/default/data', '_core\filters\views\archive' );
	add_action( '_view/archive/post-type/default', '_core\actions\views\archive' );

	add_filter( '_view/singular/default/data', '_core\filters\views\singular' );
	add_action( '_view/singular/default', '_core\actions\views\singular' );

	add_filter( '_view/single/post/data', '_core\filters\views\singular' );
	add_action( '_view/single/post', '_core\actions\views\post' );

	/**
	 * ACF Customizations
	 */
	add_filter( 'acf/fields/wysiwyg/toolbars', '_core\filters\wysiwyg\acf' );
	add_filter( 'tiny_mce_before_init', '_core\filters\wysiwyg\wp' );

	/**
	 * Blocks Editor Customizations
	 */
	add_filter( 'use_block_editor_for_post_type', '_core\filters\block_editor\enable_by_post_type', 10, 2 );

	/**
	 * Misc
	 */
	add_filter( 'enter_title_here', '_core\filters\misc\customize_title' );
}
