<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;
use Core\Models\PostTypes;

class Slider extends RegisterLayout
{
    public static function init()
    {
        $acf = new Fields();

        $fields = [
            $acf->tab_general,
            $acf->slider,
            $acf->tab_advanced,
            $acf->add('number', [
                'label'         => 'Slider Speed',
                'instructions'  => '(milliseconds)',
                'slug'          => 'speed',
                'default_value' => '3000',
                'wrapper'       => [
                    'width' => '50%',
                ],
            ]),
            $acf->opacity,
            $acf->color,
        ];

        parent::register([
            'name'   => __('Slider', 'core'),
            'slug'   => 'Slider',
            'fields' => $fields,
        ]);
    }
}