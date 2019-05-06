<?php

namespace Core\Models\Layouts;

use Core\Utils\ACF;

class RegisterLayout
{
    public static function register($new_layout)
    {
        add_filter('modules', function ($layouts) use ($new_layout) {
            $fields = ACF::slug_handler(
                $new_layout['slug'],
                ACF::conditional_logic_keys($new_layout['slug'], $new_layout['fields'])
            );

            $layouts[$new_layout['slug']] = [
                'name'       => $new_layout['slug'],
                'key'        => $new_layout['slug'],
                'label'      => $new_layout['name'],
                'display'    => 'block',
                'sub_fields' => $fields,
            ];

            return $layouts;
        });
    }
}