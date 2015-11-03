<?php
/**
 * Leksikon functions and definitions
 *
 * @package Leksikon
 */

if ( ! function_exists( 'leksikon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function leksikon_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Leksikon, use a find and replace
	 * to change 'leksikon' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'leksikon', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'thumb', 80, 80, true );
	add_image_size( 'thumb-2x', 160, 160, true );
	add_image_size( 'card', 260, 130, true );
	add_image_size( 'card-2x', 520, 260, true );
	add_image_size( 'square', 300, 300, true );
	add_image_size( 'half-width', 600, 400, true );
	add_image_size( 'full-width', 1200, 800, true );
	add_image_size( 'featured-small', 1920, 540, true );
	add_image_size( 'featured-large', 1920, 740, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'leksikon' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
/*	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) ); */

	// Set up the WordPress core custom background feature.
	/* 
	add_theme_support( 'custom-background', apply_filters( 'leksikon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	*/
}
endif; // leksikon_setup
add_action( 'after_setup_theme', 'leksikon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function leksikon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'leksikon_content_width', 640 );
}
add_action( 'after_setup_theme', 'leksikon_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function leksikon_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'leksikon' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Fat Footer - 1st column', 'leksikon' ),
		'id'            => 'fatfooter_firstcol',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Fat Footer - 2nd column', 'leksikon' ),
		'id'            => 'fatfooter_secondcol',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Fat Footer - 3rd column', 'leksikon' ),
		'id'            => 'fatfooter_thirdcol',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Fat Footer - 4th column', 'leksikon' ),
		'id'            => 'fatfooter_fourthcol',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'leksikon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function leksikon_scripts() {
	wp_enqueue_style( 'leksikon-style', get_stylesheet_uri() );
	// wp_enqueue_style( 'slick', get_template_directory_uri() . '/js/slick/slick.css );

	wp_enqueue_script( 'leksikon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'leksikon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick/slick.min.js', array( 'jquery' ), '20150708', true );
	
	// wp_enqueue_script( 'tableofcontents', get_template_directory_uri() . '/js/jquery.tableofcontents.min.js', array( 'jquery' ), '20150810', true );
	
	wp_enqueue_script( 'leksikon-custom', get_template_directory_uri() . '/js/leksikon.js', array( 'jquery' ), '20150702', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'leksikon_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * TinyMCE Extensions.
 */
require get_template_directory() . '/inc/leksikon__function--tinymce-ext.php';

/**
 * Shortcode for displaying the number of published posts
 */
function leksikon_PostCount_shortcode() {
	$count_posts = wp_count_posts('post');
	$published_posts = $count_posts->publish;
	return $published_posts;
}
add_shortcode( 'antal', 'leksikon_PostCount_shortcode' );

/**
 * Add Excerpt Metabox to Pages
 * http://wpquicktips.wordpress.com/2010/05/05/add-the-excerpt-meta-box-to-edit-page/
 */
function bibliozine_pageexcerpt() {
	add_meta_box('postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'page', 'normal', 'core');
}
add_action( 'admin_menu', 'bibliozine_pageexcerpt' );

/**
 * Add itemprop attribute to comments_popup_link
 */
function add_itemprop_to_comments_popup_link(){
	return ' itemprop="discussionUrl" ';}
add_filter( 'comments_popup_link_attributes', 'add_itemprop_to_comments_popup_link' );

/**
 * Limit the number of words in excerpts
 */
function string_limit_words($string, $word_limit)
{
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}
	
/**
* Get the image for posts with no thumbnails
*/
function get_img($size) {
	$attachments = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order'));
	if ( ! is_array($attachments) ) continue;
	$count = count($attachments);
	$first_attachment = array_shift($attachments);
	echo wp_get_attachment_image($first_attachment->ID, $size);
}

/**
 * Adds custom styles to the visual editor
 *
 */
function leksikon_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'leksikon_add_editor_styles' );

/**
* Add a search form to the primary menu
* http://www.wpbeginner.com/wp-themes/how-to-add-custom-items-to-specific-wordpress-menus/
*/
add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
	if( $args->theme_location == 'primary' ) {
		return $items.'<li class="menu-header-search">' . get_search_form( $echo ) . '</li>';
		return $items;
	}
}

/**
 * Deactivate WP Google Search CSS
 */
function remove_unwanted_css(){
	wp_dequeue_style('wgs');
}
add_action('wp_enqueue_scripts','remove_unwanted_css', 100);

 
/* 
 * Add Breadcrumbs
 * Required Plugin: Breadcrumb NavXT
 */
function breadcrumbs() {
	if ( function_exists('bcn_display') && !( is_page_template( 'page--frontpage.php' ) ) ) {	?>
	<div class="breadcrumbs" itemprop="breadcrumb"><p><?php bcn_display(); ?></p></div> <!-- /Bread Crumbs -->	
<?php }
}
add_action('before_main', 'breadcrumbs');


/*===================================================================================
 * Add Author Links
 * =================================================================================*/
function add_to_author_profile( $contactmethods ) {
	
	$contactmethods['rss_url'] = __('RSS URL','leksikon');
	$contactmethods['google_profile'] = __('Google Profile URL','leksikon');
	$contactmethods['twitter_profile'] = __('Twitter Profile URL','leksikon');
	$contactmethods['facebook_profile'] = __('Facebook Profile URL','leksikon');
	$contactmethods['linkedin_profile'] = __('Linkedin Profile URL','leksikon');
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);

/**
 * Tag Cloud: Change font sizes
 */
add_filter('widget_tag_cloud_args','set_tag_cloud_sizes');
function set_tag_cloud_sizes($args) {
$args['smallest'] = 9;
$args['largest'] = 9;
return $args; }

/**
 * Add Custom Logo to the Login Form
 */
function custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url(' . get_template_directory_uri() . '/img/logo.png) !important; width:100% !important;background-size:contain!important;background-position: center!important;}
    </style>';
}

add_action('login_head', 'custom_login_logo');

function my_login_logo_url() {
	return get_bloginfo( 'http://horsensleksikon.dk/' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
	return 'Horsens Leksikon';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// Remove Jetpack from Contributors
function hide_jetpack_from_others() {
	if ( ! current_user_can( 'publish_posts' ) ) {
		remove_menu_page( 'jetpack' );
	}
}
add_action( 'jetpack_admin_menu', 'hide_jetpack_from_others' );
function load_admin_style() {
	if ( ! current_user_can( 'edit_others_posts' ) ) {
		wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/admin-style.css', false, '1.0.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'load_admin_style' );

/* 
 * info: http://simplemediacode.info/snippets/itemprop-attributes-for-wordpress-serp-results/
 * as WordPress plugin http://wordpress.org/extend/plugins/itempropwp/
 */
add_filter('post_thumbnail_html','leksikon_image_itemprop',10,3 );
function leksikon_image_itemprop($html, $post_id, $post_image_id){
 $html = str_replace('src',' itemprop="image" src',$html);
 return $html;
}

/*
 * Remove hash-character in hashtags from front end.
 */
/* include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'hashtagger/hashtagger.php' ) ) {
	function remove_hash_character($content) {
		$content = str_replace('#', '',$content);
		return $content;
	}
	add_filter('the_content','remove_hash_character');
} */
?>