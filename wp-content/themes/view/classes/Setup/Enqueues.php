<?php

namespace Pyxl\View\Setup;

use Pyxl\View\Utils\Helpers;

use const Pyxl\View\URI;

class Enqueues
{
    public static function init()
    {
        $class = new self;
        add_action('wp_enqueue_scripts', [$class, 'register_styles'], 25);
        add_action('wp_enqueue_scripts', [$class, 'register_scripts'], 25);
        add_action('wp_enqueue_scripts', [$class, 'register_libraries'], 25);
        add_action('wp_enqueue_scripts', [$class, 'head'], 50);
        add_action('get_footer', [$class, 'footer'], 50);
        add_filter('script_loader_tag', [$class, 'attributes'], 50, 3);
    }

    public function head()
    {
        wp_enqueue_style('main');
    }

    public function footer()
    {
        wp_enqueue_script('main|asyncdefer');
    }

    public function register_libraries()
    {
        // Flickity Slider
        // wp_register_script('flickity', URI . 'dist/vendors/flickity.pkgd.min.js', null, null, true);
        // wp_register_style('flickity', URI . 'dist/vendors/flickity.min.css');
    }

    public function register_scripts()
    {
        // Main
        $js_global = 'dist/scripts/main.js';
        wp_register_script('main|asyncdefer', Helpers::env_check($js_global), [], Helpers::cache_buster($js_global), false);
        wp_localize_script(
            'main',
            'main',
            [
                'urls'       => [
                    'root'  => home_url(),
                    'ajax'  => admin_url('admin-ajax.php'),
                    'theme' => URI,
                ],
                'ajax_nonce' => wp_create_nonce('ajax_nonce'),
                'post_id'    => get_the_ID(),
            ]
        );

    }

    public function register_styles()
    {
        $css_global = 'dist/styles/main.css';
        wp_register_style('main', Helpers::env_check($css_global), [], Helpers::cache_buster($css_global), 'all');
    }

    public function attributes($html, $handle, $src)
    {
        if (strpos($handle, '|asyncdefer') !== false) {
            return "<script type='text/javascript' async='async' defer='defer' src='{$src}'></script>";
        }
        if (strpos($handle, '|async') !== false) {
            return "<script type='text/javascript' async='async' src='{$src}'></script>";
        }
        if (strpos($handle, '|defer') !== false) {
            return "<script type='text/javascript' defer='defer' src='{$src}'></script>";
        }

        return $html;
    }
}
