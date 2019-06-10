<?php

namespace Core\Models\OptionsPages;

class Globals extends RegisterOptionsPage
{
    const SLUG = 'site';
    const PREFIX = self::SLUG . '_';
    const NAME = 'Site Options';
    const PLURAL = 'Globals';

    public static function init()
    {
        parent::register([
            'page_title' => self::NAME,
            'capability' => 'edit_posts',
            'position'   => -1,
            'menu_slug'  => self::SLUG,
            'post_id'    => self::SLUG,
        ]);
    }
}