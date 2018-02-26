<div class="wrap prana-settings">
  
  <?php 
  /** Get the parent theme data. */
  $prana_theme_data = prana_theme_data();
  screen_icon();
  ?>
  
  <h2><?php echo sprintf( __( '%1$s Theme Settings', 'prana' ), $prana_theme_data['Name'] ); ?></h2>    
  
  <?php settings_errors(); ?>
  
  <div id="prana-pro-wrapper">
    <a href="http://designorbital.com/prana-pro/?utm_source=wporg-prana&utm_medium=button&utm_campaign=prana-pro" class="button button-primary button-hero" target="_blank"><?php _e( 'Prana Pro Features', 'prana' ); ?></a>
    <a href="http://designorbital.com/free-wordpress-themes/?utm_source=wporg-prana&utm_medium=button&utm_campaign=free-wp-themes" class="button button-hero" target="_blank"><?php _e( 'Our Free Themes', 'prana' ); ?></a>
    <a href="https://www.facebook.com/designorbital" class="button button-hero" target="_blank"><?php _e( 'Like Us On Facebook', 'prana' ); ?></a>
    <a href="https://twitter.com/designorbital" class="button button-hero" target="_blank"><?php _e( 'Follow On Twitter', 'prana' ); ?></a>
  </div>
  
  <form action="options.php" method="post" id="prana-form-wrapper">
    
    <div id="prana-form-header" class="prana-clearfix">
      <input type="submit" name="" id="" class="button button-primary" value="<?php _e( 'Save Changes', 'prana' ); ?>">
    </div>
	
	<?php settings_fields('prana_options_group'); ?>
    
    <div id="prana-sidebar">
      
      <ul id="prana-group-menu">
        <li id="0_section_group_li" class="prana-group-tab-link-li active"><a href="javascript:void(0);" id="0_section_group_li_a" class="prana-group-tab-link-a" data-rel="0"><span><?php _e( 'Blog Settings', 'prana' ); ?></span></a></li>
        <li id="1_section_group_li" class="prana-group-tab-link-li"><a href="javascript:void(0);" id="1_section_group_li_a" class="prana-group-tab-link-a" data-rel="1"><span><?php _e( 'Post Settings', 'prana' ); ?></span></a></li>
        <li id="2_section_group_li" class="prana-group-tab-link-li"><a href="javascript:void(0);" id="2_section_group_li_a" class="prana-group-tab-link-a" data-rel="2"><span><?php _e( 'Footer Settings', 'prana' ); ?></span></a></li>
        <li id="3_section_group_li" class="prana-group-tab-link-li"><a href="javascript:void(0);" id="3_section_group_li_a" class="prana-group-tab-link-a" data-rel="3"><span><?php _e( 'General Settings', 'prana' ); ?></span></a></li>
      </ul>
    
    </div>
    
    <div id="prana-main">
    
      <div id="0_section_group" class="prana-group-tab">
        <?php do_settings_sections( 'prana_section_blog_page' ); ?>
      </div>
      
      <div id="1_section_group" class="prana-group-tab">
        <?php do_settings_sections( 'prana_section_post_page' ); ?>
      </div>
      
      <div id="2_section_group" class="prana-group-tab">
        <?php do_settings_sections( 'prana_section_footer_page' ); ?>
      </div>
      
      <div id="3_section_group" class="prana-group-tab">
        <?php do_settings_sections( 'prana_section_general_page' ); ?>
      </div>
    
    </div>
    
    <div class="clear"></div>
    
    <div id="prana-form-footer" class="prana-clearfix">
      <input type="submit" name="" id="" class="button button-primary" value="<?php _e( 'Save Changes', 'prana' ); ?>">
    </div>
    
  </form>

</div>