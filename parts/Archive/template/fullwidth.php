<?php 

	
	global $TheChameleon;
	global $TheChameleonOption;
	global $TheChameleonTerm;
	
/*	print_R( $TheChameleonTerm);*/
	
	$TheChameleon->render_template(array( 
										array( 	'id'		=>'main',
												'class'		=>'main main-wrap temp-col-1',
												'tag'		=>'main',
												'wrap'	 	=> !empty( $TheChameleonTerm['main_wrap'] ) ? $TheChameleonTerm['main_wrap'] :  $TheChameleonOption['main_wrap'],
				                	       	   	'parts'		=> array( 
																	array(	'id'	=> 'main-content',
																			'tag'	=> 'section',
	 				                										'class'	=> "main-content-loop col-item ". ( !empty( $TheChameleonTerm['columns'] ) ? $TheChameleonTerm['columns'] : $TheChameleonOption['archive_col'] ) ,	
	 				                										'part'	=> 'Archive'
																			),
																			
							 			 	                		),
	 		 		                	),

									)); ?>
	
	
