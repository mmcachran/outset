<?php
/**
 * Plugin Name: (pyxl) Admin Styles
 * Plugin URI: http://mizner.io
 * Description:
 * Version: 1.0
 * Author: Michael Mizner
 * Author URI: http://mizner.io
 * License: GPL
 */

namespace Mizner\AdminStyles;

defined('WPINC') || die;

define(__NAMESPACE__.'\PATH', plugin_dir_path(__FILE__));
define(__NAMESPACE__.'\URI', plugin_dir_url(__FILE__));

add_action('plugins_loaded', function () {
    add_action('admin_enqueue_scripts', function () {
        wp_enqueue_style('pyxl-admin-styles', URI.'pyxl-admin-styles.css');
    });
});
