<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;

class Blurbs extends RegisterLayout
{
    public static function init()
    {
        $acf = new Fields();

        $blurb_fields = [
            $acf->add('heading'),
            $acf->add('image'),
            $acf->add('content'),
            $acf->add('link'),
        ];

        $fields = [
            $acf->tab_general,
            $acf->add('wysiwyg', [
                'label' => 'Content',
            ]),
            $acf->tab_advanced,
        ];

        $fields = [
            $acf->tab_general,
            $acf->heading,
            $acf->add('repeater'),
            [
                'label'        => '',
                'slug'         => 'blurbs',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => __('Add Blurb', 'core'),
                'sub_fields'   => $blurb_fields,
            ],
            $acf->tab_advanced,
        ];

        $args = [
            'name'   => __('Blurbs', 'core'),
            'slug'   => 'Blurbs',
            'fields' => $fields,
        ];

        parent::register($args);
    }
}