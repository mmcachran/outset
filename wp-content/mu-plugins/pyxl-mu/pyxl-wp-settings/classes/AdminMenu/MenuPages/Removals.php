<?php

namespace Pyxl\WPSettings\AdminMenu\MenuPages;

use Pyxl\WPSettings\Utils\User;

/**
 * Class Removals
 * @package Pyxl\WPSettings\CoreDashboard
 * @reference https://aristath.github.io/blog/restrict-access-wordpress-dashboard
 */
class Removals
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
        add_action('admin_menu', [self::instance(), 'parent_menu_items'], 999);
        add_action('admin_menu', [self::instance(), 'child_menu_items'], 999);
    }


    public function parent_menu_items()
    {
        $menu_pages = [
            // 'edit.php',                   // Posts
            // 'upload.php',                 // Media
            'edit-comments.php',          // Comments
            'themes.php',                 // Appearance
            'plugins.php',                // Plugins
            // 'users.php',                  // Users
            // 'tools.php',                  // Tools
            // 'options-general.php',        // Settings
            // 'admin.php?page=mp_st',
            // 'admin.php?page=cp_main',
            'edit.php?post_type=acf-field-group' // ACF
        ];


        if (User::is_admin(User::current())) {
            return;
        }

        foreach ($menu_pages as $menu_page) {
            remove_menu_page($menu_page);
        }
    }

    public function child_menu_items()
    {
        $menu_items = [

            // Dashboard
            'index.php'           => [
                'update-core.php',
            ],

            // Themes
            'themes.php'          => [
                'themes.php', // Theme Changing
                'theme-editor.php',
                'theme_options',
            ],

            // Settings
            'options-general.php' => [
                'options-media.php', // Image Sizes
                'options-discussion.php',
                'options-discussion.php',
                'options-writing.php',
                'options-permalink.php',
                'duplicatepost',
            ],

            // Settings
            'tools.php'           => [
                'tools.php',
                'import.php',
                'export.php',
            ],

            // WooCommerce
            // 'edit.php?post_type=product' => [
            //     'edit-tags.php?taxonomy=product_category&amp;post_type=product',
            //     'edit-tags.php?taxonomy=brand&amp;post_type=product',
            //     'edit-tags.php?taxonomy=model&amp;post_type=product',
            //     'edit-tags.php?taxonomy=product_tag&amp;post_type=product',
            // ],
        ];

        if (User::is_admin(wp_get_current_user())) {
            return;
        }


        foreach ($menu_items as $menu_item_parent => $menu_item_children) {
            foreach ($menu_item_children as $menu_item_child) {
                remove_submenu_page($menu_item_parent, $menu_item_child);
            }
        }
    }
}
