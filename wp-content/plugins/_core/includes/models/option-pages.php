<?php

namespace _core\models\option_pages;

use function _core\helpers\utils\push;

function global_options( $args = [] ) {
	return push(
		$args,
		[
			'name' => 'Global',
			'slug' => 'global_options',
		]
	);
}
