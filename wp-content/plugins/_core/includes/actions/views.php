<?php

namespace _core\actions\views;

use Timber\Menu;
use function _core\helpers\utils\merge;
use function _core\helpers\query\post;
use function _core\helpers\template\render;

function head() {
	render('globals/head', [
		'charset' => get_bloginfo('charset')
	]);
}

function header() {
	printf('<body class="%s">', join(get_body_class(), ' '));
	printf('<div id="wrapper" class="%s">', join(apply_filters('view/wrapper/classes', [])));
	printf('<main class="%s">', join(apply_filters('view/main/classes', [])));
	render('globals/header', [
		'menus' => [
			'primary' => (array) new Menu('primary'),
		]
	]);
}

function footer() {
	render('globals/footer', apply_filters('_view/globals/footer/data', []));
	printf('</div><!-- #wrapper -->');
	printf('</main><!-- main -->');
	printf('</div><!-- body -->');
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
	render('singles/default', merge(post(get_the_ID())));
}
