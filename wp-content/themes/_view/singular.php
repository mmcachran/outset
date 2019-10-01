<?php
get_header();
do_action( '_view/singular/default', apply_filters( '_view/singular/default/data', [] ) );
get_footer();
