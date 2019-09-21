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
			'includes/helpers/*.php',
			'includes/helpers/acf/*.php',
			'includes/helpers/wp/*.php',
			'includes/actions/*.php',
			'includes/models/*.php',
		]
	);

	/**
	 * Post Types
	 */

	// Add post types to registry
	add_filter( 'core/post_types', '_core\filters\post_types\career' );
	add_filter( 'core/post_types', '_core\filters\post_types\event' );
	add_filter( 'core/post_types', '_core\filters\post_types\testimonial' );

	// Initialize registration of post types
	add_action( 'init', '_core\actions\register\blocks' );

	/**
	 * Taxonomies
	 */

	// Add taxonomies to registry
	add_filter( 'core/taxonomies', '_core\models\taxonomies\event' );
	add_filter( 'core/taxonomies', '_core\models\taxonomies\location' );

	// Initialize registration of taxonomies
	add_action( 'init', '_core\actions\register\taxonomies' );

	/**
	 * Blocks
	 */

	// Add blocks to registry
	add_filter( '_core\blocks', '_core\models\blocks\cta' );
	add_filter( '_core\blocks', '_core\models\blocks\hero' );

	// Initialize registration of blocks
	add_action( 'init', '_core\actions\register\blocks' );

	/**
	 * Metaboxes
	 */
	// add_filter( 'core/field_group', '_core\filters\field_groups\career' );
	// add_filter( 'core/field_group', '_core\filters\field_groups\testimonial' );
	// add_filter( 'core/field_group', '_core\filters\field_groups\event' );
	// add_filter( 'core/option_pages', '_core\models\option_pages\general' );
}
