<?php
/** Prana Default Settings. */
function prana_settings_default()  {
			
	$default = array(
			
		'prana_nav_style' => 'numeric',
		
		'prana_post_style' => 'content',
		'prana_featured_image_control' => 'manual',
		
		'prana_copyright_control' => 0,
		'prana_copyright' => '',
		
		'prana_reset_control' => 0
		
	);
	
	return $default;
	
}

/** Loads the Prana theme setting. */
function prana_get_settings() {
	global $prana;

	/* If the settings array hasn't been set, call get_option() to get an array of theme settings. */
	if ( !isset( $prana->settings ) ) {
		$prana->settings = wp_parse_args( get_option( 'prana_options', prana_settings_default() ), prana_settings_default() );
	}
	
	/** return settings. */
	return $prana->settings;
}