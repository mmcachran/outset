<?php

namespace Core\Controllers\PostTypes;

use Core\Utils\General;
use Core\Models\OptionsPages\Globals;

class Post
{
    public static function init()
    {
        $class = new self;
        add_filter('rest_prepare_post', [$class, 'rest_data'], 10, 3);
        add_filter('singles/posts', [$class, 'singles']);
        add_filter('archives/post_types/posts', [$class, 'archives']);
    }

    public function archives($data)
    {
        // Define Sorting options
        $sort_options = [
            'asc'  => 'Most Recent',
            'desc' => 'Oldest',
        ];

        // Set sort option and check for a user
        $sortby = isset($_GET['sortby'])
            ? sanitize_text_field($_GET['sortby'])
            : 'asc';

        $featured_post_id = (int)get_option(Globals::PREFIX . 'post_featured_post');

        $per_page = 5;

        $latest_post   = General::get_latest_post('post');
        $featured_post = General::get_post('post', $featured_post_id);

        $posts_request = General::get_posts('post', [
            'per_page' => $per_page,
            'page'     => $data->paged,
            'order'    => $sortby,
            'exclude'  => $featured_post->id ?: $latest_post->id,
        ]);

        $data->featured_post = $featured_post_id ? $featured_post : $latest_post;

        $data = General::merge($data, $posts_request);

        // Best way to push array item to the top of the array... because PHP
        $data->sort_options = [$sortby => $sort_options[$sortby]] + $sort_options;
        return $data;
    }

    public function singles($data)
    {
        return General::merge(
            $data,
            General::get_post('post', $data->ID)
        );
    }

    public function rest_data($data, $post, $context)
    {
        $data->data['image'] = General::get_image_data($data->data['featured_media']);
        return $data;
    }
}