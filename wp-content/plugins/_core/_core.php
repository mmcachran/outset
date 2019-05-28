<?php
/**
 * Plugin Name: (custom) Core Plugin
 * Description: Plugin for custom WordPress development
 * Version: 1.0.0
 * Author: Pyxl Inc.
 * Author URI: https://pyxl.com
 * License: GPLv3+
 */

namespace Core;

defined('WPINC') || die;

define(__NAMESPACE__ . '\PATH', plugin_dir_path(__FILE__));
define(__NAMESPACE__ . '\URI', plugin_dir_url(__FILE__));

// Gravity Forms
define('GF_LICENSE_KEY', 'XXXXXXXXXXXXXXX');

// S3 Media Offload
define('AS3CF_SETTINGS', serialize([
    'provider'          => 'aws',
    'access-key-id'     => 'XXXXXXXXXXXXXXX',
    'secret-access-key' => 'XXXXXXXXXXXXXXX',
]));

require_once 'lib/autoload.php';

add_action('plugins_loaded', function () {

    /**
     * Models
     */
    // Post Types
    Models\PostTypes\Posts::init();
    Models\PostTypes\Pages::init();
    // Models\PostTypes\Events::init();
    // Models\PostTypes\Testimonial::init();
    // Models\PostTypes\Careers::init();

    // Taxonomies
    // Models\Taxonomies\EventType::init();

    // Options Pages
    Models\OptionsPages\Globals::init();

    // Field Groups
    Models\FieldGroups\Globals::init();
    Models\FieldGroups\Pages::init();
    // Models\FieldGroups\Testimonial::init();

    // Blocks
    Models\Blocks\Hero::init();
    Models\Blocks\CallToAction::init();

    /**
     * Controllers
     */
    // Globals
    Controllers\Globals\Footer::init();
    Controllers\Globals\Header::init();
    Controllers\Globals\FourOhFour::init();

    // Post Types
    Controllers\PostTypes\Pages::init();
    Controllers\PostTypes\Posts::init();
    // Controllers\PostTypes\Event::init();

    // Blocks
    Controllers\Blocks\Hero::init();
    /**
     * Compatibility
     */
    Compatibility\BlockEditor::init();
});
