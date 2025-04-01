<?php
/**
 * The main template file
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="card-image-link">
								<?php the_post_thumbnail( 'large', array( 'class' => 'card-image' ) ); ?>
							</a>
						<?php endif; ?>
						
						<div class="card-content">
							<header class="entry-header">
								<?php
								the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

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

							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div><!-- .entry-content -->

							<footer class="entry-footer">
								<a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e('Read More', 'analytics-incite-modern'); ?></a>
							</footer>
						</div>
					</article><!-- #post-<?php the_ID(); ?> -->
					<?php

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
