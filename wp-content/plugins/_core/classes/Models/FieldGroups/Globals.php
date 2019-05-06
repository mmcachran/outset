<?php

namespace Core\Models\FieldGroups;

use Core\Data\Fields;
use Core\Models\PostTypes;
use Core\Models\OptionsPages;
use Core\Utils\GravityForms as GF;

class Globals extends RegisterFieldGroup
{
    public static function init()
    {
        $fields = [

        ];

        $location = [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => OptionsPages\Globals::SLUG,
                ],
            ],
        ];

        parent::register([
            'slug'            => OptionsPages\Globals::SLUG,
            'label_placement' => 'top',
            'name'            => __('Options', 'core'),
            'fields'          => $fields,
            'position'        => 'normal',
            'location'        => $location,
        ]);
    }
}
