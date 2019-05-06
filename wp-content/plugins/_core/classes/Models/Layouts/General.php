<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;

class General extends RegisterLayout
{
    public static function init()
    {
        $acf    = new Fields();
        $fields = [
            $acf->tab_general,
            $acf->content,
            $acf->tab_advanced,
        ];

        $args = [
            'name'   => __('General', 'core'),
            'slug'   => 'General',
            'fields' => $fields,
        ];
        parent::register($args);
    }
}