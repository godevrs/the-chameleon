<?php

	global 	$TheChameleon;
	global 	$TheChameleonOption;
	
	if( is_active_sidebar( "Footer" ) ) :
		
		$TheChameleon->render_template( array(
											array(	
												'id'	 => 'footer',
												'tag'	 => 'footer',
												'wrap'	 => $TheChameleonOption['footer_wrap'],	
												'parts'	 => array(                                      
																array(	
																	'id'	  => 'footer-content',				
															        'tag'	  => 'section',
															        'class'	  => $TheChameleonOption['footer_col'],	
															        'part'	  => 'Widgets',
															        'setting' => array( 'sidebar' => 'Footer' )																										
															        ),
																),

										  	),


						));
	endif;
						
?>