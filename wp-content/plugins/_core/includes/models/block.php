<?php

namespace _core\models\block;

use _core\helpers\field;
use function _core\helpers\utils\merge;
use function Functional\map;

function spacing( $blocks ) {
	return map(
    $blocks,
    function ( $block ) {

      return merge(
        $block,
        [
          'fields' => merge(
            $block['fields'],
            [
              field\accordion([
                'label' => 'Spacing',
                'slug' => 'spacing_tab'
              ]),
              field\group([
                'label' => 'Desktop',
                'slug' => 'desktop_spacing',
                'sub_fields' => [
                  field\range([
                    'label' => 'Top',
                    'slug' => 'top',
                    'min' => -17,
                    'max' => 17,
                    'step' => 1,
                    'default_value' => 0,
                  ]),
                  field\range([
                    'label' => 'Bottom',
                    'slug' => 'bottom',
                    'min' => -17,
                    'max' => 17,
                    'step' => 1,
                    'default_value' => 0,
                  ]),
                ]
              ]),
              field\group([
                'label' => 'Mobile',
                'slug' => 'mobile_spacing',
                'sub_fields' => [
                  field\range([
                    'label' => 'Top',
                    'slug' => 'top',
                    'min' => -17,
                    'max' => 17,
                    'step' => 1,
                    'default_value' => 0,
                  ]),
                  field\range([
                    'label' => 'Bottom',
                    'slug' => 'bottom',
                    'min' => -17,
                    'max' => 17,
                    'step' => 1,
                    'default_value' => 0,
                  ]),
                ]
              ]),
            ]
          )
        ]
      );
    }
  );
}
