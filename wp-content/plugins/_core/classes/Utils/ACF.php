<?php

namespace Core\Utils;

use Timber;

class ACF
{
    /**
     * @param $post_id
     * @return false|string
     */
    public static function get_layouts_content($post_id)
    {
        if (!function_exists('get_field') || !class_exists(Timber\Timber::class)) {
            return;
        }
        $path_theme = get_stylesheet_directory();
        $layouts    = get_field('modules', $post_id);
        ob_start();
        foreach ($layouts as $layout) {
            $file = $layout['acf_fc_layout'];
            Timber\Timber::render("{$path_theme}/views/layouts/{$file}/{$file}.twig", $layout);
        }
        $content = ob_get_clean();

        return $content;
    }

    /**
     * ACF::Field
     * Example Usage: ACF::get_acf_field_group_values('group_page_settings');
     *
     * @param $key
     * @return array
     */
    public static function get_acf_field_group_values($key)
    {
        if (!function_exists('get_field')) {
            return;
        }

        $data   = [];
        $fields = acf_get_fields($key);
        foreach ($fields as $field) {
            $data[$field['name']] = get_field($field['name']);
        }

        return $data;
    }

    /**
     * ACF::field
     * Example Usage: ACF::field($prefix, 'Title', ['type' => 'text', 'instructions' => '']),
     *
     * @param string $prefix
     * @param string $name
     * @param array $options
     * @return array
     */
    public static function field($prefix, $name, $options = [])
    {
        $suffix = strtolower(preg_replace("/[\-_]/", " ", sanitize_title($name)));
        return array_merge($options, [
            'key'   => "{$prefix}_{$suffix}",
            'name'  => $suffix,
            'label' => $name,
        ]);
    }

    /**
     * @param $prefix
     * @param $fields
     * @return array
     */
    public static function slug_handler($prefix, $fields)
    {
        $acf_fields = [];
        foreach ($fields as $field) {
            $new_field = [
                'key'  => "{$prefix}/{$field['slug']}",
                'name' => $field['slug'],
            ];

            if (General::has_key('sub_fields', $field)) {
                $new_field['sub_fields'] = self::slug_handler($prefix, $field['sub_fields']);
            }
            // TODO: Mizner, review this ternary. There's probably a better way
            $acf_fields[] = array_merge($field ?: [], $new_field);
        }
        return $acf_fields;
    }

    public static function conditional_logic_keys($prefix, $fields)
    {
        $new_fields = [];

        foreach ($fields as $field) {

            $new_field = [];

            if (General::has_key('conditional_logic', $field)) {
                foreach ($field['conditional_logic'] as $condition) {
                    $new_logic = [];

                    foreach ($condition as $logic) {
                        $new_logic[] = array_merge($logic, [
                            'field' => "{$prefix}/{$logic['field']}",
                        ]);
                    }

                    $new_field['conditional_logic'][] = $new_logic;
                }
            }

            $new_fields[] = array_merge($field, $new_field);
        }

        return $new_fields;
    }
}