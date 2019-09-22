<?php

namespace _core\actions\views;

use function _core\helpers\utils\merge;
use function _core\query\get_offices;
use function _core\query;
use function _core\helpers\template\render;

function head() {
	render('_view/head', []);
}

function header() {
	render('_view/header', []);
}

function footer() {
	render('_view/footer', []);
}

function archive() {
	render(
		'_view/archive/post',
		merge(
			get_post()
		)
	);
}

function single() {
	render('_view/single', query\post());
}
