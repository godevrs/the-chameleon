<?php
	global $TheChameleon;
	global $TheChameleonOption;
	global $TheChameleonTerm;
	
	$TheChameleon->render_template( array(

							 		array( 	'id'		=>'main',	
											'class'		=>'main main-wrap temp-col-3-15x60x25',
											'tag'		=>'main',
											'wrap'	 	=> !empty( $TheChameleonTerm['main_wrap'] ) ? $TheChameleonTerm['main_wrap'] :  $TheChameleonOption['main_wrap'],
			                	       	   	'parts'		=> array(	
				
																		array( 'id'	  	  => 'sidebar-two',
																				'tag'	  => 'aside',
																				'class'	  => 'sidebar sidebar-loop col-item col-1',
																				'part'	  => 'Widgets',	
																				'setting' => array( 'sidebar' => $TheChameleonTerm['sidebar_2'] ),
																				),

					 				                					array(	'id'	  => 'main-content',
																				'tag'	  => 'section',
			                													'class'	  => "main-content-loop col-item ". ( !empty( $TheChameleonTerm['columns'] ) ? $TheChameleonTerm['columns'] : $TheChameleonOption['archive_col'] ) ,	
			                													'part'	  => 'Archive',
																				),

																		array(	'id'	  => 'sidebar',
																				'tag'	  => 'aside',
																				'class'	  => 'sidebar-loop col-item col-1',
																				'part'	  => 'Widgets',
																				'setting' => array( 'sidebar' => $TheChameleonTerm['sidebar_1'] ),	
																				),
																	
																	
																			),			

				 		 		                	),




								)); ?>