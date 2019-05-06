<?php

namespace Core\Models\FieldGroups;

class Modules extends RegisterFieldGroup
{
    const SLUG = 'modules';
    const SINGULAR = 'Module';
    const PLURAL = 'Modules';

    public static function init()
    {
        parent::register([
            'slug'           => self::SLUG,
            'name'           => __(self::PLURAL, 'core'),
            'fields'         => [
                [
                    'slug'         => self::SLUG,
                    'type'         => 'flexible_content',
                    'label'        => self::PLURAL,
                    'button_label' => 'Add ' . self::SINGULAR,
                    'layouts'      => apply_filters(self::SLUG, []),
                ],
            ],
            'hide_on_screen' => [
                'the_content',
            ],
            'location'              => [
                [
                    [
                        'param'    => 'post_template',
                        'operator' => '==',
                        'value'    => 'modules',
                    ],
                ],
            ],
        ]);
    }
}
