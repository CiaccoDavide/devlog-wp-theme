<?php
class PranaAdmin {
		
		/** Constructor Method */
		function __construct() {
	
			/** Load the admin_init functions. */
			add_action( 'admin_init', array( &$this, 'admin_init' ) );
			
			/* Hook the settings page function to 'admin_menu'. */
			add_action( 'admin_menu', array( &$this, 'settings_page_init' ) );		
	
		}
		
		/** Initializes any admin-related features needed for the framework. */
		function admin_init() {
			
			/** Registers admin JavaScript and Stylesheet files for the framework. */
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_register_scripts' ), 1 );
		
			/** Loads admin JavaScript and Stylesheet files for the framework. */
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
			
		}
		
		/** Registers admin JavaScript and Stylesheet files for the framework. */
		function admin_register_scripts() {
			
			/** Register Admin Stylesheet */
			wp_register_style( 'prana-admin-css-style', esc_url( PRANA_ADMIN_URI . 'style.css' ) );
			
			/** Register Admin Scripts */
			wp_register_script( 'prana-admin-js-prana', esc_url( PRANA_ADMIN_URI . 'common.js' ) );
			wp_register_script( 'prana-admin-js-jquery-cookie', esc_url( PRANA_JS_URI . 'jquery-cookie/jquery.cookie.js' ) );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for the framework. */
		function admin_enqueue_scripts() {			
		}
		
		/** Initializes all the theme settings page functionality. This function is used to create the theme settings page */
		function settings_page_init() {
			
			global $prana;
			
			/** Register theme settings. */
			register_setting( 'prana_options_group', 'prana_options', array( &$this, 'prana_options_validate' ) );
			
			/* Create the theme settings page. */
			$prana->settings_page = add_theme_page( 
				esc_html( __( 'Prana Options', 'prana' ) ),	/** Settings page name. */
				esc_html( __( 'Prana Options', 'prana' ) ),	/** Menu item name. */
				$this->settings_page_capability(),				/** Required capability */
				'prana-options', 								/** Screen name */
				array( &$this, 'settings_page' )				/** Callback function */
			);
			
			/* Check if the settings page is being shown before running any functions for it. */
			if ( !empty( $prana->settings_page ) ) {
				
				/** Add contextual help to the theme settings page. */
				add_action( 'load-'. $prana->settings_page, array( &$this, 'settings_page_contextual_help' ) );
				
				/* Load the JavaScript and stylesheets needed for the theme settings screen. */
				add_action( 'admin_enqueue_scripts', array( &$this, 'settings_page_enqueue_scripts' ) );
				
				/** Configure settings Sections and Fileds. */
				$this->settings_sections();
				
			}
			
		}
		
		/** Returns the required capability for viewing and saving theme settings. */
		function settings_page_capability() {
			return 'edit_theme_options';
		}
		
		/** Displays the theme settings page. */
		function settings_page() {
			require( PRANA_ADMIN_DIR . 'page.php' );
		}
		
		/** Text for the contextual help for the theme settings page in the admin. */
		function settings_page_contextual_help() {
			
			/** Get the parent theme data. */
			$theme = prana_theme_data();
			$AuthorURI = $theme['AuthorURI'];
			$ThemeURI = $theme['ThemeURI'];
		
			/** Get the current screen */
			$screen = get_current_screen();
			
			/** Add theme reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'prana-theme',
				'title' => __( 'Theme Support', 'prana' ),
				'content' => implode( '', file( PRANA_ADMIN_DIR . 'help/support.html' ) ),				
				
				)
			);
			
			/** Add license reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'prana-license',
				'title' => __( 'License', 'prana' ),
				'content' => implode( '', file( PRANA_ADMIN_DIR . 'help/license.html' ) ),				
				
				)
			);
			
			/** Add changelog reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'prana-changelog',
				'title' => __( 'Changelog', 'prana' ),
				'content' => implode( '', file( PRANA_ADMIN_DIR . 'help/changelog.html' ) ),				
				
				)
			);
			
			/** Help Sidebar */
			$sidebar = '<p><strong>' . __( 'For more information:', 'prana' ) . '</strong></p>';
			if ( !empty( $AuthorURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $AuthorURI ) . '" target="_blank">' . __( 'Prana Project', 'prana' ) . '</a></p>';
			}
			if ( !empty( $ThemeURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $ThemeURI ) . '" target="_blank">' . __( 'Prana Official Page', 'prana' ) . '</a></p>';
			}			
			$screen->set_help_sidebar( $sidebar );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for displaying the theme settings page in the WordPress admin. */
		function settings_page_enqueue_scripts( $hook ) {
			
			/** Load Scripts For Prana Options Page */
			if( $hook === 'appearance_page_prana-options' ) {
				
				/** Load Admin Stylesheet */
				wp_enqueue_style( 'prana-admin-css-style' );
				
				/** Load Admin Scripts */
				wp_enqueue_script( 'prana-admin-js-prana' );
				wp_enqueue_script( 'prana-admin-js-jquery-cookie' );
				
			}
				
		}
		
		/** Configure settings Sections and Fileds */		
		function settings_sections() {
		
			/** Blog Section */
			add_settings_section( 'prana_section_blog', 'Blog Options', array( &$this, 'prana_section_blog_fn' ), 'prana_section_blog_page' );			
			
			add_settings_field( 'prana_field_nav_style', __( 'Navigation Style', 'prana' ), array( &$this, 'prana_field_nav_style_fn' ), 'prana_section_blog_page', 'prana_section_blog' );
			
			/** Post Section */
			add_settings_section( 'prana_section_post', 'Post Options', array( &$this, 'prana_section_post_fn' ), 'prana_section_post_page' );
			
			add_settings_field( 'prana_field_post_style', __( 'Post Style', 'prana' ), array( &$this, 'prana_field_post_style_fn' ), 'prana_section_post_page', 'prana_section_post' );
			add_settings_field( 'prana_field_featured_image_control', __( 'Post Featured Image', 'prana' ), array( &$this, 'prana_field_featured_image_control_fn' ), 'prana_section_post_page', 'prana_section_post' );
			
			/** Footer Section */
			add_settings_section( 'prana_section_footer', 'Footer Options', array( &$this, 'prana_section_footer_fn' ), 'prana_section_footer_page' );
			
			add_settings_field( 'prana_field_copyright_control', __( 'Use Copyright', 'prana' ), array( &$this, 'prana_field_copyright_control_fn' ), 'prana_section_footer_page', 'prana_section_footer' );
			add_settings_field( 'prana_field_copyright', __( 'Enter Copyright Text', 'prana' ), array( &$this, 'prana_field_copyright_fn' ), 'prana_section_footer_page', 'prana_section_footer' );
			
			/** General Section */
			add_settings_section( 'prana_section_general', 'General Options', array( &$this, 'prana_section_general_fn' ), 'prana_section_general_page' );
			
			add_settings_field( 'prana_field_reset_control', __( 'Reset Theme Options', 'prana' ), array( &$this, 'prana_field_reset_control_fn' ), 'prana_section_general_page', 'prana_section_general' );
		
		}
		
		/** Prana Pre-defined Range */
		
		/* Boolean Yes | No */		
		function prana_boolean_pd() {			
			return array( 1 => __( 'yes', 'prana' ), 0 => __( 'no', 'prana' ) );		
		}
		
		/* Nav Style Range */		
		function prana_nav_style_pd() {			
			return array( 'numeric' => __( 'Numeric', 'prana' ), 'older-newer' => __( 'Older / Newer', 'prana' ) );			
		}
		
		/* Post Style Range */		
		function prana_post_style_pd() {			
			return array( 'content' => __( 'Content', 'prana' ), 'excerpt' => __( 'Excerpt', 'prana' ) );			
		}
		
		/* Featured Image Range */		
		function prana_featured_image_pd() {			
			return array( 'manual' => __( 'Use Featured Image', 'prana' ), 'auto' => __( 'Use Featured Image Automatically', 'prana' ), 'no' => __( 'No Featured Image', 'prana' ) );			
		}		
		
		/** Prana Options Validation */				
		function prana_options_validate( $input ) {
			
			/** Default */
			$default = prana_settings_default();

			/** Prana Predefined */			
			$prana_boolean_pd = $this->prana_boolean_pd();
			$prana_nav_style_pd = $this->prana_nav_style_pd();
			$prana_post_style_pd = $this->prana_post_style_pd();
			$prana_featured_image_pd = $this->prana_featured_image_pd();						
			
			/* Validation: prana_nav_style */
			if ( ! array_key_exists( $input['prana_nav_style'], $prana_nav_style_pd ) ) {
				 $input['prana_nav_style'] = $default['prana_nav_style'];
			}
			
			/* Validation: prana_post_style */			
			if ( ! array_key_exists( $input['prana_post_style'], $prana_post_style_pd ) ) {
				 $input['prana_post_style'] = $default['prana_post_style'];
			}
			
			/* Validation: prana_featured_image_control */			
			if ( ! array_key_exists( $input['prana_featured_image_control'], $prana_featured_image_pd ) ) {
				 $input['prana_featured_image_control'] = $default['prana_featured_image_control'];
			}										
			
			/* Validation: prana_copyright_control */			
			if ( ! array_key_exists( $input['prana_copyright_control'], $prana_boolean_pd ) ) {
				 $input['prana_copyright_control'] = $default['prana_copyright_control'];
			}
			
			/* Validation: prana_copyright */
			if( !empty( $input['prana_copyright'] ) ) {
				$input['prana_copyright'] = htmlspecialchars ( $input['prana_copyright'] );
			}
			
			/* Validation: prana_reset_control */
			if( isset( $input['prana_reset_control'] ) ) {
			
				if ( ! array_key_exists( $input['prana_reset_control'], $prana_boolean_pd ) ) {
					 $input['prana_reset_control'] = $default['prana_reset_control'];
				}
	
				/** Reset Logic */
				if( $input['prana_reset_control'] == 1 ) {
					$input = $default;
				}
				
			}
			
			return $input;
		
		}
		
		/** Blog Section Callback */				
		function prana_section_blog_fn() {
			echo '<div class="prana-section-desc">
			  <p class="description">'. __( 'Customize your blog by using the following settings.', 'prana' ) .'</p>
			</div>';
		}
		
		/* Nav Style Callback */		
		function prana_field_nav_style_fn() {
			
			$prana_options = prana_get_settings();
			$items = $this->prana_nav_style_pd();
			
			echo '<select id="prana_nav_style" name="prana_options[prana_nav_style]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $prana_options['prana_nav_style'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select navigation style.', 'prana' ) .'</small></div>';
		
		}
		
		/** Post Section Callback */				
		function prana_section_post_fn() {
			echo '<div class="prana-section-desc">
			  <p class="description">'. __( 'Customize your posts by using the following settings.', 'prana' ) .'</p>
			</div>';
		}
		
		/* Post Style Callback */		
		function prana_field_post_style_fn() {
			
			$prana_options = prana_get_settings();
			$items = $this->prana_post_style_pd();
			
			echo '<select id="prana_post_style" name="prana_options[prana_post_style]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $prana_options['prana_post_style'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select post style.', 'prana' ) .'</small></div>';
		
		}
		
		/* Featured Image Callback */		
		function prana_field_featured_image_control_fn() {
			
			$prana_options = prana_get_settings();
			$items = $this->prana_featured_image_pd();
			
			echo '<select id="prana_featured_image_control" name="prana_options[prana_featured_image_control]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $prana_options['prana_featured_image_control'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( '<strong>Use Featured Image:</strong> which is set in the post.', 'prana' ) .'</small></div>';
			echo '<div><small>'. __( '<strong>Use Featured Image Automatically:</strong> from the images uploaded to the post.', 'prana' ) .'</small></div>';
			echo '<div><small>'. __( '<strong>No Featured Image:</strong> for the post.', 'prana' ) .'</small></div>';
		
		}
		
		/** Footer Section Callback */				
		function prana_section_footer_fn() {
			echo '<div class="prana-section-desc">
			  <p class="description">'. __( 'Customize your footer by using the following settings.', 'prana' ) .'</p>
			</div>';
		}
		
		/* Copyright Control Callback */		
		function  prana_field_copyright_control_fn() {
			
			$prana_options = prana_get_settings();
			$items = $this->prana_boolean_pd();
			
			echo '<select id="prana_copyright_control" name="prana_options[prana_copyright_control]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $prana_options['prana_copyright_control'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select yes to override default copyright text.', 'prana' ) .'</small></div>';
		
		}
		
		/* Copyright Callback */
		function prana_field_copyright_fn() {
			
			$prana_options = prana_get_settings();
			echo '<textarea type="textarea" id="prana_copyright" name="prana_options[prana_copyright]" rows="7" cols="50">'. esc_html ( $prana_options['prana_copyright'] ) .'</textarea>';
			echo '<div><small>'. __( 'Enter the copyright text.', 'prana' ) .'</small></div>';
			echo '<div><small>Example: <strong>&amp;copy; Copyright '.date('Y').' - &lt;a href="'. esc_url( home_url( '/' ) ) .'"&gt;'. get_bloginfo('name') .'&lt;/a&gt;</strong></small></div>';
		
		}
		
		/** General Section Callback */				
		function prana_section_general_fn() {
			echo '<div class="prana-section-desc">
			  <p class="description">'. __( 'Here are the general settings to customize your blog.', 'prana' ) .'</p>
			</div>';
		}
		
		/* Reset Congrol Callback */		
		function prana_field_reset_control_fn() {
			
			$prana_options = prana_get_settings();			
			$items = $this->prana_boolean_pd();			
			echo '<label><input type="checkbox" id="prana_reset_control" name="prana_options[prana_reset_control]" value="1" /> '. __( 'Reset Theme Options.', 'prana' ) .'</label>';
		
		}
}

/** Initiate Admin */
new PranaAdmin();