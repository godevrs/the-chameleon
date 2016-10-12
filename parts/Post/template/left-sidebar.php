<?php 	

	global $TheChameleon;
	global $TheChameleonOption;
	global $TheChameleonMeta;
	
	$TheChameleon->render_template(  array(
										array( 'id'			=>'main',
											   'tag'		=>'main',
											   'class'		=>'main main-wrap temp-col-2-30x70',   
												'wrap'		=> !empty( $TheChameleonMeta['main_wrap'] ) ? $TheChameleonMeta['main_wrap'] :  $TheChameleonOption['main_wrap'],
					 				           'parts'	 	=>  array(
																	array( 'id'		  =>'sidebar',
																			'tag'	   =>'aside',
																			'class'	  => 'sidebar-single col-item col-1',
																			'part'	  => 'Widgets',	
																			'setting' => array( 'sidebar' => $TheChameleonMeta['sidebar_1'] ), 
																	),
													
														
				 				                					array(	'id'	 => 'main-content',
				              												'tag'	 => 'section',
				              												'class'	 => 'main-content-single col-item col-1',	
				              												'part'	 => 'Post',
																			'setting' => array(  ),
																	),

						 			 	                	),

						 		 		   ),

								   ) ); ?>				
	
