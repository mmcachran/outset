<?php // phpcs:disable WordPress.Files.FileName.NotHyphenatedLowercase

/**
 * Plugin Name: (custom) Core
 * Plugin URI: https://pyxl.com
 * Description:
 * Version: 1.0
 * Author: Pyxl
 * Author URI: https://pyxl.com
 * License: GPLv3+
 */


namespace _core;

defined( 'WPINC' ) || die;

define( __NAMESPACE__ . '\PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( __NAMESPACE__ . '\URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

// Composer Require
require_once PATH . 'vendor/autoload.php';

add_action( 'plugins_loaded', '_core\run' );
function run() {
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
			PATH . 'includes/actions/views/*.php',
			PATH . 'includes/filters/*.php',
			// PATH . 'includes/models/*.php',
		]
	);

	/**
	 * Post Types
	 */
	// Add post types to registry
	add_filter( '_core/post_types', '_core\filters\post_types\career' );
	add_filter( '_core/post_types', '_core\filters\post_types\event' );
	add_filter( '_core/post_types', '_core\filters\post_types\testimonial' );

	// Initialize registration of post types
	add_action( 'init', '_core\actions\register\post_types');

	/**
	 * Taxonomies
	 */
	// Add taxonomies to registry
	add_filter( '_core/taxonomies', '_core\filters\taxonomies\event' );
	add_filter( '_core/taxonomies', '_core\filters\taxonomies\location' );

	// Initialize registration of taxonomies
	add_action( 'init', '_core\actions\register\taxonomies' );

	/**
	 * Blocks
	 */
	// Add blocks to registry
	add_filter( '_core/blocks', '_core\filters\blocks\cta' );
	add_filter( '_core/blocks', '_core\filters\blocks\hero_basic' );

	// Initialize registration of blocks
	add_action( 'init', '_core\actions\register\blocks' );

	/**
	 * Metaboxes
	 */
	// add_filter( 'core/field_group', '_core\filters\field_groups\career' );
	// add_filter( 'core/field_group', '_core\filters\field_groups\testimonial' );
	// add_filter( 'core/field_group', '_core\filters\field_groups\event' );
	// add_filter( 'core/option_pages', '_core\models\option_pages\general' );

	add_action('_view/global/head', '_core\actions\views\head');
	add_filter('_view/global/head/data', '_core\filters\views\head');

	add_action('_view/global/header', '_core\actions\views\header');
	add_filter('_view/global/header/data', '_core\filters\views\header');

	add_action('_view/global/footer', '_core\actions\views\footer');
	add_filter('_view/global/footer/data', '_core\filters\views\footer');

	add_action('_view/archive/post_type/default', '_core\actions\views\archive');
	add_filter('_view/archive/post_type/default/data', '_core\filters\views\archive');

	add_action('_view/singular/default', '_core\actions\views\singular');
	add_filter('_view/singular/default/data', '_core\filters\views\singular');

	add_action('_view/single/post', '_core\actions\views\post');
	add_filter('_view/single/post/data', '_core\filters\views\singular');

	// add_action('init', '_core\actions\debug\utils');
}
