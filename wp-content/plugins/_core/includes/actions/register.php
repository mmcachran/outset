<?php

namespace _core\actions\register;

use _core\helpers\wp;
use _core\helpers\acf;
use function Functional\each;

function post_types() {
	each(
		apply_filters( '_core/post_types', [] ),
		function ( $args ) {
			wp\post_type\create( $args );
		}
	);
}

function taxonomies() {
	each(
		apply_filters( '_core/taxonomies', [] ),
		function ( $args ) {
			wp\taxonomy\create( $args );
		}
	);
}

function blocks() {
	return each(
		apply_filters( '_core/blocks', [] ),
		function ( $args ) {
			acf\block\create( $args );
		}
	);
}

function field_groups() {
	return each(
		apply_filters( '_core/field_groups', [] ),
		function ( $args ) {
			register_field_group( $args );
		}
	);
}

function option_pages() {
	each(
		apply_filters( '_core/option_pages', [] ),
		function ( $args ) {
			acf_add_options_page( $args );
		}
	);
}
