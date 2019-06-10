<?php

namespace Pyxl\View\Compatibility\Timber;

class Operating
{
    public static function init()
    {
        $class = new self;
        add_action('admin_init', [$class, 'auto_activate']);
    }

    public function auto_activate()
    {
        $path = trailingslashit(WP_PLUGIN_DIR) . 'timber-library/timber.php';

        if (!file_exists($path)) {
            return;
        }

        activate_plugin($path, get_admin_url(null, 'plugins.php'));
    }
}