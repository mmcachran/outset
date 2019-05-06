<?php

namespace Pyxl\WPSettings\PluginCompatibility;

class WooCommerce
{
    private static $instance;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function init()
    {
        if (!in_array(
            'woocommerce/woocommerce.php',
            apply_filters('active_plugins', get_option('active_plugins'))
        )) {
            return;
        }

        add_action('wp_enqueue_scripts', [self::instance(), 'conditionalScripts']);
        add_action('wp_enqueue_scripts', [self::instance(), 'conditionStyles']);
        add_action('init', [self::instance(), 'removeWoocommerceGenerator'], 999);
    }

    public function conditionStyles()
    {
        if (is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_shop()) {
            // Not on a WooCommerce Page, abandon.
            return;
        }
        /**
         * Removes all styles
         * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet
         */
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_dequeue_style('woocommerce_frontend_styles');
        wp_dequeue_style('woocommerce_fancybox_styles');
        wp_dequeue_style('woocommerce_chosen_styles');
        wp_dequeue_style('woocommerce_prettyPhoto_css');
    }

    public function conditionalScripts()
    {
        if (is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_shop()) {
            // Not on a WooCommerce Page, abandon.
            return;
        }
        // If we're not on a Woocommerce page, dequeue all of these scripts.
        wp_dequeue_script('wc-add-to-cart');
        wp_dequeue_script('jquery-blockui');
        wp_dequeue_script('jquery-placeholder');
        wp_dequeue_script('woocommerce');
        wp_dequeue_script('jquery-cookie');
        wp_dequeue_script('wc-cart-fragments');
    }

    public function removeWoocommerceGenerator()
    {
        // No one publicly needs to know the version of WooCommerce we're running
        remove_action('wp_head', [$GLOBALS['woocommerce'], 'generator']);
    }
}