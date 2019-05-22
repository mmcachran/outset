<?php

namespace Core\Models\Blocks;

use const Core\PATH;
use Core\Utils\ACF;
use Core\Utils\General as Util;
use Timber\Timber;
use WP_Error;

class RegisterBlock
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

        // Register "Gutenberg" Block
        self::register_block($args);

        // Register Field Group to Block
        self::register_field_group($args);

        // Add Block to whitelist
        add_filter('allowed_block_types', function ($allowed_blocks, $post) use ($args) {
            $blocks = array_merge($allowed_blocks, ["acf/{$args['slug']}"]);
            // var_dump($blocks);
            // die;
            return;
        }, 15, 2);
    }

    private static function register_field_group($args)
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        acf_add_local_field_group([
            'key'      => "Block/{$args['slug']}",
            'title'    => __($args['name'], 'view'),
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

    private static function register_block($args)
    {
        $defaults = [
            'align'           => 'full',
            'name'            => $args['slug'],
            'title'           => __($args['name'], 'view'),
            'description'     => "The {$args['name']} block",
            'render_callback' => function ($block, $content = '', $is_preview = false) use ($args) {

                $view_path = sprintf(
                    '%1$s/views/Blocks/%2$s/%2$s.twig',
                    get_stylesheet_directory(),
                    $args['slug']
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
                // 'mode' => false,
                // 'align' => 'full-width',
            ],
            'category'        => 'layout',
            'icon'            => 'layout', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
            'mode'            => 'preview',
            'keywords'        => [$args['slug']],
        ];

        acf_register_block(array_merge($defaults, $args));
    }
}