<?php
get_header();
do_action( '_view/archive/post-type/default', apply_filters( '_view/archive/post-type/default/data', [] ) );
get_footer();
