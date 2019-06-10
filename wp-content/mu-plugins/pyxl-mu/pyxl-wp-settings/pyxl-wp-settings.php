<?php
/**
 * Plugin Name: Pyxl WordPress Settings
 * Description: Security upgrades and custom settings
 * Version: 1.0.0
 * Author: Pyxl Inc.
 * Author URI: http://pyxl.com
 * License: GPL3+
 */

namespace Pyxl\WPSettings;

defined('WPINC') || die;

define(__NAMESPACE__ . '\PATH', plugin_dir_path(__FILE__));

require_once 'lib/autoload.php';

add_action('plugins_loaded', function () {

    Security\WPHead::init();
    Security\Assets::init();
    Security\FileEditor::init();
    Security\Login::init();

    Roles\Removals::init();
    Roles\Additions\Owner::init();

    PluginCompatibility\GravityForms::init();
    PluginCompatibility\WooCommerce::init();

    Assets\jQuery::init();
    Assets\Emoji::init();

    DashboardWidgets\Removals::init();
    DashboardWidgets\Additions::init();

    AdminMenu\MenuPages\Removals::init();
    AdminMenu\MenuPages\Additions::init();
    AdminMenu\Redirects::init();

    AdminNotices\Removals::init();

    AdminBar\Removals::init();
    AdminBar\Additions::init();
});
