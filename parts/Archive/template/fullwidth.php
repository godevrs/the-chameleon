<?php 

	
	global $TheChameleon;
	global $TheChameleonOption;
	global $TheChameleonTerm;
	
	
	/*Define columns for blog and taxs*/
	if ( is_category() or is_tax() or is_archive() or is_search() or is_tag() ) :	
		$col  = $TheChameleonTerm['columns'];							
	elseif ( is_blog_installed() ):							
		$col  = $TheChameleonOption['archive_col'];						
	else:			
		$col  = $TheChameleonTerm['columns'];							
	endif; 
	
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
	
	
