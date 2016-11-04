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

									array(  'id'	=> 'main',
											'tag'	=> 'main',
											'class'	=> 'main main-wrap temp-col-3-15x25x60',
											'wrap'	=> !empty( $TheChameleonTerm['main_wrap'] ) ? $TheChameleonTerm['main_wrap'] :  $TheChameleonOption['main_wrap'],	
				 				        	'parts'	=> array(



																array(	'id'	  => 'sidebar-two',
																		'tag'	  => 'aside',
																		'class'	  => 'sidebar sidebar-loop col-item col-1',
																		'part'	  => 'Widgets',
																		'setting' => array( 'sidebar' => $TheChameleonTerm['sidebar_2'] ),	
																		),

																array(	'id'	  => 'sidebar',
																		'tag'	  => 'aside',
																		'class'	  => 'sidebar-loop col-item col-1',
																		'part'	  => 'Widgets',	
																		'setting' => array( 'sidebar' => $TheChameleonTerm['sidebar_1'] ),
																		),

																array(	'id'	 => 'main-content',
																		'tag'	 => 'section',
       																	'class'	 => "main-content-loop col-item ". ( !empty( $TheChameleonTerm['columns'] ) ? $TheChameleonTerm['columns'] : $TheChameleonOption['archive_col'] ) ,	
       																	'part'	 => 'Archive',
      																	),

		 			 	                				),


		 		 		                	),


			)); ?>
				
				
				
				
