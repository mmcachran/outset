<?php

namespace Core\Utils;

use WP_REST_Request;

class Data
{
    public static function get_posts($post_type = 'posts', $params = [])
    {
        $request = new WP_REST_Request('GET', "/wp/v2/{$post_type}");
        empty($params) ?: $request->set_query_params($params);
        $response = rest_do_request($request);
        if ($response->is_error()) {
            // Convert to a WP_Error object.
            return $response->as_error();
        }

        return $response->get_data();
    }

    public static function get_post($post_type, $id)
    {
        $request  = new WP_REST_Request('GET', "/wp/v2/{$post_type}/{$id}");
        $response = rest_do_request($request);
        if ($response->is_error()) {
            // Convert to a WP_Error object.
            return $response->as_error();
        }

        return $response->get_data();
    }

    public static function get_image_data($id)
    {
        if (!is_integer($id) || !$id) {
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
}