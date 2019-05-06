<?php

namespace Pyxl\View\Markup;

use const Pyxl\View\PATH;

class CriticalAssets
{
    public static function render($option = 'disable')
    {
        'enable' !== $option ?: do_action('theme_critical');
    }

    public static function init()
    {
        $class = new self;
        // Inline our assets.
        add_action('theme_critical', [$class, 'styles']);
        add_action('theme_critical', [$class, 'scripts']);
    }

    public function styles()
    {
        $file = PATH . '/dist/styles/main.min.css';
        if (!file_exists($file)) {
            return;
        }
        ob_start();
        include_once($file);
        $data = ob_get_clean();
        printf(
            '<style type="text/css" data-type="critical-styles">%s</style>',
            $data
        );
    }

    public function scripts()
    {
        $file = PATH . '/dist/scripts/critical.js';
        if (!file_exists($file)) {
            return;
        }
        ob_start();
        include_once($file);
        $data = ob_get_clean();
        printf(
            '<script type="text/javascript" data-type="critical-script">%s</script>',
            $data
        );
    }

}