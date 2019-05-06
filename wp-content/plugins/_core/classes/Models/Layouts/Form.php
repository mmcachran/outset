<?php

namespace Core\Models\Layouts;

use Core\Models\Layouts\RegisterLayout;
use Core\Utils\Fields;
use Core\Utils\GravityForms as GF;

class Form extends RegisterLayout
{
    public static function init()
    {
        $acf = new Fields();

        $fields = [
            $acf->tab_general,
            $acf->add('heading'),
            $acf->add('image'),
            $acf->add('content'),
            $acf->forms,
            $acf->tab_advanced,
        ];

        $args = [
            'name'   => __('Form', 'core'),
            'slug'   => 'Form',
            'fields' => $fields,
        ];

        parent::register($args);
    }
}