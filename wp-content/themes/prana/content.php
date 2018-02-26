<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
  
  <div class="entry-meta">    
	  <?php echo prana_post_date() . prana_post_comments() . prana_post_author() . prana_post_sticky() . prana_post_edit_link(); ?>
  </div>
  
  <?php prana_featured_image(); ?>
  
  <div class="entry-content clearfix">	
	  <?php prana_post_style(); ?>
  </div>
  
  <?php echo prana_link_pages(); ?>
  
  <div class="entry-meta-bottom">    
    <?php echo prana_post_category() . prana_post_tags(); ?>    
  </div>

</article>