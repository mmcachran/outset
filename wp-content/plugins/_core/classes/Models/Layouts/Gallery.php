<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;

class Gallery extends RegisterLayout
{
    public static function init()
    {
        $acf    = new Fields();
        $fields = [
            $acf->tab_general,
            $acf->heading,
            $acf->gallery,
            $acf->tab_advanced,
        ];

        $args = [
            'name'   => __('Gallery', 'core'),
            'slug'   => 'Gallery',
            'fields' => $fields,
        ];
        parent::register($args);
    }
}