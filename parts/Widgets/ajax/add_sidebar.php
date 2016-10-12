<?php



if ( !empty( $_POST['create_sidebar'] ) ) :
	global $config;

	$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
	require_once( $parse_uri[0] . 'wp-load.php' );
		
	$sidebar_name = esc_html( $_POST['create_sidebar'] );
	
	$get_custom_sidebars = get_option($config->slug.'custom_sidebars', array());
	$get_custom_sidebars  = !empty($get_custom_sidebars) ? $get_custom_sidebars : array();
	
	if ( in_array( $sidebar_name, $get_custom_sidebars ) ) :
		
		echo 'exist';
		
	else:

		update_option( $config->slug . 'custom_sidebars', array_unique( array_merge( $get_custom_sidebars, array( trim( esc_html( $_POST['create_sidebar'] ) ) ) ) ) );

		echo 'success';
		
	endif;

	
endif;


	
?>