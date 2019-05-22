<?php

namespace Core\Models\Blocks;

use Core\Models\Blocks;
use Core\Utils\Fields;

class Hero extends RegisterBlock
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
            'slug'     => 'Hero',
            'name'     => 'Hero',
            // 'icon' => 'dashicons-welcome-view-site',
            'keywords' => ['hero', 'slider'],
            'fields'   => $fields,
        ]);
    }
}