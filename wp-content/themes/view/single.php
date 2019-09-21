<?php global $post;

$id        = $post->ID;
$post      = get_post( $id );
$post_type = $post->post_type;

$content = pyxl_get_template_content( "content/default-$post_type.php", $id );

get_header();
	pyxl_print_page_links( $content );
get_footer();
