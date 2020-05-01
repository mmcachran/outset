<?php

namespace _core\models\option_pages;

use function _core\helpers\utils\push;

function general( $args = [] ) {
	return push(
		$args,
		[
			'name' => 'General',
			'slug' => 'general',
		]
	);
}
