<?php

namespace Core\Models\Blocks;

use Core\Models\Blocks;
use Core\Utils\Fields;

class Posts extends RegisterBlock
{
    /**
     * @const VIEW
     * @note Should be Uppercase, no spaces, no dashes (e.g. CallToAction), used for filenames and slugs
     */
    const VIEW = 'Posts';

    public static function init()
    {

        $acf    = new Fields();
        $fields = [
            $acf->tab_general,
            $acf->heading,
            [
                'label'         => __('Posts', 'core'),
                'slug'          => 'posts',
                'type'          => 'post_object',
                'multiple'      => true,
                'post_type'     => [
                    'post',
                ],
                'return_format' => 'id',
            ],
            $acf->link,
            $acf->tab_advanced,
            $acf->padding_top,
            $acf->padding_bottom,
            $acf->appearance,
            $acf->content_width,
        ];

        parent::register([
            'easy_enqueues' => ['styles'],
            'view'          => self::VIEW,
            'label'         => __('Posts', 'core'),
            'description'   => __('', 'core'),
            'icon'          => 'laptop', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
            'keywords'      => ['cta', 'custom'],
            'fields'        => $fields,
        ]);
    }
}