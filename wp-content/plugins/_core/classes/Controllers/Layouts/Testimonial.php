<?php

namespace Core\Controllers\Layouts;

use Core\Utils\General;
use Core\Models\Layouts;
use Core\Models\PostTypes;

class Testimonial
{
    public static function init()
    {
        $class     = new self;
        $post_type = Layouts\Testimonial::SLUG;

        add_filter("layouts/{$post_type}", [$class, 'filter']);
        add_filter("rest_prepare_{$post_type}", [$class, 'rest_data'], 10, 3);
    }

    public function rest_data($response, $post, $context)
    {
        $acf_fields = [
            'position',
            'name',
        ];
        foreach ($acf_fields as $field) {
            $response->data[$field] = get_post_meta($post->ID, $field, true);
        }
        $response->data['featured_image'] = General::get_image_data($response->data['featured_media']);
        return $response;
    }

    public function filter($context)
    {
        $context = (object)$context;

        $context->post = General::get_post(
            PostTypes\RegisterPostType::SLUG,
            $context->testimonial
        );

        return (array)$context;
    }
}