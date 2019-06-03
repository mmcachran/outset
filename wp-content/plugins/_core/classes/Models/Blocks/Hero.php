<?php

namespace Core\Models\Blocks;

use Core\Models\Blocks;
use Core\Utils\Fields;

class Hero extends RegisterBlock
{
    /**
     * @const VIEW
     * @note Should be Uppercase, no spaces, no dashes (e.g. CallToAction), used for filenames and slugs
     */
    const VIEW = 'Hero';

    public static function init()
    {

        $acf    = new Fields();
        $fields = [
            $acf->tab_general,
            $acf->heading,
            $acf->subheading,
            $acf->image,
            $acf->image,
            $acf->content,
            $acf->link,
            $acf->tab_advanced,
        ];

        parent::register([
            'easy_enqueues' => ['script', 'style'], // options: style, script
            'view'          => self::VIEW,
            'label'         => __('Custom - Hero', 'core'),
            'description'   => __("The Hero Block", 'core'),
            'icon'          => 'welcome-view-site', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
            'keywords'      => ['hero', 'custom'],
            'fields'        => $fields,
        ]);
    }
}