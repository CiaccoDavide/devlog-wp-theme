<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <h1 class="entry-title entry-title-single"><?php the_title(); ?></h1>
  
  <div class="entry-meta">    
	<?php echo prana_post_date() . prana_post_comments() . prana_post_author() . prana_post_sticky() . prana_post_edit_link(); ?>
  </div><!-- .entry-meta -->
  
  <div class="entry-content clearfix">
  	<?php the_content(); ?>
  </div> <!-- end .entry-content -->
  
  <?php echo prana_link_pages(); ?>
  
  <div class="entry-meta-bottom">
  <?php echo prana_post_category() . prana_post_tags(); ?>
  </div><!-- .entry-meta -->

</article> <!-- end #post-<?php the_ID(); ?> .post_class -->

<?php prana_author(); ?> 

<?php comments_template( '', true ); ?>