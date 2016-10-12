<?php

        global $TheChameleon;		
		global $TheChameleonOption;		
							
		
		if ( is_active_sidebar( "upper ") )	:	
						
			$TheChameleon->render_template(	array(
												array(	
												'id'	=> 'upper',	
												'tag'	=> 'section',
												'wrap'	=>	$TheChameleonOption['upper_wrap'],
									  			'parts'	=> array( 
										        				array( 	
																	'id'	  => 'upper-content',
																	'tag'	  => 'section',
													        		'class'	  => esc_attr( $TheChameleonOption['upper_col'] ), 
													        		'part'	  => 'Widgets',
													        		'setting' => array( 'sidebar' => 'Upper')	
										        			          ), 
															)
										 		) ));						
	    endif;
		
	?>