<?php

namespace Pyxl\WPSettings\Assets;

class Emoji
{

    private static $instance;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function init()
    {
        add_action('template_redirect', [self::instance(), 'emojicons']);
        add_filter('tiny_mce_plugins', [self::instance(), 'emojiconsTinymce']);
    }

    public function emojiconsTinymce($plugins)
    {
        if (is_array($plugins)) {
            return array_diff($plugins, ['wpemoji']);
        } else {
            return [];
        }
    }

    public function emojicons()
    {
        // all actions related to emojis
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
    }
}