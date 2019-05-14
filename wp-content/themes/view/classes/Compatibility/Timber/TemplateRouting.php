<?php

namespace Pyxl\View\Compatibility\Timber;

use Timber;
use Pyxl\View\Utils;
use const Pyxl\View\PATH;
use const Pyxl\View\URI;
use const Pyxl\View\DEBUG;

class TemplateRouting
{

    const CONDITIONS = [
    ];

    public static function init()
    {
        $class = new self;
        add_action('view/head', [$class, 'head'], 25);
        add_action('view/header', [$class, 'header'], 30);
        add_action('view/main', [$class, 'main'], 25);
        add_action('view/footer', [$class, 'footer'], 30);
    }

    public function head()
    {
        if (!class_exists(Timber\Timber::class)) {
            return;
        }
        $context = Timber\Timber::get_context();
        Utils\Timber::render([
            'path' => 'Globals/Head',
            'hook' => 'globals/head',
            'data' => $context,
        ]);
    }

    public function header()
    {
        if (!class_exists(Timber\Timber::class)) {
            return;
        }
        $context = Timber\Timber::get_context();
        Utils\Timber::render([
            'path' => 'Globals/Header/Header',
            'hook' => 'globals/header',
            'data' => $context,
        ]);
    }

    public function main()
    {
        if (!class_exists(Timber\Timber::class)) {
            do_action('view_main_timber_inactive');
            return;
        }

        $type    = $this->get_view_type();
        $queried = get_queried_object();
        $context = Timber\Timber::get_context();
        $post_type = is_post_type_archive() ? $queried->name : $queried->post_type;

        switch ($type) {
            case 'Archives':
                $archive_type = self::get_archive_type();
                $dir_path     = self::get_sub_path($post_type);
                switch ($archive_type) {
                    case 'PostTypes';
                        $context['post_type'] = get_post_type_object(is_home() ? 'post' : $post_type);
                        break;
                    case 'Taxonomies';
                        $context['term'] = new Timber\Term();
                        break;
                }
                $context['posts'] = new Timber\PostQuery();
                $path             = "{$type}/{$archive_type}/{$dir_path}/{$dir_path}";
                var_dump($path);
                $context['path']  = file_exists(PATH . "views/{$path}.twig")
                    ? $path
                    : "{$type}/{$archive_type}/Fallback/Fallback";
                break;
            case 'Singles':
                $dir_path        = self::get_sub_path($post_type);
                $context['post'] = new Timber\Post();
                $path            = "{$type}/{$dir_path}/{$dir_path}";
                $context['path'] = file_exists(PATH . "views/{$path}.twig")
                    ? $path
                    : "{$type}/Fallback/Fallback";
                break;
            case 'Search':
                $context['search_query'] = get_search_query();
                $context['posts']        = new Timber\PostQuery();
                $context['path']         = "{$type}/{$type}";
                break;
            default:
                $context['path'] = "FourOhFour/FourOhFour";
                // Probably 404
                break;
        }

        if (DEBUG) {
            var_dump($context);
        }

        if (apply_filters('view/main/render', true)) {
            Utils\Timber::render([
                'path' => $context['path'],
                'hook' => $context['path'],
                'data' => $context,
            ]);
        }
    }

    public static function get_archive_type()
    {
        if (is_home() || is_post_type_archive()) {
            return 'PostTypes';
        }
        if (is_tax() || is_tag() || is_category()) {
            return 'Taxonomies';
        }
    }

    public static function get_sub_path($post_type)
    {
        $post_type_object       = get_post_type_object(is_home() ? 'post' : $post_type);
        $forced_uppercase_label = ucwords($post_type_object->label);
        $no_spaces_label        = str_replace(' ', '', $forced_uppercase_label);

        return $no_spaces_label;
    }


    public function footer()
    {
        if (!class_exists(Timber\Timber::class)) {
            return;
        }
        $context = Timber\Timber::get_context();
        Utils\Timber::render([
            'path' => 'Globals/Footer/Footer',
            'hook' => 'globals/footer',
            'data' => $context,
        ]);
    }


    public function get_view_type()
    {
        $type = 'FourOhFour'; // Default

        if (is_singular() || is_page()) {
            $type = 'Singles';
        }

        if (is_archive() || is_home()) {
            $type = 'Archives';
        }

        if (is_search()) {
            $type = 'Search';
        }

        return apply_filters('view/type', $type);
    }
}
