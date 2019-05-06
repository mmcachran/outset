<?php

namespace Core\Models\FieldGroups;

use Core\Utils\Fields;

class PageSettings extends RegisterFieldGroup
{
    const SLUG = 'page_settings';
    const LABEL = 'Settings';

    public static function init()
    {
        $acf      = new Fields();
        $fields   = [
            $acf->add('select', [
                'label'         => __('Header', 'core'),
                'slug'          => 'header_options',
                'choices'       => [
                    'normal'      => __('Normal', 'core'),
                    'transparent' => __('Transparent', 'core'),
                ],
                'default_value' => 'normal',
            ]),
        ];
        $location = [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'page',
                ],
            ],
        ];
        parent::register([
            'slug'            => self::SLUG,
            'label_placement' => 'top',
            'name'            => __(self::LABEL, 'core'),
            'fields'          => $fields,
            'position'        => 'side',
            'location'        => $location,
        ]);
    }
}


