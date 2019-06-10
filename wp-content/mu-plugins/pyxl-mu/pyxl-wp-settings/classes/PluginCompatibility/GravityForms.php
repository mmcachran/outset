<?php

namespace Pyxl\WPSettings\PluginCompatibility;

class GravityForms
{
    public static function init()
    {

        if (!in_array(
            'gravityforms/gravityforms.php',
            apply_filters('active_plugins', get_option('active_plugins'))
        )) {
            return;
        }

        $plugin = new self;
        /**
         * We should be handling Gravity Forms CSS ourselves
         * https://github.com/wpsitecare/gravity-forms-scss
         */
        add_action('init', [$plugin, 'removeCSS']);
        /**
         * We're trying to load as much JS in the footer as we can (including jQuery)
         * so we need to force Gravity Forms to handle their JS a litle differently
         */
        // GF method: http://www.gravityhelp.com/documentation/gravity-forms/extending-gravity-forms/hooks/filters/gform_init_scripts_footer/
        add_filter('gform_init_scripts_footer', '__return_true');
        // solution to move remaining JS from https://bjornjohansen.no/load-gravity-forms-js-in-footer
        add_filter('gform_cdata_open', [$plugin, 'wrapGformCDataOpen']);
        add_filter('gform_cdata_close', [$plugin, 'wrapGformCDataClose']);
    }

    public function wrapGformCDataClose($content = '')
    {
        $content = ' }, false );';

        return $content;
    }


    public function wrapGformCDataOpen($content = '')
    {
        $content = 'document.addEventListener( "DOMContentLoaded", function() { ';

        return $content;
    }

    public function removeCSS()
    {
        add_filter('pre_option_rg_gforms_disable_css', '__return_true');
    }
}