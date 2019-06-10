<?php

namespace Core\Controllers\PageTemplates;

use Core\Utils\ACF;
use Core\Models\PageTemplates\Careers as PageTemplate;
use Core\Models\PostTypes\Careers as PostType;
use Timber;

class Careers
{
    public static function init()
    {
        $class = new self;
        add_filter('timber/context', [$class, 'add_to_context']);
    }

    public function add_to_context($context)
    {
        $template = get_page_template_slug();

        if (!is_page() || PageTemplate::SLUG !== $template) {
            return $context;
        }

        $context['template'] = $template;
        $context['careers']  = new Timber\PostQuery([
            'post_type' => PostType::SLUG,
        ]);

        // var_dump($context);

        return $context;
    }
}