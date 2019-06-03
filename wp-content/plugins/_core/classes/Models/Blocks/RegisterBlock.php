<?php

namespace Core\Models\Blocks;

use const Core\PATH;
use Core\Utils\ACF;
use Core\Utils\General;
use Timber\Timber;
use WP_Error;

/**
 * Class RegisterBlock
 * @package Core\Models\Blocks
 */
class RegisterBlock
{
    const REQUIRED_KEYS = [
        'view',
        'label',
        'fields',
        'description',
    ];

    /**
     * @param $args
     * @return WP_Error
     */
    protected static function register($args)
    {
        foreach (self::REQUIRED_KEYS as $key) {
            if (General::has_key($key, $args)) {
                continue;
            }
            return new WP_Error('missing_keys', __('Arguments "' . $key . '" is required', 'core'));
        }

        // ACF handles blocks by converting to underscores to dashes, so we're *required* to use dashes (e.g. "call-to-action") for the filter
        $args['slug'] = General::convert_capitalcase_to_dashes($args['view']);

        // Register "Gutenberg" Block
        self::register_block($args);

        // Register Field Group to Block
        self::register_field_group($args);

        // Add Block to whitelist
        add_filter('core/blocks', function ($allowed_blocks) use ($args) {
            return array_merge($allowed_blocks, ["acf/{$args['slug']}"]);
        });
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
        if (!function_exists('acf_register_block')) {
            return;
        }

        $view_path = sprintf(
            '%1$s/views/Blocks/%2$s/%2$s',
            get_stylesheet_directory(),
            $args['view']
        );

        $view_dist_uri = sprintf(
            '%1$s/dist/Blocks/%2$s/%2$s',
            get_stylesheet_directory_uri(),
            $args['view']
        );

        $defaults = [
            'align'           => 'wide',
            'name'            => $args['slug'],
            'title'           => $args['label'],
            'description'     => $args['description'],
            'category'        => 'layout',
            'icon'            => 'layout', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
            'mode'            => 'preview',
            'keywords'        => General::convert_capitalcase_to_keywords($args['view']),
            'supports'        => [
                'mode'     => 'auto',
                'align'    => ['full', 'wide'],
                'multiple' => true,
            ],
            'render_callback' => function ($block, $content = '', $is_preview = false) use ($args, $view_path) {
                $data               = function_exists('get_fields') ? get_fields() : [];
                $data['base']       = $args['view'];
                $data['path']       = get_stylesheet_directory() . $view_path;
                $data['block']      = $block;
                $data['is_preview'] = $is_preview;
                $data['context']    = Timber::context();

                // Render the block.
                Timber::render("{$view_path}.twig", apply_filters("Blocks/{$args['view']}", $data));
            },
        ];

        if (General::has_key('easy_enqueues', $args) && in_array('script', $args['easy_enqueues'])) {
            $defaults['enqueue_script'] = "{$view_dist_uri}.js";
        }

        if (General::has_key('easy_enqueues', $args) && in_array('styles', $args['easy_enqueues'])) {
            $defaults['enqueue_style'] = "{$view_dist_uri}.css";
        }

        // var_dump(array_merge($defaults, $args));

        acf_register_block(array_merge($defaults, $args));
    }
}