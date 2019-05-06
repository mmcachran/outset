<?php

namespace Pyxl\View\Utils;

use Pyxl\View\Utils\Helpers;
use Timber as TemplatingEngine;
use WP_Error;
use const Pyxl\View\PATH;

class Timber
{
    /**
     * @param $args
     */
    public static function render($args)
    {
        if (!class_exists(TemplatingEngine\Timber::class)) {
            return;
        }

        $data = Helpers::has_key('data', $args) ? $args['data'] : [];

        $path = sprintf(
            PATH . 'views/%1$s.twig',
            $args['path']
        );

        $message = sprintf(
            __('Path %1$s does not exist', 'view'),
            $path
        );

        if (Helpers::has_key('path', $args)) {
            new WP_Error('broke', $message);
        }

        do_action("{$args['path']}/before");
        TemplatingEngine\Timber::render($path, $data);
        do_action("{$args['path']}/after");
    }
}