<?php
get_header();
do_action( '_view/search', apply_filters( '_view/search/data', [] ) );
get_footer();
