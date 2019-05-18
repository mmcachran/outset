<?php

namespace Pyxl\View\Compatibility\Timber;

use Pyxl\View\Utils\Helpers;
use Timber\Timber;
use const Pyxl\View\PATH;

class Notices
{
    public static function init()
    {
        $class = new self;
        add_action('admin_notices', [$class, 'backend_notice']);
        add_action('view_main_timber_inactive', [$class, 'frontend_notice']);
    }

    public function backend_notice()
    {
        if (class_exists(Timber::class)) {
            return;
        }

        $link = sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a>',
            Helpers::get_plugin_activation_uri('timber-library/timber.php'),
            __('Click here to activate plugins', 'view')
        );

        $message = sprintf(
            '<strong>%1$s:</strong> %2$s %3$s',
            __('Warning', 'view'),
            __('The active theme needs plugin Timber to function', 'view'),
            $link
        );

        printf(
            '<div class="error"><p>%1$s</p></div>',
            $message
        );
    }

    public function frontend_notice()
    {
        printf(
            '<h1>%1$s</h1>',
            __('Sorry, the templating engine is having trouble. Please contact your administrator.', 'view')
        );
    }
}