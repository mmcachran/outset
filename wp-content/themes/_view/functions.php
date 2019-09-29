<?php

namespace _view;

use function _view\utils\glob_autoloader; // Note, this is available due to being loaded in composer.json

define( __NAMESPACE__ . '\PATH', trailingslashit( dirname( __FILE__ ) ) );
define( __NAMESPACE__ . '\URI', trailingslashit( get_template_directory_uri() ) );
define( 'THEME_VERSION', '3.0.0' );

require_once PATH . 'vendor/autoload.php';

// A Convenient pseudo autoloader. As always, consider using composer via https://getcomposer.org/doc/04-schema.md#files
glob_autoloader( [ PATH . 'includes/*.php' ] );
add_action( 'wp_enqueue_scripts', '_view\enqueues\registrations' );
add_action( 'after_setup_theme', '_view\setup\theme_supports' );
