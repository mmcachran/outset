<?php

namespace Pyxl\View\Utils;

use Pyxl\View\Utils\Helpers;
use Timber as TemplatingEngine;
use WP_Error;
use const Pyxl\View\PATH;
use const Pyxl\View\DEBUG;

class Timber
{
    public static function render($args)
    {
        if (!class_exists(TemplatingEngine\Timber::class)) {
            return new WP_Error('timber_inactive', sprintf(
                'Utils/Timber::render' . __(' requires "view" as an argument', 'view')
            ));
        }

        if (!Helpers::has_key('view', $args)) {
            return new WP_Error('no_view', sprintf(
                'Utils/Timber::render' . __(' requires "view" as an argument', 'view')
            ));
        }

        $path = sprintf(
            PATH . 'views/%1$s.twig',
            trailingslashit($args['view']) . basename($args['view'])
        );

        if (!file_exists($path)) {
            return new WP_Error('view_path_not_found', sprintf(
                __('View %1$s does not exist', 'view'),
                $path
            ));
        }

        $data = array_merge(TemplatingEngine\Timber::context(), Helpers::has_key('data', $args) ? $args['data'] : []);

        if (DEBUG) {
            var_dump($data);
        }

        do_action("{$args['view']}/before");
        TemplatingEngine\Timber::render($path, apply_filters($args['view'], $data));
        do_action("{$args['view']}/after");
    }
}