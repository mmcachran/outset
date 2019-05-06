<?php

namespace Core\Compatibility;

class BlockEditor
{
    const WHITELIST = [
        'post',
    ];

    public static function init()
    {
        $class = new self;
        add_filter('use_block_editor_for_post_type', [$class, 'disable_block_editor'], 10, 2);
    }

    public function disable_block_editor($use_block_editor, $post_type)
    {
        if (in_array($post_type, self::WHITELIST)) {
            return true;
        }

        return false;
    }
}