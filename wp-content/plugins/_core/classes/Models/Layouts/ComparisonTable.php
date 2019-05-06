<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;
use Core\Utils\Brand;
use Core\Models\Layouts\RegisterLayout;

class ComparisonTable extends RegisterLayout
{
    public static function init()
    {
        $acf = new Fields();

        $fields = [
            $acf->tab_general,
            $acf->add('repeater', [
                'label'      => 'Products',
                'slug'       => 'products',
                'sub_fields' => [
                    $acf->image,
                    $acf->content,
                    $acf->link,
                ],
            ]),
            $acf->tab_advanced,
        ];

        $args = [
            'name'   => __('Comparison Table', 'core'),
            'slug'   => 'ComparisonTable',
            'fields' => $fields,
        ];

        parent::register($args);
    }
}