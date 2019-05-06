<?php

namespace Pyxl\View\StaticPages;

use Pyxl\View\Compatibility\Timber\TemplateRouting;
use Pyxl\View\Utils;
use Timber\Timber;
use const Pyxl\View\PATH;

class RegisterPage
{
    /**
     * @param $args
     * page_title
     * slug
     * path
     */
    public static function register($args)
    {
        add_filter('pre_get_document_title', function ($title) use ($args) {
            if (Utils\Helpers::has_query_var($args['slug'])) {
                $title = __($args['page_title'], 'view');
            }

            return $title;
        });

        add_action('init', function () use ($args) {
            add_rewrite_rule($args['slug'], sprintf('index.php?%s=true', $args['slug']), 'top');
        }, 10, 0);

        add_filter('query_vars', function ($vars) use ($args) {
            $vars[] = $args['slug'];
            return $vars;
        });

        add_action('view/main', function ($type) use ($args) {
            if (!Utils\Helpers::has_query_var($args['slug'])) {
                return;
            }

            Utils\Timber::render([
                'path' => $args['path'],
            ]);
        }, 1);

        add_filter('body_class', function ($classes) use ($args) {
            if (!Utils\Helpers::has_query_var($args['slug'])) {
                return $classes;
            }
            return [$args['slug']];
        }, 50);
    }
}