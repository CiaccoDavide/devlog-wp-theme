<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
  <?php $entry_title = ( 'page' == get_post_type() && prana_post_edit_link() == '' )? 'entry-title entry-title-page' : 'entry-title'; ?>
  <h2 class="<?php echo $entry_title; ?>"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
  
  <?php if ( 'post' == get_post_type() ) : ?>  
  <div class="entry-meta">    
	<?php echo prana_post_date() . prana_post_comments() . prana_post_author() . prana_post_sticky() . prana_post_edit_link(); ?>
  </div><!-- .entry-meta -->  
  <?php elseif ( 'page' == get_post_type() && prana_post_edit_link() != '' ) : ?>  
  <div class="entry-meta"> 
    <?php echo prana_post_edit_link(); ?> 
  </div>  
  <?php endif;?>
  
  <?php prana_featured_image(); ?>  
  
  <div class="entry-content clearfix">
	<?php prana_post_style(); ?>
  </div> <!-- end .entry-content -->
  
  <?php echo prana_link_pages(); ?>
  
  <?php if ( 'post' == get_post_type() ) : ?>
  <div class="entry-meta-bottom">    
  <?php echo prana_post_category() . prana_post_tags(); ?>    
  </div><!-- .entry-meta-bottom -->
  <?php endif; ?>

</article> <!-- end #post-<?php the_ID(); ?> .post_class -->