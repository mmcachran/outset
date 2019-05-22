<?php

namespace Core\Models\PostTypes;

class Posts
{
    const SLUG = 'post';

    const REST_BASE = 'posts';

    const SINGULAR = 'Post';

    const PLURAL = 'Posts';

    public static function init()
    {
        $class = new self;
        add_action('init', [$class, 'modify']);
    }

    public function modify()
    {
        remove_post_type_support(self::SLUG, 'custom-fields');
    }
}