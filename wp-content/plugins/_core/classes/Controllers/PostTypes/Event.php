<?php

namespace Core\Controllers\PostTypes;

use Core\Utils\General;
use Core\Models\OptionsPages\Globals;

class Event
{
    public static function init()
    {
        $class     = new self;
        $post_type = 'event';
        add_filter("rest_prepare_{$post_type}", [$class, 'rest_data'], 10, 3);
        add_filter('singles/events', [$class, 'singles']);
        add_filter('archives/post_types/events', [$class, 'archives']);
    }

    public function archives($data)
    {
        // Define Sorting options
        $sort_options = [
            'asc'  => 'Most Recent',
            'desc' => 'Oldest',
        ];

        // Set sort option and check for a user
        $sortby = General::has_key('sortby', $_GET)
            ? sanitize_text_field($_GET['sortby'])
            : 'asc';

        $featured_post_id = (int)get_option(Globals::PREFIX . 'event_featured_event');

        $per_page = 5;

        $latest_post = General::get_latest_post('event');

        $featured_post = General::get_post('event', $featured_post_id);

        $data->featured_post = $featured_post_id ? $featured_post : $latest_post;

        $posts_request = General::get_posts('event', [
            'per_page' => $per_page,
            'page'     => $data->paged,
            'order'    => $sortby,
            'exclude'  => $featured_post_id ?: $latest_post->id,
        ]);


        $data = General::merge($data, $posts_request);

        // Best way to push array item to the top of the array... because PHP
        $data->sort_options = [$sortby => $sort_options[$sortby]] + $sort_options;
        return $data;
    }

    public function singles($data)
    {
        return General::merge(
            $data,
            General::get_post('event', $data->ID)
        );
    }

    public function rest_data($data, $post, $context)
    {
        $data->data['image'] = General::get_image_data($data->data['featured_media']);
        return $data;
    }
}