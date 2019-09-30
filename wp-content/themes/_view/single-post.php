<?php
get_header();
do_action('_view/single/post', apply_filters('_view/single/post/data', []));
get_footer();