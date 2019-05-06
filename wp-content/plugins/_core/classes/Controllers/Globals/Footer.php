<?php

namespace Core\Controllers\Globals;

use Core\Utils\General;

class Footer
{
    public static function init()
    {
        $class = new self;
        add_filter('globals/footer', [$class, 'filter'], 10, 3);
    }

    public function filter($data)
    {
        $post_id            = get_the_ID();
        $data->footer_type  = get_post_meta($post_id, 'footer', true) ?: 'social';
        $data->footer_image = General::get_image_data(get_option('site_footer_image'));
        $data->form         = get_option('site_footer_form');
        return $data;
    }
}