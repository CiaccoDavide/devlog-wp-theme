<?php get_header();	?>

<div class="container_16 clearfix">
  
  <div class="grid_12">
    <main id="content" class="site-main" role="main">	  
	  
	  <?php if ( have_posts() ) : ?>
      
        <?php while ( have_posts() ) : the_post(); ?>
        
          <?php get_template_part( 'content', 'single' ); ?>
        
        <?php endwhile; ?>
      
      <?php else : ?>
                  
        <?php get_template_part( 'loop-error' ); ?>
      
      <?php endif; ?>
      
      <?php prana_loop_nav_singular_post(); ?>
    
    </main> <!-- end #content -->
  </div> <!-- end .grid_12 -->
  
  <?php get_sidebar(); ?>

</div> <!-- end .container_16 -->
  
<?php get_footer(); ?>