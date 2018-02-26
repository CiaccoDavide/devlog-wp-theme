<?php
/* Adds theme support for WordPress 'featured images'. */
add_theme_support( 'post-thumbnails' );

/** Add custom image sizes. */
add_action( 'init', 'prana_add_image_sizes' );
function prana_add_image_sizes() {
	add_image_size( 'prana-image-featured', 660, 360, true );
}

/** Prana Get Image Id Manual */
function prana_get_image_id_manual( $num = 0 ) {
	
	/** Global Object */
	global $post;
	
	/** WordPress Featured Image Set In the Post - Manual */
	if ( has_post_thumbnail() && ( $num === 0 ) ) {			
		return get_post_thumbnail_id();		
	}
	
	return false;

}

/** Prana Get Image Id Auto */
function prana_get_image_id_auto( $num = 0 ) {
	
	/** Global Object */
	global $post;
	
	/** Manual Check At Priority */
	$id = prana_get_image_id_manual( $num );
	
	if( ! empty( $id ) ) {
		return $id;
	}
	
	/** Start Manual Mode */
	$image_ids = array_keys(
		get_children(
			array(
				'post_parent' => $post->ID,
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			)
		)
	);

	if ( isset( $image_ids[$num] ) ) {
		return $image_ids[$num];
	}

	return false;
}

/** Prana Get Image*/
function prana_get_image( $args = array() ) {

	/** Arguments */
	$defaults = array( 'format' => 'html', 'size' => 'full', 'mode' => 'auto', 'num' => 0, 'attr' => '' );	
	$args = wp_parse_args( $args, $defaults );
	
	/** Featured Image Id */
	$id = '';
	if( $args['mode'] == 'manual' ) {		
		$id = prana_get_image_id_manual( $args['num'] );			
	} else {	
		$id = prana_get_image_id_auto( $args['num'] );	
	}
	
	/** ID Validation */
	if( empty( $id ) ) {
		return false;
	}
	
	/** Featured Image Logic */
	$html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
	list( $url ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );

	/** Source path, relative to the root */
	$src = str_replace( esc_url( home_url() ), '', $url );

	/** Output Logic */
	if ( strtolower( $args['format'] ) == 'html' ) {
		$output = $html;
	} else if ( strtolower( $args['format'] ) == 'url' ) {
		$output = $url;
	} else {
		$output = $src;
	}

	/** return false if $url is blank */
	if ( empty( $url ) ) {
		$output = false;
	}

	/** return output */
	return $output;
}