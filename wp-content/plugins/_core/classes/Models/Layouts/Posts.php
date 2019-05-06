<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;
use Core\Models\PostTypes;

class Posts extends RegisterLayout
{
    public static function init()
    {
        $acf = new Fields();

        $fields = [
            $acf->tab_general,
            $acf->heading,
            $acf->categories,
            // $acf->tags,
            $acf->tab_advanced,
            $acf->add('button_group', [
                'label'   => 'Display',
                'slug'    => 'display',
                'choices' => [
                    'vertical'   => 'Vertical',
                    'horizontal' => 'Horizontal',
                ],
            ]),
        ];

        $args = [
            'name'   => __('Posts', 'core'),
            'slug'   => 'Posts',
            'fields' => $fields,
        ];
        parent::register($args);
    }
}