<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;

class Video extends RegisterLayout
{
    public static function init()
    {
        $acf = new Fields();

        $fields = [
            $acf->tab_general,
            $acf->heading,
            $acf->subheading,
            $acf->video,
            $acf->tab_advanced,
        ];

        $args = [
            'name'   => __('Video', 'core'),
            'slug'   => 'Video',
            'fields' => $fields,
        ];
        parent::register($args);
    }
}