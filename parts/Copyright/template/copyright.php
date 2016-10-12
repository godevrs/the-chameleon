<?php

	global 	$TheChameleon;
	global 	$TheChameleonOption;
	
	
	if( is_active_sidebar( "Copyright" ) ) :
		
		$TheChameleon->render_template( array(

											array(	
												'id'	 => 'copyright',
												'tag'	 => 'section',
												'wrap'	 => $TheChameleonOption['copyright_wrap'],
												'parts'	 => array(
																array(	
																	'id'	  => 'copyright-content',
														            'tag'	  => 'section',
														            'class'	  => $TheChameleonOption['copyright_col'],
														            'part'	  => 'Widgets', 
														            'setting' => array( 'sidebar' => 'Copyright' ) 
																	),
																),	

											 ) 

							));
	endif;
?>