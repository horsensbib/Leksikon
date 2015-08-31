<?php
/**
 * Template Name: Full Width for Page Builder
 *
 * @package Leksikon
 */
// Make Template Name translatable
// http://stackoverflow.com/questions/13561410/how-to-translate-a-wordpress-template-name
__( 'Full Width for Page Builder', 'leksikon' );

get_header(); ?>

	<div id="primary" class="content-area content-area--full-width">
		<main id="main" class="site-main" role="main">
			<?php do_action('before_main') ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page--no-title' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
