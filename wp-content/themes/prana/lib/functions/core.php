<?php
/** Function for setting the content width of a theme. */
function prana_set_content_width( $width = '' ) {
	global $content_width;
	$content_width = absint( $width );
}

/** Function for getting the theme's content width. */
function prana_get_content_width() {
	global $content_width;
	return $content_width;
}

/** Function for getting the theme's data */
function prana_theme_data() {
	global $prana;
	
	/** If the parent theme data isn't set, let grab it. */
	if ( empty( $prana->theme_data ) ) {
		
		$prana_theme_data = array();
		$theme_data = wp_get_theme( 'prana' );
		$prana_theme_data['Name'] = $theme_data->get( 'Name' );
		$prana_theme_data['ThemeURI'] = $theme_data->get( 'ThemeURI' );
		$prana_theme_data['AuthorURI'] = $theme_data->get( 'AuthorURI' );
		$prana_theme_data['Description'] = $theme_data->get( 'Description' );
		
		$prana->theme_data = $prana_theme_data;
	
	}

	/** Return the parent theme data. */
	return $prana->theme_data;
}