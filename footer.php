<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Leksikon
 */

?>
<?php if (! is_page_template('page--frontpage.php') ) { ?>
		</div><!-- .site-content__inner -->
<?php } ?>
	</div><!-- #content -->
	
	<div class="footer-illustrations">
		<i class="cloud x1"></i>
		<i class="cloud x2"></i>
		<i class="cloud x3"></i>
		<i class="cloud x4"></i>
		<i class="cloud x5"></i>
		<i class="balloon"></i>
	</div>
	
	<section class="fat-footer">
		<div class="fat-footer__inner">
			<?php get_sidebar('fatfooter_1col'); ?>
			<?php get_sidebar('fatfooter_2col'); ?>
			<?php get_sidebar('fatfooter_3col'); ?>
			<?php get_sidebar('fatfooter_4col'); ?>
		</div>
		
		<i class="boat"></i>
	</section>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-footer__inner">
			<div class="site-branding">
<?php if ( get_theme_mod( 'leksikon_logo' ) ) : ?>
				<div class="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php 
						// http://kwight.ca/2012/12/02/adding-a-logo-uploader-to-your-wordpress-site-with-the-theme-customizer/
						echo esc_url( get_theme_mod( 'leksikon_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
				</div>
<?php else : ?>
				<hgroup>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
<?php endif; ?>
			</div><!-- .site-branding -->
			<div class="site-info">
				<p><?php echo __( 'Made with', 'leksikon' ); ?> 
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'leksikon' ) ); ?>"><?php printf( esc_html__( '%s', 'leksikon' ), 'WordPress' ); ?></a>
				<?php echo __( 'and', 'leksikon' ); ?> <span title="<?php echo __( 'a lot of love', 'leksikon' ); ?>"><i class="material-icons md-20" aria-hidden="true">favorite</i></span> <?php echo __( 'by', 'leksikon' ); ?>
				<?php printf( esc_html__( '%1$s', 'leksikon' ), '<a href="http://bechster.dk/" rel="designer">Bechster</a>' ); ?></p>
			</div><!-- .site-info -->
		</div><!-- .footer__inner -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
