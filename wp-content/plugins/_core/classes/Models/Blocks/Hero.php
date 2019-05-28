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
            $acf->add('select', [
                'label'   => __('Choices', 'core'),
                'slug'    => 'choices',
                'type'    => 'select',
                'choices' => [
                    'one' => 'One',
                    'two' => 'Two',
                ],
            ]),
            $acf->add('heading', [
                'conditional_logic' => $acf->simple_conditional_logic([
                    'field'    => 'choices',
                    'operator' => '==',
                    'value'    => 'one',
                ]),
            ]),
            $acf->simple_conditional_logic([
                'field'    => 'choices',
                'operator' => '==',
                'value'    => 'one',
            ]),
            $acf->subheading,
            $acf->image,
            $acf->content,
            $acf->link,
            $acf->tab_advanced,
        ];

        parent::register([
            'easy_enqueues' => ['script', 'style'],
            'view'          => self::VIEW,
            'label'         => __('Custom - Hero', 'core'),
            'description'   => __("The Hero Block", 'core'),
            'icon' => 'dashicons-welcome-view-site',
            'keywords'      => ['hero', 'custom'],
            'fields'        => $fields,
        ]);
    }
}