<?php

namespace Core\Utils;

use Core\Utils\GravityForms;
use Core\Utils\Brand;

final class Fields
{
    public $button_group;

    public $forms;

    public $group;

    public $gallery;

    public $heading;

    public $link;

    public $image;

    public $message;

    public $number;

    public $post_object;

    public $range;

    public $repeater;

    public $slider;

    public $select;

    public $subheading;

    public $tab;

    public $text;

    public $video;

    public $wysiwyg;

    public $content;

    public $width;

    public $opacity;

    public $tab_general;

    public $tab_advanced;

    public $color;

    public $tags;

    public $categories;

    public function __construct()
    {
        $this->heading = [
            'label' => __('Heading', 'core'),
            'slug'  => 'heading',
            'type'  => 'text',
        ];

        $this->subheading = [
            'label' => __('Subheading', 'core'),
            'slug'  => 'subheading',
            'type'  => 'text',
        ];

        $this->select = [
            'label'   => __('Select', 'core'),
            'slug'    => 'select',
            'type'    => 'select',
            'choices' => [],
        ];

        $this->message = [
            'label'   => __('Select', 'core'),
            'slug'    => 'select',
            'type'    => 'select',
            'choices' => [],
        ];

        $this->gallery = [
            'label'   => 'Images',
            'slug'    => 'images',
            'type'    => 'gallery',
            'insert'  => 'append',
            'library' => 'all',
        ];

        $this->wysiwyg = [
            'label'        => __('WYSIWYG', 'core'),
            'slug'         => 'wysiwyg',
            'type'         => 'wysiwyg',
            'toolbar'      => 'basic',
            'media_upload' => 0,
            'delay'        => 1,
        ];

        $this->tab = [
            'label'     => __('Tab', 'core'),
            'slug'      => 'tab',
            'type'      => 'tab',
            'placement' => 'left',
        ];

        $this->number = [
            'label' => __('Number', 'core'),
            'slug'  => 'number',
            'type'  => 'number',
        ];

        $this->button_group = [
            'label'   => __('Choices', 'core'),
            'slug'    => 'choices',
            'type'    => 'button_group',
            'choices' => [],
            'wrapper' => [
                'width' => '50%',
            ],
        ];

        $this->group = [
            'label'      => __('Group', 'core'),
            'slug'       => 'group',
            'type'       => 'group',
            'sub_fields' => [],
        ];

        $this->text = [
            'label' => __('Text', 'core'),
            'slug'  => 'text',
            'type'  => 'text',
        ];

        $this->link = [
            'label' => __('Link', 'core'),
            'slug'  => 'link',
            'type'  => 'link',
        ];

        $this->image = [
            'label'        => __('Image', 'core'),
            'slug'         => 'image',
            'type'         => 'image',
            'preview_size' => 'medium',
        ];

        $this->post_object = [
            'label'     => __('Post', 'core'),
            'slug'      => 'post',
            'type'      => 'post_object',
            'post_type' => [
                'post',
            ],
        ];

        $this->range = [
            'label'         => __('Range', 'core'),
            'slug'          => 'range',
            'type'          => 'range',
            'instructions'  => '',
            'wrapper'       => [
                'width' => '50%',
            ],
            'default_value' => 70,
            'min'           => '',
            'max'           => '',
            'step'          => 10,
        ];

        $this->video = [
            'label' => __('Video (oEmbed)', 'core'),
            'slug'  => 'video',
            'type'  => 'oembed',
        ];

        $this->repeater = [
            'label'        => __('Items', 'core'),
            'slug'         => 'blurbs',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => __('Add Blurb', 'core'),
            'sub_fields'   => [],
        ];

        $this->forms = [
            'label'   => __('Form', 'core'),
            'slug'    => 'form',
            'type'    => 'select',
            'choices' => GravityForms::get_forms_list_for_acf_options(),
        ];

        $this->slider = [
            'label'        => __('Slides', 'core'),
            'slug'         => 'slides',
            'type'         => 'repeater',
            'layout'       => 'row',
            'button_label' => 'Add Slide',
            'sub_fields'   => [
                $this->image,
                $this->heading,
                $this->content,
                $this->link,
            ],
        ];

        $this->content = [
            'label'        => __('Content', 'core'),
            'slug'         => 'content',
            'type'         => 'wysiwyg',
            'toolbar'      => 'basic',
            'media_upload' => 0,
            'delay'        => 1,
        ];

        $this->width = [
            'label'         => __('Width', 'core'),
            'slug'          => 'width',
            'choices'       => [
                'width--full'   => 'Full',
                'width--wide'   => 'Wide',
                'width--normal' => 'Normal',
            ],
            'default_value' => 'wide',
        ];

        $this->opacity = [
            'label'         => __('Opacity', 'core'),
            'slug'          => 'opacity',
            'type'          => 'range',
            'default_value' => 70,
            'step'          => 1,
        ];

        $this->tab_general = [
            'label'     => __('General', 'core'),
            'slug'      => 'general',
            'type'      => 'tab',
            'placement' => 'left',
        ];

        $this->tab_advanced = [
            'label'     => __('Advanced', 'core'),
            'slug'      => 'advanced',
            'type'      => 'tab',
            'placement' => 'left',
        ];

        $this->color = [
            'label'         => __('Color', 'core'),
            'slug'          => 'color',
            'type'          => 'swatch',
            'allow_null'    => 1,
            'choices'       => Brand::COLORS,
            'default_value' => 'transparent',
            'layout'        => 'horizontal',
        ];

        $this->tags = [
            'slug'          => 'tags',
            'label'         => 'Tags',
            'type'          => 'taxonomy',
            'taxonomy'      => 'post_tag',
            'field_type'    => 'multi_select',
            'allow_null'    => 1,
            'add_term'      => 0,
            'return_format' => 'object',
            'multiple'      => 0,
        ];

        $this->categories = [
            'slug'          => 'categories',
            'label'         => 'Categories',
            'type'          => 'taxonomy',
            'taxonomy'      => 'category',
            'field_type'    => 'multi_select',
            'allow_null'    => 1,
            'add_term'      => 0,
            'return_format' => 'object',
            'multiple'      => 0,
        ];
    }

    /**
     * @param $field_name
     * @param array $override
     * @return array
     */
    public function add($field_name, $override = [])
    {
        return array_merge($this->{$field_name}, $override);
    }
}