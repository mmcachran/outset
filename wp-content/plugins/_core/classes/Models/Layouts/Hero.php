<?php

namespace Core\Models\Layouts;

use Core\Utils\Fields;
use Core\Models\PostTypes;

class Hero extends RegisterLayout
{
    public static function init()
    {
        $acf    = new Fields();
        $fields = [
            $acf->tab_general,
            $acf->heading,
            $acf->subheading,
            $acf->image,
            $acf->content,
            $acf->link,
            $acf->tab_advanced,
        ];

        parent::register([
            'name'   => __('Hero', 'core'),
            'slug'   => 'Hero',
            'fields' => $fields,
        ]);
    }
}