<?php

namespace Core\Controllers\PageTemplates;

use Core\Utils\ACF;
use Core\Models\PageTemplates\Modules as PageTemplate;

class Modules
{
    public static function init()
    {
        $class = new self;
        add_filter('timber/context', [$class, 'add_to_context']);
    }

    public function add_to_context($context)
    {
        $template = get_page_template_slug();

        if (!is_page() || PageTemplate::SLUG !== $template) {
            return;
        }

        $context['template'] = $template;
        $context['modules']  = $this->set_acf_layout_filters(get_field('modules'));
        return $context;
    }

    public function set_acf_layout_filters($layout_modules)
    {
        $layouts = [];

        if (is_array($layout_modules)) {
            foreach ($layout_modules as $module) {

                $layout = $module['acf_fc_layout'];
                $hook   = "Layouts/{$layout}";

                unset($module['acf_fc_layout']);

                $layouts[] = apply_filters(
                    $hook,
                    array_merge(
                        [
                            'hook'   => $hook,
                            'layout' => $layout,
                        ],
                        $module
                    )
                );
            }
        }

        return $layouts;
    }
}