<?php

namespace _core\actions\debug;

function utils() {
	add_action(
		'get_footer',
		function() {
			global $template;
			ob_start();
			?>
		<span class="debug-template">
			<strong><?php echo esc_html( basename( $template ) ); ?></strong>
			<br>
			<code>
			<?php
			// phpcs:disable WordPress.PHP.DevelopmentFunctions.error_log_var_dump
			var_dump( get_queried_object() );
			?>
			</code>
		</span>
			<?php
			print( wp_kses_post( ob_get_clean() ) );
		}
	);
	flush_rewrite_rules( true );
}
