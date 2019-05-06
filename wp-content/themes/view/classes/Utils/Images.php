<?php

namespace Pyxl\View\Utils;

class Images
{
    public static function get_image_sizes()
    {
        global $_wp_additional_image_sizes;
        return $_wp_additional_image_sizes;
    }
}