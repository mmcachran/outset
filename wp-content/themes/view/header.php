<?php

use function pyxl\view\util\include_svg;
?>
<?php get_header( 'head' ); ?>
<div id="wrapper">
	<div class="loading"></div>
	<div class="logo">
		<a href="<?php echo esc_url( get_home_url() ); ?>" class="logo__link">
			<?php // include_svg( 'logo' ); ?>
		</a>
	</div>
	<header class="navbar">
		<div class="row expanded">
			<div class="top-menu">
				<div class="nav-holder">
					<button id="" class="nav-toggle"></button>
					<nav class="nav">
						<div class="nav-container">
							<?php
							wp_nav_menu(
								array(
									'menu'      => 'main-nav',
									'container' => false,
								)
							);
							get_search_form();
							?>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<main id="stage" role="main">
