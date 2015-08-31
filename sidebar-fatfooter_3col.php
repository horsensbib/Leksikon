<?php
/**
 * The sidebar containing the 3rd column in the fat footer widget area.
 *
 * @package Leksikon
 */

if ( ! is_active_sidebar( 'fatfooter_thirdcol' ) ) {
	return;
}
?>

<div id="fatfooter-third" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'fatfooter_thirdcol' ); ?>
</div><!-- #secondary -->
