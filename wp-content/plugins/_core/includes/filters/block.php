<?php

namespace _core\filters\block;

use function _core\helpers\utils\has_key;
use function _core\helpers\utils\merge;

function spacing( $block ) {
  $spacing_options = ['0', '1', '2', '3', '4', '5', '6', '8', '10', '12', '16', '20', '24', '32', '40', '48', '56', '64'];
  $classes = array_key_exists('classes', $block) ? $block['classes'] : '';
  $desktop_spacing = get_field('desktop_spacing');
  $mobile_spacing = get_field('mobile_spacing');

  $desktop_top = array_key_exists('top', $desktop_spacing) ? intval($desktop_spacing['top']) : 0;
  $desktop_bottom = array_key_exists('bottom', $desktop_spacing) ? intval($desktop_spacing['bottom']) : 0;
  $mobile_top = array_key_exists('top', $mobile_spacing) ? intval($mobile_spacing['top']) : 0;
  $mobile_bottom = array_key_exists('bottom', $mobile_spacing) ? intval($mobile_spacing['bottom']) : 0;
  $mobile_top_class = $mobile_top >= 0 ? "pt-{$spacing_options[abs($mobile_top)]}" : "-mt-{$spacing_options[abs($mobile_top)]}";
  $mobile_bottom_class = $mobile_bottom >= 0 ? "pb-{$spacing_options[abs($mobile_bottom)]}" : "-mb-{$spacing_options[abs($mobile_bottom)]}";
  $desktop_top_class = $desktop_top >= 0 ? "md:pt-{$spacing_options[abs($desktop_top)]}" : "md:-mt-{$spacing_options[abs($desktop_top)]}";
  $desktop_bottom_class = $desktop_bottom >= 0 ? "md:pt-{$spacing_options[abs($desktop_bottom)]}" : "md:-mt-{$spacing_options[abs($desktop_bottom)]}";

  $classes .= "${strlen($classes) ? ' ' : ''}{$mobile_top_class} {$mobile_bottom_class} {$desktop_top_class} {$desktop_bottom_class}";

	return merge(
    $block,
    [
      'classes' => $classes,
    ]
  );
}

function fields( $block ) {
	return merge(
    $block,
    [
      'meta' => get_fields()
    ]
  );
}

function general( $block ) {
  var_dump($block['classes']);

  return merge(
    $block,
    [
      'base'       => $block['slug'],
      'is_preview' => is_admin(),
      'classes'    => merge(
        $block['classes'] ? $block['classes'] : [],
        trim(
          join(
            ' ',
            [
              'custom-block',
              has_key( 'align', $block ) ? "align{$block['align']}" : null,
              has_key( 'className', $block ) ? $block['className'] : null,
            ]
          )
        )
      ),
    ]
  );
}