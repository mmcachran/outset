<?php

namespace Pyxl\View\Markup;

use const Pyxl\View\PATH;

class Wrappers
{
    public static function init()
    {
        $class = new self;

        add_action('view/head', [$class, 'before_head'], 25);
        add_action('view/header', [$class, 'svg_sprites'], 1);

        add_action('view/header', [$class, 'before_header'], 25);
        add_action('view/header', [$class, 'after_header'], 50);

        add_action('view/footer', [$class, 'before_footer'], 25);
        add_action('view/footer', [$class, 'after_footer'], 50);

        add_filter('body_class', [$class, 'body_class'], 25);
    }

    public function body_class($classes)
    {
        global $post;
        if (isset($post)) {
            $classes[] = $post->post_type . '-' . $post->post_name;
        }
        return $classes;
    }

    public function svg_sprites()
    {
        $path = PATH . 'dist/svgs/sprite.svg';
        if (!file_exists($path)) {
            return;
        }
        include_once $path;
    }

    public function before_head()
    {
        printf(
            '<!doctype html><html %1$s>',
            get_language_attributes('html')
        );
    }

    public function before_header()
    {
        printf(
            '<body class="%1$s" data-scroll-enabled="true"><div id="wrapper">',
            join(' ', get_body_class())
        );
    }

    public function after_header()
    {
        printf(
            '<main id="%1$s" class="%2$s">',
            apply_filters('view/main/id', 'content'),
            join(' ', apply_filters('view/main/classes', ['Content']))
        );
    }

    public function before_footer()
    {
        printf(
            '</main>'
        );
    }

    public function after_footer()
    {
        printf(
            '</div><!-- #wrapper --></body></html>'
        );
    }
}
