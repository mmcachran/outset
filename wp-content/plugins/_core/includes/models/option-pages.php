<?php

namespace _core\models\option_pages;

use function _core\helpers\utils\push;

function globals( $args = [] ) {
	return push(
		$args,
		[
			'name' => 'Globals',
			'slug' => 'globals',
		]
	);
}
