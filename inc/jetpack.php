<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Leksikon
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function leksikon_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'leksikon_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function leksikon_jetpack_setup
add_action( 'after_setup_theme', 'leksikon_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function leksikon_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function leksikon_infinite_scroll_render

/**
	* Add Support for Photon
	*/
if( function_exists( 'jetpack_photon_url' ) ) {
	add_filter( 'jetpack_photon_url', 'jetpack_photon_url', 10, 3 );
}