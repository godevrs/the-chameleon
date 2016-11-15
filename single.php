<?php 
get_header(); 

	global $TheChameleonOption;
	global $TheChameleon;	

	//call post template from obj Post 
	$TheChameleon->Post->template( $TheChameleonOption['post_template'] );
		
			
get_footer();
?>