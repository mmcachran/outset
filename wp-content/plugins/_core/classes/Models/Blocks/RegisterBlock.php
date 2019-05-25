<?php

namespace Core\Models\Blocks;

use const Core\PATH;
use Core\Utils\ACF;
use Core\Utils\General;
use Timber\Timber;
use WP_Error;

class RegisterBlock
{
    const REQUIRED_KEYS = [
        'view',
        'label',
        'fields',
        'description',
    ];

    protected static function register($args)
    {
        foreach (self::REQUIRED_KEYS as $key) {
            if (General::has_key($key, $args)) {
                continue;
            }
            return new WP_Error('missing_keys', __('Arguments "' . $key . '" is required', 'core'));
        }

        $args['slug'] = General::convert_capitalcase_to_underscores($args['view']);

        // Register "Gutenberg" Block
        self::register_block($args);

        // Register Field Group to Block
        self::register_field_group($args);

        // Add Block to whitelist
        add_filter('allowed_block_types', function ($allowed_blocks, $post) use ($args) {
            return array_merge($allowed_blocks, ["acf/{$args['slug']}"]);
        }, 15, 2);
    }

    /**
     * @param $args
     * @link https://www.advancedcustomfields.com/resources/register-fields-via-php
     */
    protected static function register_field_group($args)
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        acf_add_local_field_group([
            'key'      => "Block/{$args['slug']}",
            'title'    => __($args['label'], 'core'),
            'fields'   => ACF::slug_handler($args['slug'], $args['fields']),
            'location' => [
                [
                    [
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => "acf/{$args['slug']}",
                    ],
                ],
            ],
            3,
        ]);
    }

    /**
     * @param $args
     * @link https://www.advancedcustomfields.com/resources/acf_register_block_type
     */
    protected static function register_block($args)
    {
        $slug = General::convert_capitalcase_to_underscores($args['view']);

        $defaults = [
            'align'           => 'full',
            'name'            => $slug,
            'title'           => $args['label'],
            'description'     => $args['description'],
            'render_callback' => function ($block, $content = '', $is_preview = false) use ($args) {

                $view_path = sprintf(
                    '%1$s/views/Blocks/%2$s/%2$s.twig',
                    get_stylesheet_directory(),
                    $args['view']
                );

                $context = Timber::get_context();

                $context = array_merge($context, [
                    'block'      => $block, // Store block values.
                    'acf'        => get_fields(), // Store field values.
                    'is_preview' => $is_preview, // Store $is_preview value.
                ]);

                // Render the block.
                Timber::render($view_path, $context);
            },
            'supports'        => [
                'mode'     => 'auto',
                'align'    => 'wide',
                'multiple' => true,
            ],
            'category'        => 'layout',
            'icon'            => 'dashicons-welcome-widgets-menus', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
            'mode'            => 'preview',
            'keywords'        => General::convert_capitalcase_to_keywords($args['view']),
        ];

        acf_register_block(array_merge($defaults, $args));
    }
}