<?php

namespace Pyxl\View\Utils;

use const Pyxl\View\PATH;
use const Pyxl\View\URI;

class Helpers
{

    public static function get_dist_uri($filepath)
    {
        return get_template_directory_uri() . "/dist/{$filepath}";
    }

    public static function object_merge()
    {
        $data = [];
        foreach (func_get_args() as $arg) {
            $data = array_merge($data, (array)$arg);
        }
        return (object)$data;
    }

    public static function archive_link($post_type = false)
    {
        if (!$post_type) {
            $post_type = get_post_type();
        }

        return get_post_type_archive_link($post_type);
    }

    public static function svg_inline($filename)
    {
        $filepath = PATH . 'dist/svgs/' . $filename . '.svg';

        if (!file_exists($filepath)) {
            return;
        }

        ob_start();

        include $filepath;

        $html = ob_get_clean();
        return $html;
    }

    public static function get_dist_image_uri($file)
    {
        return get_template_directory_uri() . "/dist/images/{$file}";
    }

    public static function image($args)
    {
        $filename          = $args['file'];
        $alt               = $args['alt'];
        $relative_filepath = "dist/images/{$filename}";
        $url               = file_exists(PATH . $relative_filepath) ? URI . $relative_filepath : false;
        return "<img src='{$url}' alt='{$alt}'>";
    }

    public static function is_empty($data)
    {
        if (is_integer($data)) {
            return false;
        }
        if (is_string($data)) {
            return empty(trim($data));
        }
        if (is_array($data)) {
            return empty($data);
        }
        if (is_object($data)) {
            return empty((array)$data);
        }
    }


    /**
     * Check if the current variable is set, and is not NULL, in the WP_Query class.
     *
     * @see    WP_Query::$query_vars
     * @uses   $wp_query
     *
     * @param  string $var The variable key to be checked.
     * @return bool         True if the current variable is set.
     */

    public static function has_query_var($var)
    {
        global $wp_query;

        return isset($wp_query->query_vars[$var]);
    }

    public static function has_key($key, $data)
    {
        if (is_array($data)) {
            return array_key_exists($key, $data);
        }
        if (is_object($data)) {
            return property_exists($data, $key);
        }
    }

    public static function noop()
    {
        return null;
    }


    /**
     * @param $file
     *
     * @return bool|int|null
     * @since 1.9.0
     */
    public static function cache_buster($file)
    {
        return file_exists(PATH . $file) ? filectime(PATH . $file) : null;
    }

    /**
     * @param $path
     *
     * @return null|string
     */
    public static function env_check($path)
    {
        // Our default variable, will pass as null by default.
        $qualifiedFile = null;
        $themePath     = PATH;
        $themeUri      = URI;

        // If dev file exists e.g( app.js ) override $qualifiedFile.
        if (file_exists($themePath . $path)) {
            $qualifiedFile = $themeUri . $path;
        }

        // Create a string to match a possible production file e.g.( app.min.js ) which is likely uglified/minified.
        $extensionPos   = strrpos($path, '.');
        $fileProduction = substr($path, 0, $extensionPos) . '.min' . substr($path, $extensionPos);

        // Test for production file e.g.( app.min.js) override $qualifiedFile.
        if (file_exists($themePath . $fileProduction)) {
            $qualifiedFile = $themeUri . $fileProduction;
        }

        // In order or priority return null, development file, or production file.
        return $qualifiedFile;
    }

    public static function generate_view_name($srting)
    {
        return preg_replace('/\s+/', ' ', ucfirst($srting));
    }
}