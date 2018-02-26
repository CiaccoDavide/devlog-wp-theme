<?php
/** Prana Entry Meta Separator */
function prana_entry_meta_sep() {
	
	$output = '<span class="entry-meta-sep"> \ </span>';
	return $output;

}

/** Prana Post Sticky */
function prana_post_sticky() {
	
	$output = '';
	
	if ( is_sticky() ) { 
		$output = sprintf( '%2$s <span class="entry-meta-featured">%1$s</span>', __( 'Featured', 'prana' ), prana_entry_meta_sep() );
	}
	
	return $output;

}

/** Prana Post Format */
function prana_post_format() {
	
	$output = sprintf( '%2$s <span class="entry-meta-featured">%1$s</span>', ucfirst( get_post_format() ), prana_entry_meta_sep() );
	return $output;

}

/** Prana Post Date */
function prana_post_date() {
	
	$post_date = esc_html( get_the_date() ) . " " . esc_attr( get_the_time() );
	
	/** Output */
	$output = sprintf( '<time class="entry-date entry-time updated" datetime="%4$s"><a href="%2$s" title="%3$s" rel="bookmark">%1$s</a></time>', $post_date, esc_url( get_permalink() ), the_title_attribute( 'echo=0' ), esc_attr( get_the_time( 'c' ) ) );
	return $output;

}

/** Prana Post Author */
function prana_post_author() {
	
	$output = sprintf( '%4$s<span class="entry-author author vcard">%3$s <a href="%1$s" title="%3$s %2$s" rel="author"><span class="entry-author-name fn">%2$s</span></a></span>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ), __( 'by', 'prana' ), prana_entry_meta_sep() );
	return $output;

}

/** Prana Post Edit Link */
function prana_post_edit_link() {

	/** Manipulation */	
	ob_start();
	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) :
	edit_post_link( __( 'Edit', 'prana' ), sprintf( '%1$s<span class="edit-link">', prana_entry_meta_sep() ), '</span>' );
	else:
	edit_post_link( __( 'Edit', 'prana' ), '<span class="edit-link">', '</span>' );
	endif;
	$output = ob_get_clean();
	
	return $output;

}

/** Prana Post Comments */
function prana_post_comments() {
	
	if ( ( ! comments_open() || post_password_required() ) ) {
		return;
	}

	ob_start();
	comments_number( __( 'Leave a Comment', 'prana' ), __( '1 Comment', 'prana' ), __( '% Comments', 'prana' ) );
	$comments = ob_get_clean();
	
	/** Output */
	$comments = sprintf( '<a href="%s">%s</a>', esc_url( get_comments_link() ), $comments );
	$output = sprintf( '%2$s<span class="comments-link">%1$s</span>', $comments, prana_entry_meta_sep() );
	return $output;
}

/** Prana Post Categories */
function prana_post_category() {
	
	$categories_list = get_the_category_list( ', ' );
	if ( ! $categories_list ) {
		return;
	}
		
	$output = sprintf( '<span class="cat-links"><span class="%1$s">'. __( 'Posted in:', 'prana' ) .'</span> %2$s</span>', 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
	return $output;
}

/** Prana Post Tags */
function prana_post_tags() {
	
	$tags_list = get_the_tag_list( '', ', ' );
	if ( ! $tags_list ) {
		return;
	}
		
	$output = sprintf( '%3$s<span class="tag-links"><span class="%1$s">'. __( 'Tagged:', 'prana' ) .'</span> %2$s</span>', 'entry-utility-prep entry-utility-prep-tag-links', $tags_list, prana_entry_meta_sep() );
	return $output;
}

/** Prana Link Pages */
function prana_link_pages() {
	
	$prana_options = prana_get_settings();	
	if( is_single() || $prana_options['prana_post_style'] == 'content' ) {
	
		return wp_link_pages( array( 
			
			'before' => '<div class="page-link"><span class="assistive-text">'. __( 'Pages:', 'prana' ) .'</span>',
			'after' => '</div>',
			'link_before' => '<span>',
			'link_after' => '</span>',
			'echo' => 0
			
			)
		);
	
	}
}

/** Prana Post Style */
function prana_post_style() {
	
	$prana_options = prana_get_settings();	
	if( $prana_options['prana_post_style'] == 'excerpt' ) {	
		the_excerpt();	
	} else {		
		the_content();	
	}

}

/** Prana Featured Image */
function prana_featured_image() {
	
	$prana_options = prana_get_settings();	
	if( $prana_options['prana_featured_image_control'] == 'no' ) {
		return;
	}
	
	$img = prana_get_image( array( 'format' => 'html', 'size' => 'prana-image-featured', 'mode' => $prana_options['prana_featured_image_control'], 'attr' => array( 'class' => 'entry-featured-image' ) ) );
	if( empty( $img ) ) {		
		return;
	}
	
	printf( '<div class="entry-featured-image-wrapper"><a href="%s" title="%s">%s</a></div>', esc_url( get_permalink() ), the_title_attribute( 'echo=0' ), $img );

}

/** Prana Loop Navigation */
function prana_loop_nav() {

	global $wp_query;	
	
	if ( $wp_query->max_num_pages > 1 ) {
		
		$prana_options = prana_get_settings();
		
		if ( $prana_options['prana_nav_style'] == 'numeric' ) {		
			
			prana_loop_nav_numeric();		
		
		} else {
			
			prana_loop_nav_next_prev();		
		
		}
	
	}

}

/** Prana Loop Navigation Numeric */
function prana_loop_nav_numeric() {
	
	global $wp_query;
	$big = 999999999; // Need an unlikely integer
	$args = array(
		'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages
	);
	
?>
<div id="loop-nav-numeric" class="nav-numeric">
  <h3 class="assistive-text"><?php _e( 'Post Navigation', 'prana' ); ?></h3>
  <?php echo paginate_links( $args ); ?>
  <div class="clear"></div>
</div> <!-- end #loop-nav-numeric -->
<?php	
}

/** Prana Loop Navigation Next/Prev */
function prana_loop_nav_next_prev() {
	
	ob_start();
	next_posts_link( '<span class="meta-nav">&larr;</span> '. __( 'Older Posts', 'prana' ) );
	$next_posts_link = ob_get_clean();
	
	ob_start();
	previous_posts_link( __( 'Newer Posts', 'prana' ) .' <span class="meta-nav">&rarr;</span>' );
	$previous_posts_link = ob_get_clean();
	
	$next_posts_link = ( empty( $next_posts_link ) )? '&nbsp;' : $next_posts_link;
	$previous_posts_link = ( empty( $previous_posts_link ) )? '&nbsp;' : $previous_posts_link;	

?>
<div id="loop-nav-next-prev" class="clearfix">
  <h3 class="assistive-text"><?php _e( 'Post Navigation', 'prana' ); ?></h3>
  <div class="loop-nav-previous grid_6 alpha">
    <?php echo $next_posts_link; ?>
  </div>
  <div class="loop-nav-next grid_6 omega">
	  <?php echo $previous_posts_link; ?>
  </div>
</div> <!-- end #loop-nav-next-prev -->
<?php
}

/** Prana Loop Navigation Singular Post */
function prana_loop_nav_singular_post() {
	
	ob_start();
	previous_post_link( '%link', '<span class="meta-nav">&larr;</span> '. __( 'Previous Post', 'prana' ) );
	$previous_post_link = ob_get_clean();
	  
	ob_start();
	next_post_link( '%link', __( 'Next Post', 'prana' ) . ' <span class="meta-nav">&rarr;</span>' );
	$next_post_link = ob_get_clean();
	  
	$previous_post_link = ( empty( $previous_post_link ) )? '&nbsp;' : $previous_post_link;	
	$next_post_link = ( empty( $next_post_link ) )? '&nbsp;' : $next_post_link;

?>
<div id="loop-nav-singlular-post" class="clearfix">
  <h3 class="assistive-text"><?php _e( 'Post Navigation', 'prana' ); ?></h3>
  <div class="loop-nav-previous grid_6 alpha">
    <?php echo $previous_post_link; ?>
  </div>
  <div class="loop-nav-next grid_6 omega">
	<?php echo $next_post_link; ?>
  </div>
</div><!-- end #loop-nav-singular-post -->
<?php
}

/** Prana Loop Navigation Singular */
function prana_loop_nav_singular() {
	global $post;
?>
<div id="loop-nav-singular">
  <h3 class="assistive-text"><?php _e( 'Post Navigation', 'prana' ); ?></h3>
  <div class="loop-nav-standard"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"> <?php _e( '&larr; Return to', 'prana' ); ?> <?php echo get_the_title( $post->post_parent ); ?></a></div>
</div><!-- end #loop-nav-singular -->
<?php
}

/** Prana Loop Navigation Singular Attachment */
function prana_loop_nav_singular_attachment() {
	
	ob_start();
	previous_image_link( 'thumbnail' );
	$previous_image_link = ob_get_clean();
	  
	ob_start();
	next_image_link( 'thumbnail' );
	$next_image_link = ob_get_clean();
	  
	$previous_image_link = ( empty( $previous_image_link ) )? '&nbsp;' : '<p>' . $previous_image_link . '</p>';	
	$next_image_link = ( empty( $next_image_link ) )? '&nbsp;' : '<p>' . $next_image_link . '</p>';

?>
<div id="loop-nav-singlular-attachment" class="clearfix">
  <h3 class="assistive-text"><?php _e( 'Attachment Navigation', 'prana' ); ?></h3>
  <div class="loop-nav-previous grid_6 alpha">
    <?php echo $previous_image_link; ?>
  </div>
  <div class="loop-nav-next grid_6 omega">
	  <?php echo $next_image_link; ?>
  </div>
</div><!-- end #loop-nav-singular-attachment -->
<?php
}

/** Prana Author */
function prana_author() {
if ( get_the_author_meta( 'description' ) && is_multi_author() ) :	
?>
<div id="author-info" class="clearfix">
  
  <div id="author-avatar" class="grid_3 alpha">
    <div id="author-avatar-inside">  
	  <?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
    </div>
  </div> <!-- #author-avatar -->
  
  <div id="author-description" class="grid_9 omega">    
      <h3><?php printf( __( 'About %s', 'prana' ), get_the_author() ); ?></h3>
      <p><?php the_author_meta( 'description' ); ?></p>
      <div id="author-link">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( __( 'View all posts by %s', 'prana' ) . ' <span class="meta-nav">&rarr;</span>', get_the_author() ); ?></a>
      </div> <!-- #author-link	-->  
  </div> <!-- #author-description -->
  
</div> <!-- #author-info -->
<?php
endif;
}

/** Prana Footer */
add_action( 'prana_footer', 'prana_footer_init' );
function prana_footer_init() {
	
	/** Theme Data & Settings */
	$prana_theme_data = prana_theme_data();
	$prana_options = prana_get_settings();	
	
	/** Footer Copyright Logic */
	$prana_copyright_code = '&copy; Copyright '. date( 'Y' ) .' - <a href="'. esc_url( home_url( '/' ) ) .'">'. get_bloginfo( 'name' ) .'</a>';
	if( $prana_options['prana_copyright_control'] == 1 ) {
		
		$prana_copyright_code = '&nbsp;';
		if( ! empty( $prana_options['prana_copyright'] ) ) {
			$prana_copyright_code = wp_specialchars_decode( $prana_options['prana_copyright'], ENT_QUOTES );
		}
	
	}

?>
<div class="grid_10">
  <?php echo $prana_copyright_code; ?>
</div>
<div class="grid_6 grid_credit">
  <a href="<?php echo $prana_theme_data['ThemeURI']; ?>" title="Prana Theme">Prana Theme</a> &sdot; <?php _e( 'Powered by', 'prana' ); ?> <a href="http://wordpress.org/" title="WordPress">WordPress</a>
</div>
<?php	
}

/** Prana Comment List */
function prana_comment( $comment, $args, $depth ) {
  
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case 'pingback':
		case 'trackback':
?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'prana' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'prana' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
		break;
		default:
		?>
			
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				
				<div id="comment-<?php comment_ID(); ?>" class="comment">
	    
					<div class="comment-meta">
						<div class="comment-author vcard">
		    
							<?php
                            $avatar_size = 60;
                            if ( '0' != $comment->comment_parent ) {
                            	$avatar_size = 60;
                            }                            
                            echo get_avatar( $comment, $avatar_size );
							?>
                            
                            <?php                            
                            printf( '%1$s on %2$s <span class="says">%3$s</span>',
                            	sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                            	sprintf( '<a href="%1$s"><span pubdate datetime="%2$s">%3$s</span></a>', esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_time( 'c' ), sprintf( '%1$s at %2$s', get_comment_date(), get_comment_time() ) ),
								__( 'said:', 'prana' )
                            );                            
                            ?>

							<?php edit_comment_link( __( 'Edit', 'prana' ), '<span class="edit-link">', '</span>' ); ?>
		  
						</div> <!-- end .comment-author .vcard -->

						<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'prana' ); ?></em><br />
						<?php endif; ?>

					</div> <!-- end .comment-meta -->

					<div class="comment-content">
					  <?php comment_text(); ?>
                    </div> <!-- end .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'prana' ) . '<span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
		
				</div><!-- end #comment-<?php comment_ID(); ?> -->

		<?php
		break;
	
	} // switch ( $comment->comment_type )

}

/** Filter 'wp_title' to output contextual content. */
add_filter( 'wp_title', 'prana_wp_title', 10, 2 );
function prana_wp_title( $title, $separator ) {
	
	/** Don't affect wp_title() calls in feeds. */
	if ( is_feed() ) {
		return $title;
	}
	
	/** 
	 * Support For SEO Plugins
	 * WPSEO_VERSION => http://wordpress.org/extend/plugins/wordpress-seo/
	 * AIOSEOP_VERSION => http://wordpress.org/extend/plugins/all-in-one-seo-pack/
	 */
	
	if( defined( 'WPSEO_VERSION' ) || defined( 'AIOSEOP_VERSION' ) ) {
		return $title;
	}

	/**
	 * The $paged global variable contains the page number of a listing of posts.
	 * The $page global variable contains the page number of a single post that is paged.
	 * We'll display whichever one applies, if we're not looking at the first page.
	 */
	global $paged, $page;

	if ( is_search() ) {		
		
		/** If we're a search, let's start over: */
		$title = sprintf( 'Search results for %s', '"' . get_search_query() . '"' );
		/** Add a page number if we're on page 2 or more: */
		if ( $paged >= 2 ) {
			$title .= " ". $separator ." " . sprintf( 'Page %s', $paged );
		}
		/** Add the site name to the end: */
		$title .= " ". $separator ." " . get_bloginfo( 'name', 'display' );
		/** We're done. Let's send the new title back to wp_title(): */
		return $title;
	
	}

	/** Otherwise, let's start by adding the site name to the end: */
	$title .= get_bloginfo( 'name', 'display' );

	/** If we have a site description and we're on the home/front page, add the description: */
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " ". $separator ." " . $site_description;
	}

	/** Add a page number if necessary: */
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $separator " . sprintf( 'Page %s', max( $paged, $page ) );
	}

	/** Return the new title to wp_title(): */
	return $title;
}

/** Primary Menu */
function prana_primary_menu_cb() {
	
	$args = array(
		'menu_class' => 'menu clearfix'
	);
	wp_page_menu( $args );		 

}

function prana_primary_menu() {
	
	if ( has_nav_menu( 'prana-primary-menu' ) ) {

	  $args = array(
	  
		  'container' => 'div', 
		  'container_class' => 'menu clearfix', 
		  'theme_location' => 'prana-primary-menu',
		  'menu_class' => 'sf-menu',
		  'depth' => 5,
		  'fallback_cb' => 'prana_primary_menu_cb'
				  
	  );
	
	  wp_nav_menu( $args );
	
	} else {
	
	  prana_primary_menu_cb();	
	
	}

}

/** Sets the post excerpt length. */
add_filter( 'excerpt_length', 'prana_excerpt_length' );
function prana_excerpt_length( $length ) {
	return 20;
}

/** Returns a "Read more" link for content */
add_filter( 'the_content_more_link', 'prana_content_more_link', 10, 2 );
function prana_content_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, '<span>'. __( 'Continue Reading &rarr;', 'prana' ) .'</span>', $more_link );
}

/** Returns a "Read more" link for excerpts */
function prana_continue_reading_link() {
	return '<span class="more-link-wrap"><a href="'. esc_url( get_permalink() ) . '" class="more-link"><span>'. __( 'Continue Reading &rarr;', 'prana' ) .'</span></a></span>';
}

/** Replaces "[...]" (appended to automatically generated excerpts) with prana_continue_reading_link(). */
add_filter( 'excerpt_more', 'prana_auto_excerpt_more' );
function prana_auto_excerpt_more( $more ) {
	return ' <span class="ellipsis">&hellip;</span> ' . prana_continue_reading_link();
}	

/** Adds a pretty "Read more" link to custom post excerpts. */
add_filter( 'get_the_excerpt', 'prana_custom_excerpt_more' );
function prana_custom_excerpt_more( $output ) {
	
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= ' <span class="ellipsis">&hellip;</span> ' . prana_continue_reading_link();
	}
	return $output;

}

/** Remove WP Gallery CSS */
add_filter( 'use_default_gallery_style', '__return_false' );