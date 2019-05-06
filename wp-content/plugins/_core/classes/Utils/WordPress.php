<?php

namespace Core\Utils;

use WP_REST_Request;

class WordPress
{
    public static function get_post($post_type = 'post', $id = 0)
    {
        $post_type = get_post_type_object($post_type);
        $request   = new WP_REST_Request('GET', "/wp/v2/{$post_type->rest_base}/{$id}");
        $response  = rest_do_request($request);
        if ($response->is_error()) {
            // Convert to a WP_Error object.
            return $response->as_error();
        }

        return (object)$response->get_data();
    }

    public static function get_posts($post_type = 'post', $params = [])
    {
        $post_type = get_post_type_object($post_type);
        $request   = new WP_REST_Request('GET', "/wp/v2/{$post_type->rest_base}");
        empty($params) ?: $request->set_query_params($params);
        $response = rest_do_request($request);
        if ($response->is_error()) {
            // Convert to a WP_Error object.
            return $response->as_error();
        }

        return (object)[
            'total_items' => $response->headers['X-WP-Total'],
            'total_pages' => $response->headers['X-WP-TotalPages'],
            'pagination'  => self::get_pagination_data($response->headers['X-WP-TotalPages']),
            'posts'       => $response->get_data(),
        ];
    }

    public static function get_latest_post($post_type = 'post')
    {
        $post_request = self::get_posts($post_type, [
            'per_page' => 1,
        ]);

        $post = is_array($post_request->posts) ? $post_request->posts[0] : [];
        return (object)$post;
    }

    public static function get_pagination_data($total_pages, $post_type = 'post')
    {
        $current_page = (int)get_query_var('paged') ?: 1;
        $link         = get_post_type_archive_link($post_type);
        $array        = [];
        $query        = General::has_key('sortby', $_GET) ? "?sortby={$_GET['sortby']}" : '';
        for ($i = 1; $i <= $total_pages; $i++) {
            $array[] = [
                'url'   => "{$link}page/{$i}{$query}",
                'index' => "{$i}",
            ];
        }
        $previous_page = ($current_page - 1);
        $next_page     = ($current_page + 1);
        return [
            'current' => $current_page,
            'pages'   => $total_pages,
            'prev'    => [
                'url'   => "{$link}page/{$previous_page}{$query}",
                'index' => $previous_page,
            ],
            'next'    => [
                'url'   => "{$link}page/{$next_page}{$query}",
                'index' => $next_page,
            ],
            'items'   => $array,
        ];
    }
}