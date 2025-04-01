<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php
						the_title( '<h1 class="entry-title">', '</h1>' );

						if ( 'post' === get_post_type() ) :
							?>
							<div class="entry-meta">
								<?php
								analytics_incite_posted_on();
								analytics_incite_posted_by();
								?>
							</div><!-- .entry-meta -->
						<?php endif; ?>
					</header><!-- .entry-header -->

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="featured-image">
							<?php the_post_thumbnail('large'); ?>
						</div>
					<?php endif; ?>

					<div class="entry-content">
						<?php
						the_content(
							wp_kses_post(
								sprintf(
									/* translators: %s: Name of current post. */
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'analytics-incite-modern' ),
									get_the_title()
								)
							)
						);

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'analytics-incite-modern' ),
								'after'  => '</div>',
							)
						);
						?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php analytics_incite_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php
				// Post navigation
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'analytics-incite-modern' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'analytics-incite-modern' ) . '</span> <span class="nav-title">%title</span>',
					)
				);

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
