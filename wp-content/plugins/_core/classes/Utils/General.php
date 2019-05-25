<?php

namespace Core\Utils;

use WP_REST_Request;
use WP_Query;

class General
{
    public static function is_post_type_archive($post_types = [])
    {
        if (is_home()) {
            return true;
        }

        if (is_string($post_types)) {
            return is_post_type_archive($post_types);
        }

        foreach ($post_types as $post_type) {
            if (is_post_type_archive($post_type)) {
                return true;
            }
        }
        return false;
    }

    public static function has_key($key, $data)
    {
        if (is_array($data)) {
            return array_key_exists($key, $data);
        }
        if (is_object($data)) {
            return property_exists($data, $key);
        }
    }

    public static function merge()
    {
        $data = [];
        foreach (func_get_args() as $arg) {
            $data = array_merge($data, (array)$arg);
        }
        return (object)$data;
    }

    public static function convert_capitalcase_to_keywords($input)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', ' $0', $input));
    }

    public static function convert_underscores_to_capitalcase($input)
    {
        return str_replace('_', '', ucwords($input, '_'));
    }

    public static function convert_capitalcase_to_underscores($input = '')
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }

    public static function get_image_data($id)
    {
        if (!$id) {
            return [];
        }

        $uploads   = wp_get_upload_dir();
        $metadata  = wp_get_attachment_metadata($id);
        $image_dir = $uploads['baseurl'] . '/' . str_replace(basename($metadata['file']), '', $metadata['file']);


        $sizes = [];
        foreach ($metadata['sizes'] as $size => $size_data) {
            $file         = str_replace(basename($size_data['file']), '', $size_data['file']);
            $sizes[$size] = array_merge($size_data, [
                'url' => "{$image_dir}{$size_data['file']}",
            ]);
        }


        $image = array_merge($metadata, [
            'url'   => "{$uploads['baseurl']}/{$metadata['file']}",
            'alt'   => get_post_meta($id, '_wp_attachment_image_alt', true),
            'sizes' => $sizes,
        ]);

        return $image;
    }

    /**
     * Provides an easy eay to display an administration notice based on the incoming
     * class and message.
     *
     * @param string $class the class to add to the notice (warning, error, success)
     * @param string $message the message to display in the administration notice area
     */
    public static function display_admin_notice($class, $message)
    {
        add_action(
            'admin_notices',
            function () use ($class, $message) {
                printf(
                    '<div class="%1$s"><p>%2$s</p></div>',
                    esc_attr($class),
                    esc_html($message)
                );
            }
        );
    }
}