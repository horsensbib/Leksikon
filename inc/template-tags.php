<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Leksikon
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'leksikon' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'leksikon' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'leksikon' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'leksikon' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'leksikon_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function leksikon_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="dateCreated datePublished">%2$s</time>';
	/* if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
	} */

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'leksikon' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="dateCreated datePublished">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . __('Posted on', 'leksikon') . ' <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span> ';
	echo '<span class="updated-on">' . __('Updated on', 'leksikon') . ' <time class="updated" datetime="' . get_the_modified_date( 'c' ) . '" itemprop="lastReviewed dateModified">' . get_the_modified_date() . '</time></span>';

}
endif;

if ( ! function_exists( 'leksikon_posted_by' ) ) :
/**
 * Prints HTML with meta information for the author.
 */
function leksikon_posted_by() {
	
	$byline = sprintf(
		'<strong class="author vcard" itemprop="editor author creator"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></strong>'
	);

	echo '<p class="byline">' . __( 'Posted by ' , 'leksikon' ) . $byline . '</p>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'leksikon_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function leksikon_entry_footer() {
	// Hide category and tag text for pages.	
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'leksikon' ) );
		if ( $tags_list ) {
			printf( '<div class="tags-links" itemprop="keywords">' . esc_html__( '%1$s', 'leksikon' ) . '</div>', $tags_list ); // WPCS: XSS OK.
		}
	}
	
	echo '<hr />';
	$avatar = get_avatar( get_the_author_meta('email') , 90 );
	printf( $avatar ); 
	
	leksikon_posted_by();
	
	$author_description = get_the_author_meta('description');
	if ( $author_description ) {
		printf( '<p class="author-description bio">' . $author_description . '</p>' ); // WPCS: XSS OK.
	}
	
	echo '<p class="posted">';
	if ( 'post' == get_post_type() ) {	
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'leksikon' ) );
		if ( $categories_list && leksikon_categorized_blog() ) {
			printf( '<span class="cat-links" itemprop="keywords">' . esc_html__( 'Posted in %1$s', 'leksikon' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}	
	} else {
		echo __('Posted' , 'lekikon');
	}
	
	echo '<span class="posted-on"> <time class="updated" datetime="' . get_the_date( 'c' ) . '" itemprop="dateCreated datePublished">' . get_the_date() . '</time></span>'; // WPCS: XSS OK.
	echo '<span class="separator"> - </span>';
	echo '<span class="updated-on">' . __( 'Updated on ', 'leksikon' ) . '<time class="updated" datetime="' . get_the_modified_date( 'c' ) . '" itemprop="lastReviewed dateModified">' . get_the_modified_date() . '</time></span>';
	echo '</p>';

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'leksikon' ), esc_html__( '1 Comment', 'leksikon' ), esc_html__( '% Comments', 'leksikon' ) );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'leksikon' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Subject: %s', 'leksikon' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'leksikon' ), '<span class="vcard">' . get_the_author() );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'leksikon' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'leksikon' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'leksikon' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'leksikon' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'leksikon' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'leksikon' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'leksikon' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'leksikon' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'leksikon' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'leksikon' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'leksikon' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'leksikon' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'leksikon' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'leksikon' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'leksikon' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'leksikon' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'leksikon' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'leksikon' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;  // WPCS: XSS OK.
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function leksikon_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'leksikon_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'leksikon_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so leksikon_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so leksikon_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in leksikon_categorized_blog.
 */
function leksikon_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'leksikon_categories' );
}
add_action( 'edit_category', 'leksikon_category_transient_flusher' );
add_action( 'save_post',     'leksikon_category_transient_flusher' );



if ( ! function_exists( 'leksikon_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Leksikon 1.0
 */
function leksikon_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'leksikon' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'leksikon' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment" itemscope="" itemtype="http://schema.org/Comment">
			<span class="author-img"><?php
				$avatar_size = 80;
				if ( '0' != $comment->comment_parent )
				$avatar_size = 50;
				echo get_avatar( $comment, $avatar_size );
			?></span>
			<div class="comment-content" itemprop="comment">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p><em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting approval', 'leksikon' ); ?></em></p>
				<?php endif; ?>
				<?php comment_text(); ?>
				<?php edit_comment_link( esc_html__( 'Edit', 'leksikon' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
			<footer class="comment-meta">
				<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'leksikon' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<div class="comment-author vcard">
					<?php
						/* translators: 1: comment author, 2: date and time */
						printf( __( '<span class="says">From</span> %1$s <span class="when">Date</span> %2$s:', 'leksikon' ),
							sprintf( '<span class="fn" itemprop="author creator">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s" itemprop="dateCreated datePublished">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'leksikon' ), get_comment_date(), get_comment_time() )
							)
						);
					?>	
				</div><!-- .comment-author .vcard -->
			</footer>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for leksikon_comment()
