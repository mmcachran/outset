<?php

namespace Core\Models\Blocks;

use Core\Models\Blocks;
use Core\Utils\Fields;

class Featurette extends RegisterBlock
{
    /**
     * @const VIEW
     * @note Should be Uppercase, no spaces, no dashes (e.g. CallToAction), used for filenames and slugs
     */
    const VIEW = 'Featurette';

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
            'easy_enqueues' => ['scripts', 'styles'], // options: styles, scripts
            'view'          => self::VIEW,
            'label'         => __('Custom - Featurette', 'core'),
            'description'   => __("The Featurette Block", 'core'),
            'icon'          => 'laptop', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
            'supports' => [
                'align' => ['full'],
            ],
            'keywords'      => ['hero', 'custom', 'pyxl'],
            'fields'        => $fields,
        ]);
    }
}