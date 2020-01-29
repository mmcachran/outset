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

add_action( 'plugins_loaded', '_core\actions\hooks\run' );
