<?php

namespace Core\Models\Blocks;

use Core\Models\Blocks;
use Core\Utils\Fields;

class Blurbs extends RegisterBlock
{
    /**
     * @const VIEW
     * @note Should be Uppercase, no spaces, no dashes (e.g. CallToAction), used for filenames and slugs
     */
    const VIEW = 'Blurbs';

    public static function init()
    {

        $acf        = new Fields();
        $sub_fields = [
            $acf->add('text', [
                'label' => __('Name', 'core'),
                'slug'  => 'name',
            ]),
            $acf->add('text', [
                'label' => __('Position', 'core'),
                'slug'  => 'position',
            ]),
            $acf->image,
            $acf->link,
        ];
        $fields     = [
            $acf->tab_general,
            $acf->heading,
            $acf->add('repeater', [
                'label'      => __('Blurbs', 'core'),
                'slug'       => 'blurbs',
                'sub_fields' => $sub_fields,
            ]),
            $acf->tab_advanced,

        ];

        parent::register([
            'easy_enqueues' => ['styles'], // options: styles, scripts
            'view'          => self::VIEW,
            'label'         => __('Custom - Hero', 'core'),
            'description'   => __("The Hero Block", 'core'),
            'icon'          => 'laptop', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
            'supports' => [
                'align' => ['full'],
            ],
            'keywords'      => ['hero', 'custom', 'pyxl'],
            'fields'        => $fields,
        ]);
    }
}