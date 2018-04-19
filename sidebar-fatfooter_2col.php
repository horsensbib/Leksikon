<?php
/**
 * The sidebar containing the 2nd column in the fat footer widget area.
 *
 * @package Leksikon
 */

if ( ! is_active_sidebar( 'fatfooter_secondcol' ) ) {
	return;
}
?>

<div id="fatfooter-second" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'fatfooter_secondcol' ); ?>
</div><!-- #secondary -->
