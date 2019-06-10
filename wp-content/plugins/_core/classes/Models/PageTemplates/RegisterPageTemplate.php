<?php

// https://wordpress.stackexchange.com/questions/3396/create-custom-page-templates-with-plugins
// https://github.com/wpexplorer/page-templater/blob/master/pagetemplater.php

namespace Core\Models\PageTemplates;

class RegisterPageTemplate
{
    public static function register($args)
    {
        // Add a filter to the save post to inject out template into the page cache
        // add_filter('wp_insert_post_data', function ($atts) use ($args) {
        //     self::register_template($atts, $args);
        // });

        // var_dump($args);
        // die;

        // Add a filter to the wp 4.7 version attributes metabox
        add_filter('theme_page_templates', function ($posts_templates) use ($args) {
            return array_merge($posts_templates, [
                $args['slug'] => $args['plural'],
            ]);
        });
    }


    /**
     * into thinking the template file exists where it doesn't really exist.
     * Adds our template to the pages cache in order to trick WordPress
     *
     * @param $atts
     * @return mixed
     */
    public static function register_template($atts, $args)
    {
        // Create the key used for the themes cache
        $cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());

        // Retrieve the cache list.
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();
        if (empty($templates)) {
            $templates = [];
        }

        // New cache, therefore remove the old one
        wp_cache_delete($cache_key, 'themes');

        // Now add our template to the list of templates by merging our templates
        // with the existing templates array from the cache.
        $templates = array_merge($templates, [
            $args['slug'] => $args['plural'],
        ]);

        // Add the modified cache to allow WordPress to pick it up for listing
        // available templates
        wp_cache_add($cache_key, $templates, 'themes', 1800);

        return $atts;
    }
}