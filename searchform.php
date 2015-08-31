<?php 
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 

if ( is_plugin_active( 'wp-google-search/wp-google-search.php' ) ) {
 echo do_shortcode('[wp_google_searchbox]');
} else { ?>

<form role="search" method="get" class="search-form" action="<?php get_site_url(); ?>">
	<label>
		<span class="screen-reader-text"><?php _e('Search for:','leksikon'); ?></span>
		<input type="search" class="search-field" placeholder="<?php _e('Search &hellip;','leksikon'); ?>" value="" name="s" title="<?php _e('Search for:','leksikon'); ?>" />
	</label>
	<input type="submit" class="search-submit" value="<?php _e('Search','leksikon'); ?>" />
</form>

<?php } ?>