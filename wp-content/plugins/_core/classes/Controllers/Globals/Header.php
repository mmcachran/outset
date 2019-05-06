<?php

namespace Core\Controllers\Globals;

use Core\Utils\General;

class Header
{
    public static function init()
    {
        $class = new self;
        add_filter('globals/header', [$class, 'filter'], 10, 3);
    }

    public function filter($data)
    {
        $data->header_background_color = General::has_key('ID', $data)
            ? get_post_meta($data->ID, 'header_background', true)
            : 'white';

        if (General::is_post_type_archive('post')) {
            $data->header_background_color = 'transparent';
        }

        $data->mobile_menu_background = General::get_image_data((int)get_option('site_header_mobile_menu_background'));

        return $data;
    }
}