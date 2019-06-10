<?php

namespace Core\Models\FieldGroups;

use Core\Utils\General as Util;
use Core\Utils\ACF;
use Core\Utils\General;
use WP_Error;

class RegisterFieldGroup
{
    const REQUIRED_KEYS = [
        'name',
        'slug',
        'fields',
    ];

    protected static function register($args)
    {
        foreach (self::REQUIRED_KEYS as $key) {
            if (Util::has_key($key, $args)) {
                continue;
            }
            return new WP_Error('broke', __('Arguments "' . $key . '" is required', 'core'));
        }
        if (!function_exists('get_field')) {
            // Disable if ACF is not active
            return false;
        }

        $default = self::setup_args($args);

        $args = array_merge($default, $args);

        $args['fields'] = ACF::slug_handler($args['slug'], $args['fields']);

        register_field_group($args);
    }

    private static function setup_args($args)
    {
        $name = $args['name'];
        $slug = $args['slug'];

        $args = [
            'key'                   => "group_{$slug}",
            'title'                 => "{$name}",
            'menu_order'            => 0,
            'position'              => 'normal',
            'style'                 => 'default',
            'label_placement'       => 'top',
            'instruction_placement' => 'label',
            'description'           => '',
            'fields'                => [],
            'hide_on_screen'        => [
                // 'permalink',
                // 'the_content',
                // 'excerpt',
                // 'discussion',
                // 'comments',
                // 'revisions',
                // 'slug',
                // 'author',
                // 'format',
                // 'page_attributes',
                // 'featured_image',
                // 'categories',
                // 'tags',
                // 'send-trackbacks',
            ],
            'location'              => [
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'post',
                    ],
                ],
            ],
        ];

        return $args;
    }
}