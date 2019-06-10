<?php

namespace Core\Utils;

use GFAPI;

class GravityForms
{
    public static function get_forms_list_for_acf_options()
    {
        if (!class_exists(GFAPI::class)) {
            return [];
        }
        $list  = [];
        $forms = GFAPI::get_forms();

        foreach ($forms as $form) {
            $list[$form['id']] = $form['title'];
        }

        return $list;
    }
}