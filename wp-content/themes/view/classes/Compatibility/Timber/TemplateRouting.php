<?php

namespace Pyxl\View\Compatibility\Timber;

use Timber;
use Pyxl\View\Utils;
use const Pyxl\View\PATH;
use const Pyxl\View\URI;

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

        Utils\Timber::render([
            'view' => 'Globals/Head',
        ]);
    }

    public function header()
    {
        if (!class_exists(Timber\Timber::class)) {
            return;
        }

        Utils\Timber::render([
            'view' => 'Globals/Header',
        ]);
    }

    public function footer()
    {
        if (!class_exists(Timber\Timber::class)) {
            return;
        }

        Utils\Timber::render([
            'view' => 'Globals/Footer',
        ]);
    }

    public function main()
    {
        if (!class_exists(Timber\Timber::class)) {
            do_action('view/main/timber_check');
            return;
        }

        $context   = [];
        $type      = $this->get_view_type();
        $queried   = get_queried_object();
	    $post_type = Utils\Helpers::has_key('post_type', $queried) ? $queried->post_type : 'post';

        switch ($type) {
            case 'Archives':
                $archive_type = self::get_archive_type();
                $dir_path     = self::get_sub_path($post_type);
                switch ($archive_type) {
                    case 'PostTypes';
                        $context['post_type'] = get_post_type_object($post_type);
                        break;
                    case 'Taxonomies';
                        $context['term'] = new Timber\Term();
                        break;
                }
                $context['posts'] = new Timber\PostQuery();
                $path             = "{$type}/{$archive_type}/{$dir_path}";
                $context['view']  = file_exists(PATH . "views/{$path}.twig")
                    ? $path
                    : "{$type}/{$archive_type}/Fallback";
                break;
            case 'Singles':
                $dir_path        = self::get_sub_path($post_type);
                $context['post'] = new Timber\Post();
                $path            = "{$type}/{$dir_path}";
                $context['view'] = file_exists(PATH . "views/{$path}.twig")
                    ? $path
                    : "{$type}/Fallback";
                break;
            case 'Search':
                $context['search_query'] = get_search_query();
                $context['posts']        = new Timber\PostQuery();
                $context['view']         = "{$type}";
                break;
            default:
                $context['view'] = "FourOhFour";
                // Probably 404
                break;
        }

        if (apply_filters('view/main/render', true)) {
            Utils\Timber::render([
                'view' => $context['view'],
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
