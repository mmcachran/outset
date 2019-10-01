<?php
get_header();
do_action( '_view/archive/post_type/default', apply_filters( '_view/archive/post_type/default/data', [] ) );
get_footer();
