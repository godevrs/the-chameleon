<?php 

	global $TheChameleon;
	global $TheChameleonOption;
	global $TheChameleonMeta;

	$TheChameleon->render_template( array( 
											array( 	'id'		=>'main',
													'class'		=>'main main-wrap temp-col-1',
													'tag'		=>'main',
													'wrap'		=> !empty( $TheChameleonMeta['main_wrap'] ) ? $TheChameleonMeta['main_wrap'] :  $TheChameleonOption['main_wrap'],
					                	       	   	'parts'		=> array( 
																			array(	'id'	  => 'main-content',
																					'tag'	  => 'section',
			 				                										'class'	  => 'main-content-single col-item col-1',	
			 				                										'part'	  => 'Post',
																					'setting' => array(  ),
																					),

									 			 	                		),
			 		 		                	),

		)); ?>


