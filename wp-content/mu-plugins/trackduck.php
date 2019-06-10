<?php
/**
 * Plugin Name: Trackduck
 * Plugin URI: https://pyxl.com
 * Description:
 * Version: 1.0
 * License: GPL
 */

namespace Trackduck;

defined('WPINC') || die;

define(__NAMESPACE__ . '\PATH', plugin_dir_path(__FILE__));
define(__NAMESPACE__ . '\URI', plugin_dir_url(__FILE__));

$script = '<script src="//cdn.trackduck.com/toolbar/prod/td.js" async data-trackduck-id="5c7440480594d9db68d50ce8"></script>';
/*
add_action('get_footer', function () use ($script) {
    echo $script;
});

add_action('admin_footer', function () use ($script) {
    echo $script;
});
*/