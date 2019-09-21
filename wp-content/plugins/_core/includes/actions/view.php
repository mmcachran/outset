<?php

namespace _core\hooks\View;

use function _core\helpers\utils\merge;
use function _core\query\get_offices;
use function _core\query\get_post;
use function _core\helpers\template\render;

function archive() {
	render(
		'views/archive/post',
		merge(
			get_offices(),
			get_post()
		)
	);
}

function singular() {
	render(
		'views/archive/post',
		merge(
			get_offices(),
			get_post()
		)
	);
}




