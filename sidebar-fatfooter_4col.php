<?php
/**
 * The sidebar containing the 4th column in the fat footer widget area.
 *
 * @package Leksikon
 */

if ( ! is_active_sidebar( 'fatfooter_fourthcol' ) ) {
	return;
}
?>

<div id="fatfooter-fourth" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'fatfooter_fourthcol' ); ?>
</div><!-- #secondary -->
