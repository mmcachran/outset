<?php

namespace Core\Models\OptionsPages;

class RegisterOptionsPage
{
    public static function init()
    {
        $class = new self;
        add_action('acf/init', [$class, 'register']);
    }

    public static function register($child_args)
    {
        if (!function_exists('acf_add_options_page')) {
            return;
        }
        
        // https://www.advancedcustomfields.com/resources/acf_add_options_page/
        $args = [
            'page_title'      => 'Options',
            'menu_title'      => '',
            'menu_slug'       => '',
            'capability'      => 'edit_posts',
            'position'        => false,
            'parent_slug'     => '',
            'icon_url'        => false, // https://developer.wordpress.org/resource/dashicons
            'redirect'        => true,
            'post_id'         => 'options',
            'autoload'        => false,
            'update_button'   => __('Update', 'core'),
            'updated_message' => __('Options Updated', 'core'),
        ];
        acf_add_options_page(array_merge($args, $child_args));
    }
}