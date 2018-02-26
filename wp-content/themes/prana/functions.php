<?php
/** Load the Core Files */
require_once( trailingslashit( get_template_directory() ) . 'lib/init.php' );
new Prana();

/** Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'prana_theme_setup' );

/** Theme setup function. */
function prana_theme_setup() {
	
	/** Add theme support for Feed Links. */
	add_theme_support( 'automatic-feed-links' );

	/** Post Formats */
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'video' ) );
	
	/** Add theme support for Custom Background. */
	add_theme_support( 'custom-background', array( 'default-color' => 'fff' ) );
	
	/** Set content width. */
	prana_set_content_width( 660 );
	
}