<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <h1 class="entry-title entry-title-single"><?php the_title(); ?></h1>
  
  <div class="entry-meta">    
	<?php echo prana_post_date() . prana_post_comments() . prana_post_author() . prana_post_sticky() . prana_post_edit_link(); ?>
  </div><!-- .entry-meta -->
  
  <?php prana_loop_nav_singular(); ?>
  
  <div class="entry-content entry-attachment clearfix">
  	<p><a href="<?php echo wp_get_attachment_url( $post->ID ); ?>"><?php echo wp_get_attachment_image( $post->ID, 'large' ); ?></a></p>
    <?php the_excerpt(); ?>
  </div> <!-- end .entry-content -->
  
</article> <!-- end #post-<?php the_ID(); ?> .post_class -->

<?php prana_loop_nav_singular_attachment(); ?>

<?php comments_template( '', true ); ?>