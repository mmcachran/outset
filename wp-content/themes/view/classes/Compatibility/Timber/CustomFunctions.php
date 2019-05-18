<?php

namespace Pyxl\View\Compatibility\Timber;

use Pyxl\View\Utils\Helpers;
use Pyxl\View\Utils\Images;
use Pyxl\View\Markup\CriticalAssets;
use Timber\Twig_Function;

class CustomFunctions
{
    public static function init()
    {
        $class = new self;
        add_filter('timber/twig', [$class, 'add_to_twig']);
    }

    public function add_to_twig($twig)
    {
        $actions = [
            [
                'name'   => 'gform',
                'action' => 'gravity_form',
            ],
            [
                'name'   => 'stringify',
                'action' => 'json_encode',
            ],
            [
                'name'   => 'enqueue_style',
                'action' => 'wp_enqueue_style',
            ],
            [
                'name'   => 'enqueue_script',
                'action' => 'wp_enqueue_script',
            ],
            [
                'name'   => 'get_dist_image_uri',
                'action' => [Helpers::class, 'get_dist_image_uri'],
            ],
            [
                'name'   => 'archive_link',
                'action' => [Helpers::class, 'archive_link'],
            ],
            [
                'name'   => 'svg_inline',
                'action' => [Helpers::class, 'svg_inline'],
            ],
            [
                'name'   => 'menu',
                'action' => 'wp_nav_menu',
            ],
            [
                'name'   => 'site',
                'action' => 'get_bloginfo',
            ],
            [
                'name'   => 'search_form',
                'action' => 'get_search_form',
            ],
            [
                'name'   => 'log',
                'action' => [Helpers::class, 'log'],
            ],
            [
                'name'   => 'critical',
                'action' => [CriticalAssets::class, 'render'],
            ],
            [
                'name'   => 'wp_kses_post',
                'action' => 'wp_kses_post',
            ],
            [
                'name'   => 'wp_kses',
                'action' => 'wp_kses',
            ],
            [
                'name'   => 'esc_attr',
                'action' => 'esc_attr',
            ],
            [
                'name'   => 'esc_js',
                'action' => 'esc_js',
            ],
            [
                'name'   => 'esc_url',
                'action' => 'esc_url',
            ],
            [
                'name'   => 'esc_html',
                'action' => 'esc_html',
            ],
            [
                'name'   => 'get_image_sizes',
                'action' => [Images::class, 'get_image_sizes'],
            ],
            [
                'name'   => 'generate_view_name',
                'action' => [Helpers::class, 'generate_view_name'],
            ],
        ];

        foreach ($actions as $action) {
            $twig->addFunction(new Twig_Function($action['name'], $action['action']));
        }

        return $twig;
    }
}