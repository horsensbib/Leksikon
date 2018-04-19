<?php
/**
 * Template part for displaying single posts.
 *
 * @package Leksikon
 */

?>

<?php
	$header_image_width = 1200;
	if ( is_singular() && has_post_thumbnail( $post->ID ) && (/* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) && $image[1] >= $header_image_width) {
		echo get_the_post_thumbnail( $post->ID, 'featured-small' );
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="https://schema.org/Article">
	<header class="entry-header">
		<?php 
			edit_post_link( esc_html__( 'Edit', 'leksikon' ), '<span class="edit-link">', '</span>' );
			the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links" itemprop="pagination">' . esc_html__( 'Pages:', 'leksikon' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php leksikon_entry_footer(); ?>
		</div><!-- .entry-meta -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

