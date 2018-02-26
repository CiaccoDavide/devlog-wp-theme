<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

  <div class="entry-meta">    
    <?php echo prana_post_date() . prana_post_comments() . prana_post_author() . prana_post_format() . prana_post_edit_link(); ?>
  </div>
  
  <div class="entry-content clearfix">  
    <?php the_content(); ?>
  </div>

  <div class="entry-meta-bottom">    
    <?php echo prana_post_category() . prana_post_tags(); ?>    
  </div>
  
</article>