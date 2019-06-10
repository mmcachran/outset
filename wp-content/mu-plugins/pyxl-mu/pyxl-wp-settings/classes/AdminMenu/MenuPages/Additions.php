<?php

namespace Pyxl\WPSettings\AdminMenu\MenuPages;

class Additions
{
    private static $instance;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function init()
    {
        add_action('admin_menu', [self::instance(), 'additions']);
    }

    public function additions()
    {
        $menu_pages = [
            [
                'page_title' => __('Menu', 'pyxl-wp-settings'),
                'menu_title' => 'Menus',
                'capability' => 'manage_options',
                'menu_slug'  => 'nav-menus.php',
                'function'   => '',
                'icon'       => 'dashicons-list-view',
                'position'   => 25,
            ],
	        /*[
		        'page_title' => __( 'Widgets', 'pyxl-wp-settings' ),
		        'menu_title' => 'Widgets',
		        'capability' => 'manage_options',
		        'menu_slug'  => 'widgets.php',
		        'function'   => '',
		        'icon'       => 'dashicons-feedback',
		        'position'   => 25,
	        ],*/
        ];

        foreach ($menu_pages as $menu_page) {
            add_menu_page(
                $menu_page['page_title'],
                $menu_page['menu_title'],
                $menu_page['capability'],
                $menu_page['menu_slug'],
                $menu_page['function'],
                $menu_page['icon'],
                $menu_page['position']
            );
        }
    }
}
