<?php
	global $TheChameleon;
	global $TheChameleonOption;
	global $TheChameleonMeta;	

	$TheChameleon->render_template( array(
		
		 					array(  'id'	 => 'main',
									'tag'	 => 'main',
									'class'	 => 'main main-wrap temp-col-1',
 				            		'wrap'	 => !empty( $TheChameleonMeta['main_wrap'] ) ? $TheChameleonMeta['main_wrap'] :  $TheChameleonOption['main_wrap'],
	 				               	'parts'	 =>  array( 	
														array(	'id'	 => 'main-content',
                												'tag'	 => 'section',
                												'class'	 => 'main-content-page col-item col-1',						
																'part'	 => 'Page',
                										 ),

	 			 	                			 ),

	 		 		         ),

			 				
			 				

				 ) ); 
?>