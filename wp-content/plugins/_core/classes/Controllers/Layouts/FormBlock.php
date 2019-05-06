<?php

namespace Core\Controllers\Layouts;

use Core\Utils\General;
use GFAPI;

class FormBlock
{
    public static function init()
    {
        $class = new self;
        add_filter('layouts/form-block', [$class, 'filter']);
    }

    public function filter($context)
    {
        if (class_exists(GFAPI::class)) {
            $context['form_data'] = General::has_key('form', $context) ? GFAPI::get_form($context['form']) : [];
        }

        return $context;
    }
}