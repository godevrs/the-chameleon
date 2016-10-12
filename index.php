<?php

	get_header();

	global 	$TheChameleon;
	global 	$TheChameleonOption;
	
		if ( is_main_query() ) :
			
			$TheChameleon->Archive->template( $TheChameleonOption['archive_template'] );
			
		else:

			$TheChameleon->Page->template('right-sidebar');
			
		endif;
	
	
	get_footer();
	
?>

