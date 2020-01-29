<?php
/**
 * Forms Helper
 *
 * Helper functions for dealing with Ninja Forms.
 *
 * This will look for twig files in the paths provided.
 */

namespace _core\helpers\forms;

/**
 * Get Form Choices
 *
 * Helper functions for dealing with Ninja Forms.
 *
 * @return array Array of form names keyed by ID.
 */
function get_forms_choices() {
	$forms = Ninja_Forms()->form()->get_forms();

	if ( empty( $forms ) ) {
		return [];
	}

	$forms_list = [];
	foreach ( $forms as $form ) {
		$forms_list[ $form->get_id() ] = $form->get_setting( 'title' );
	}

	return $forms_list;
}

/**
 * Render Form HTML
 *
 * Renders Ninja Forms HTML for front end.
 *
 * @param int $form_id The ID of the form to render.
 *
 * @return string Form HTML.
 */
function render_form_html( $form_id ) {
	if ( ! $form_id ) {
		return '';
	}
	ob_start();
	Ninja_Forms()->display( $form_id );
	return ob_get_clean();
}
