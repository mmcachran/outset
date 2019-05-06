<?php

namespace Pyxl\View\Markup;

class SocialMenu
{
    public static $platforms = [
        'facebook.com' => 'facebook-f',
        'twitter.com'  => 'twitter',
        'linkedin.com' => 'linkedin-in',
    ];

    public static function init()
    {
        $class = new self;
        add_filter('nav_menu_item_title', [$class, 'addIcons'], 10, 4);
    }

    public function addIcons($title, $item, $args, $depth)
    {
        if ('menu_social' !== $args->theme_location) {
            return $title;
        }

        $icon_slug = '';

        $parsed_url = parse_url($item->url);

        foreach (self::$platforms as $key => $value) {
            // Look for partial or exact match
            if (strpos($parsed_url['host'], $key) || $key === $parsed_url['host']) {
                $icon_slug = $value;
            }
        }

        $icon = "<svg class='icon'><use xlink:href='#icon-{$icon_slug}'/></svg>";
        $screen_reader_text = "<span class='screen-reader-text'>{$title}</span>";
        $html = $icon . $screen_reader_text;

        return $html;
    }
}