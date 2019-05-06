<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;
use Core\Models\PostTypes;

class Testimonial extends RegisterLayout
{
    public static function init()
    {
        $acf = new Fields();

        $fields = [
            $acf->tab_general,
            $acf->add('post_object', [
                'label'         => 'Testimonial',
                'slug'          => 'testimonial',
                'post_type'     => [
                    PostTypes\Testimonial::SLUG,
                ],
                'return_format' => 'id',
            ]),
            $acf->tab_advanced,
        ];

        $args = [
            'name'   => __('Testimonial', 'core'),
            'slug'   => 'Testimonial',
            'fields' => $fields,
        ];
        parent::register($args);
    }
}