<?php 
get_header(); 

	
	global 	$TheChameleon;	
	global 	$TheChameleonOption;	
	global 	$TheChameleonTerm;

	$template = !empty($TheChameleonTerm['template']) ? $TheChameleonTerm['template'] : $TheChameleonOption['archive_template'];

	$TheChameleon->Archive->template( $template );
		
	
get_footer();
?>