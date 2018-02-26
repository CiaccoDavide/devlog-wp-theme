<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <div class="entry-meta">    
    <?php echo prana_post_date() . prana_post_comments() . prana_post_author() . prana_post_format() . prana_post_edit_link(); ?>
  </div>
  
  <div class="entry-content clearfix">  
    <?php the_content(); ?>
  </div>
  
</article>