<?php

namespace Core\Models\FieldGroups;

use Core\Utils\Fields;
use Core\Models\PostTypes;

class Testimonial extends RegisterFieldGroup
{
    const SLUG = 'testimonials';
    const SINGULAR = 'Testimonial';
    const PLURAL = 'Testimonials';

    public static function init()
    {
        $fields = [

        ];
        parent::register([
            'slug'     => self::SLUG,
            'name'     => __('Additional Information', 'core'),
            'fields'   => $fields,
            'position' => 'side',
            'location' => [
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => PostTypes\Testimonial::SLUG,
                    ],
                ],
            ],
        ]);
    }
}
