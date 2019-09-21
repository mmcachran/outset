<?php

namespace pyxl\view;

use function pyxl\view\utils\glob_autoloader; // Note, this is available due to being loaded in composer.json

define( __NAMESPACE__ . '\PATH', trailingslashit( dirname( __FILE__ ) ) );
define( __NAMESPACE__ . '\URI', trailingslashit( get_template_directory_uri() ) );
define( 'THEME_VERSION', '1.2.0' );

require_once PATH . 'vendor/autoload.php';

// A Convenient pseudo autoloader. As always, consider using composer via https://getcomposer.org/doc/04-schema.md#files
glob_autoloader( [ 'includes/*.php' ] );

add_action( 'wp_enqueue_scripts', 'pyxl\view\enqueues\registrations' );
add_filter( 'rest_prepare_post', 'pyxl\view\rest_api\add_post_meta', 10, 3 );
// add_filter( 'rest_prepare_clients', 'pyxl\view\rest_api\add_client_meta', 10, 3 );
// add_action( 'rest_api_init', 'pyxl\view\rest_api\register_routes' );
// add_filter( 'rest_prepare_page', 'pyxl\view\rest_api\add_page_meta', 10, 3 );
// add_action( 'admin_init', 'pyxl\view\block_editor' );
