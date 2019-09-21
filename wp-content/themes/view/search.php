<?php

get_header();

$search_term = get_search_query(); ?>

	<header class="search-header row">
		<div class="column">
			<h1><?php echo __( "Top results for '{$search_term}'" ); ?></h1>
		</div>
	</header>

	<div class="search-results">
		<div class="row">
			<?php if ( have_posts() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<section class="post-article column small-12 medium-10 large-8 large-offset-1">
						<a href="<?php the_permalink(); ?>">
							<?php
							$terms = [];
							foreach ( get_the_terms( get_the_ID(), 'topic' ) as $term ) {
								$terms[] = $term->name;
							}
							?>
							<h6><?php echo implode( ', ', $terms ); ?></h6>
							<h2><?php the_title(); ?></h2>
							<div class="post-meta">
								<span class="meta-posted">Posted <?php the_date(); ?> by <?php echo get_the_author(); ?></span>
							</div>
							<p><?php the_excerpt(); ?></p>
						</a>
					</section>
				<?php endwhile; ?>
			<?php else : ?>
				<div class="column small-12 search-no-results">
					<p>No results found.</p>
					<h3>Please try another search:</h3>
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
		the_posts_pagination(
			[
				'screen_reader_text' => ' ',
				'mid_size'           => 3,
				'prev_text'          => '<span class="pyxl-large-arrow-left"></span>',
				'next_text'          => '<span class="pyxl-large-arrow"></span>',
			]
		);
		?>
	</div>

<?php
get_footer();
