<?php

namespace Pyxl\View\Setup;

class Sidebars
{
    const REGISTRATIONS = [
        'Primary',
        'Footer',
    ];

    public static function init()
    {
        $class = new self;
        add_action('init', [$class, 'register']);
    }

    public function register()
    {
        foreach (self::REGISTRATIONS as $name) {

            $slug = strtolower(str_replace(' ', '-', $name));

            register_sidebar([
                'name'          => esc_html__($name, 'view'),
                'id'            => $slug,
                'description'   => esc_html__('Add widgets here.', 'view'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => "</section>",
                'before_title'  => "<h3 class='{$slug}__title'>",
                'after_title'   => "</h3>",
            ]);
        }

    }
}