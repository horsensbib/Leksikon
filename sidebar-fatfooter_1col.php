<?php
/**
 * The sidebar containing the 1st column in the fat footer widget area.
 *
 * @package Leksikon
 */

if ( ! is_active_sidebar( 'fatfooter_firstcol' ) ) {
	return;
}
?>

<div id="fatfooter-first" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'fatfooter_firstcol' ); ?>
</div><!-- #secondary -->
