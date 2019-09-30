<?php

namespace _core\helpers\utils;

function push( $original_array, ...$additional_arrays ) {
	foreach ( $additional_arrays as $additional_array ) {
		$original_array[] = $additional_array;
	}

	return $original_array;
}


function merge( ...$params ) {
	return array_merge( ...$params );
}

function has_key( $key, $data ) {
	if ( is_array( $data ) ) {
		return array_key_exists( $key, $data );
	}
	if ( is_object( $data ) ) {
		return property_exists( $data, $key );
	}
}

function underscores_to_dashes($string = '') {
	return str_replace('_', '-', $string);
}