<?php
/**
 * Plugin Name: Pyxl Must Use Plugins
 * Plugin URI: http://pyxl.com
 * Version: 1.0
 * Author: Pyxl Inc.
 * Author URI: https://github.com/thinkpyxl/pyxl-mu
 * License: GPL3+
 */

foreach (glob(dirname(__FILE__) . '/pyxl-mu/*', GLOB_ONLYDIR) as $dir) {
    $path = $dir . DIRECTORY_SEPARATOR . basename($dir) . '.php';
    if (!file_exists($path)) {
        continue;
    }
    require($dir . DIRECTORY_SEPARATOR . basename($dir) . '.php');
}
