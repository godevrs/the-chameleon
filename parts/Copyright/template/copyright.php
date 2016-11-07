<?php

	global 	$TheChameleon;
	global 	$TheChameleonOption;
	
	
	
		
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
														            'part'	  => is_active_sidebar( 'Copyright' ) ? 'Widgets' : 'Copyright',
														            'setting' => array( 'sidebar' => 'Copyright' ) 
																	),
																),	

											 ) 

							));
	
?>