<?php

namespace Pyxl\WPSettings\Security;

class WPHead
{
    private static $instance;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function init()
    {
        if (!is_admin()) {
            add_filter('the_generator', [self::instance(), 'noGenerator']);
            add_action('template_redirect', [self::instance(), 'removeHeadItems']);
        }
    }

    /**
     * Do not generate and display WordPress version
     */
    public function noGenerator()
    {
        return '';
    }

    /**
     * Clean up wp_head() from unused or unsecure items
     */
    public function removeHeadItems()
    {
        // Rest API header links
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        // Remove the next and previous post links
        remove_action('wp_head', 'adjacent_posts_rel_link', 10);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
        // Remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
        remove_action('wp_head', 'feed_links', 2);
        // Removes all extra rss feed links
        remove_action('wp_head', 'feed_links_extra', 3);
        // Remove link to index page
        remove_action('wp_head', 'index_rel_link');
        // Remove parent post link
        remove_action('wp_head', 'parent_post_rel_link', 10);
        // Weblog Client Link
        remove_action('wp_head', 'rsd_link');
        // Remove random post link
        remove_action('wp_head', 'start_post_rel_link', 10);
        // Windows Live Writer Manifest Link.
        remove_action('wp_head', 'wlwmanifest_link');
        // WordPress Generator. (security)
        remove_action('wp_head', 'wp_generator');
        //
        remove_action('wp_head', 'wp_resource_hints', 2);
        // WordPress Page/Post Shortlinks.
        remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    }
}
