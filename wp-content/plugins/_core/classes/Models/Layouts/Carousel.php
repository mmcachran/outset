<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;

class Carousel extends RegisterLayout
{
    public static function init()
    {
        $acf = new Fields();

        $fields = [
            $acf->tab_general,
            $acf->add('heading'),
            $acf->add('link'),
            $acf->add('repeater', [
                'label'        => 'Items',
                'slug'         => 'carousel_items',
                'button_label' => 'Add Image',
                'sub_fields'   => [
                    $acf->add('heading'),
                    $acf->add('image'),
                    $acf->add('content'),
                    $acf->add('link'),
                ],
            ]),
            $acf->tab_advanced,
            $acf->add('button_group', [
                'label'         => 'Grayscale images ?',
                'slug'          => 'grayscale',
                'choices'       => [
                    'yes' => 'Yes',
                    'no'  => 'No',
                ],
                'default_value' => 'no',
            ]),
        ];

        $args = [
            'name'   => __('Carousel', 'core'),
            'slug'   => 'Carousel',
            'fields' => $fields,
        ];

        parent::register($args);
    }
}