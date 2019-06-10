<?php

namespace Pyxl\View\Setup;

use Timber;

class Menus
{
    const REGISTRATIONS = [
        [
            'name' => 'Primary',
            'slug' => 'primary',
        ],
        [
            'name' => 'Secondary',
            'slug' => 'Secondary',
        ],
        [
            'name' => 'Social',
            'slug' => 'social',
        ],
        [
            'name' => 'Footer',
            'slug' => 'footer',
        ],
    ];

    public static function init()
    {
        $class = new self;
        add_action('init', [$class, 'register']);
        // add_filter('timber/context', [$class, 'timber_menus'], 100);
    }

    public function timber_menus($context)
    {
        if (!class_exists(Timber\Timber::class)) {
            return;
        }

        $context['menus'] = [];

        foreach (self::REGISTRATIONS as $menu) {
            $context['menus'][$menu['slug']] = new Timber\Menu($menu['slug']);
        }

        return $context;
    }

    public function register()
    {
        register_nav_menus($this->create_menu_object(self::REGISTRATIONS));
    }

    public function create_menu_object($menus)
    {
        $menu_object = [];
        foreach ($menus as $menu) {
            $menu_object[$menu['slug']] = __($menu['name'], 'view');
        }

        return $menu_object;
    }
}