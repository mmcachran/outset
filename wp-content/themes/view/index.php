<?php
the_post();
$landing_page = pyxl_check_for_landing_page( get_the_ID() );
if ( $landing_page ) {
	$cookie = $_COOKIE[ 'form_submitted_' . $landing_page->ID ];
	if ( $cookie != parse_url( get_permalink( get_the_ID() ), PHP_URL_PATH ) ) {
		wp_redirect( get_permalink( $landing_page->ID ) );
		die();
	}
}
?>
<?php get_header(); ?>

<?php
get_footer();
