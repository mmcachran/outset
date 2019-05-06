<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;
use Core\Models\Layouts\RegisterLayout;
use Core\Data\GlobalFields;
use Core\Utils;

class Featurette extends RegisterLayout
{
    public static function init()
    {
        $acf = new Fields();

        $fields = [
            $acf->tab_general,
            $acf->add('button_group', [
                'label'   => 'Order',
                'slug'    => 'order',
                'choices' => [
                    'image_left'  => 'Image Left',
                    'image_right' => 'Image Right',
                ],
            ]),
            $acf->add('image'),
            $acf->add('heading'),
            $acf->add('content'),
            $acf->add('link'),
            $acf->tab_advanced,
        ];

        parent::register([
            'name'   => __('Featurette', 'core'),
            'slug'   => 'Featurette',
            'fields' => $fields,
        ]);
    }
}