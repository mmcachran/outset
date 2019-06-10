<?php

namespace Pyxl\View\Compatibility\GravityForms;

class InlineScripts
{
    public static function init()
    {
        $class = new self;

        add_filter('gform_cdata_open', [$class, 'cdata_open']);
        add_filter('gform_cdata_close', [$class, 'cdata_close']);
    }


    public function cdata_open($content = '')
    {
        $content = 'document.addEventListener( "DOMContentLoaded", function() { ';
        return $content;
    }

    public function cdata_close($content = '')
    {
        $content = ' }, false );';
        return $content;
    }
}