<?php
/** Register nav menus. */
add_action( 'init', 'prana_register_menus' );

/** Registers the the core menus */
function prana_register_menus() {

	/* Register the 'primary' menu. */
	register_nav_menu( 'prana-primary-menu', __( 'Prana Primary Menu', 'prana' ) );
	
}