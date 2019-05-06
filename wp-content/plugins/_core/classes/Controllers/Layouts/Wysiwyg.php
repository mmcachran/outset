<?php
/**
 * Pyxl Layout Controller: WYSIWYG
 *
 * Prepares fields for use in the WYSIWYG Module.
 *
 * @package    Core\
 * @subpackage ACF
 * @since      1.0.0
 */

namespace Core\Controllers\Layouts;

/**
 * WYSIWYG Controller
 *
 * Prepares fields for use in the WYSIWYG Module.
 *
 * @package    Core\
 * @subpackage ACF
 * @since      1.0.0
 */
class Wysiwyg {

	/**
	 * Init
	 *
	 * Initializes the singleton instance and adds the Wordpress hook.
	 *
	 * @since 1.0.0
	 *
	 */
	public static function init() {
		$class = new self;
		add_filter( 'layouts/modules/wysiwyg', [ $class, 'filter' ] );
	}

	/**
	 * Filter
	 *
	 * Prepares the fields for use in module template.
	 *
	 * @since 1.0.0
	 *
	 */
	public function filter( $context ) {
		$context['id'] = strtolower( preg_replace( "/[^a-zA-Z0-9]/", "", 'wysiwyg' ) );

		return $context;
	}
}