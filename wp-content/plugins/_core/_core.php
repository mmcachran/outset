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

// Default theme
defined('WP_DEFAULT_THEME') || define('WP_DEFAULT_THEME', 'view');

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

    // Page Templates
    Models\PageTemplates\Modules::init();
    Models\PageTemplates\Careers::init();

    // Post Types
    Models\PostTypes\Post::init();
    Models\PostTypes\Page::init();
    Models\PostTypes\Testimonial::init();

    // Taxonomies
    // Models\Taxonomies\EventType::init();

    // Options Pages
    // Models\OptionsPages\Globals::init();

    // Layouts
    Models\Layouts\Blurbs::init();
    Models\Layouts\CallToAction::init();
    Models\Layouts\Carousel::init();
    // Models\Layouts\ComparisonTable::init();
    Models\Layouts\Featurette::init();
    Models\Layouts\Form::init();
    Models\Layouts\General::init();
    Models\Layouts\Hero::init();
    Models\Layouts\Slider::init();
    Models\Layouts\Video::init();
    Models\Layouts\Testimonial::init();
    Models\Layouts\Posts::init();
    Models\Layouts\Gallery::init();

    // Field Groups
    Models\FieldGroups\PageSettings::init();
    Models\FieldGroups\Modules::init();
    Models\FieldGroups\Testimonial::init();
    Models\FieldGroups\Globals::init();

    /**
     * Controllers
     */
    Controllers\Globals\Footer::init();
    Controllers\Globals\Header::init();
    Controllers\Globals\FourOhFour::init();

    // Layouts
    Controllers\Layouts\Hero::init();
    // Controllers\Layouts\Featurette::init();
    // Controllers\Layouts\Testimonial::init();
    // Controllers\Layouts\FormBlock::init();
    Controllers\Layouts\Posts::init();

    // Post Types
    Controllers\PostTypes\Page::init();
    // Controllers\PostTypes\Post::init();
    // Controllers\PostTypes\Event::init();

    // Page Templates
    Controllers\PageTemplates\Modules::init();
    Controllers\PageTemplates\Careers::init();

    /**
     * Compatibility
     */
    Compatibility\BlockEditor::init();
});
