<?php

namespace Core\Controllers\Layouts;

use Core\Utils\General;
use Timber;

class Posts
{
    public static function init()
    {
        $class = new self;
        add_filter('Layouts/Posts', [$class, 'filter']);
    }

    public function filter($context)
    {
        $args = [
            'post_type'              => 'post',
            'posts_per_page'         => 4, // Reasonable limit
            'no_found_rows'          => true, // useful when pagination is not needed.
            'update_post_meta_cache' => false, // useful when post meta will not be utilized.
            'update_post_term_cache' => false, // useful when taxonomy terms will not be utilized.
        ];

        if ($context['categories']) {
            foreach ($context['categories'] as $category) {
                $args['category__in'][] = $category->term_id;
            }
        }

        $context['posts'] = Timber\Timber::get_posts($args);

        return $context;
    }
}