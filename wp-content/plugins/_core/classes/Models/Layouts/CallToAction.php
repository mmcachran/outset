<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;

class CallToAction extends RegisterLayout
{
    public static function init()
    {
        $acf    = new Fields();
        $fields = [
            $acf->add('tab_general'),
            $acf->add('image'),
            $acf->add('heading'),
            $acf->add('content'),
            $acf->add('link'),
            $acf->add('tab_advanced'),
        ];

        $args = [
            'name'   => __('Call to action', 'core'),
            'slug'   => 'CallToAction',
            'fields' => $fields,
        ];
        parent::register($args);
    }
}