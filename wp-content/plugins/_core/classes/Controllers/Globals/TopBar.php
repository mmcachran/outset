<?php

namespace Core\Controllers\Globals;

class TopBar
{
    public static function init()
    {
        $class = new self;
        add_filter('globals/footer', [$class, 'filter'], 10, 3);
    }

    public function filter($data)
    {
        $post_id = get_the_ID();
        $data->top_bar_background_color = get_post_meta($post_id, 'top_bar_background', true) ?: 'white';
        return $data;
    }
}