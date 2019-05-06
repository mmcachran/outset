<?php

namespace Core\Models\PostTypes;

use Core\Utils\ACF;

class Page
{
    const SLUG = 'page';

    const REST_BASE = 'pages';

    const SINGULAR = 'Page';

    const PLURAL = 'Pages';

    private static $instance;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function init()
    {
        $class = new self;
        add_action('init', [self::instance(), 'modify']);
        add_action('save_post', [self::instance(), 'save_actions'], 10, 3);
    }

    public function modify()
    {
        remove_post_type_support(self::SLUG, 'custom-fields');
    }

    public function save_actions($post_id, $post, $update)
    {
        if ('modules' !== $post->page_template) {
            return;
        }

        if (wp_is_post_revision($post_id)) {
            return;
        }

        // unhook this function so it doesn't loop infinitely
        remove_action('save_post', [self::instance(), 'save_actions']);

        $content = ACF::get_layouts_content($post_id);

        // update the post, which calls save_post again
        wp_update_post([
            'ID'           => $post_id,
            'post_content' => wp_kses_post($content),
        ]);

        // re-hook this function
        add_action('save_post', [self::instance(), 'save_actions']);
    }


}