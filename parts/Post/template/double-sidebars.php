<?php

	global $TheChameleon;
	global $TheChameleonOption;
	global $TheChameleonMeta;
	
	$TheChameleon->render_template(array(

									array( 	'id'		=>'main',
											'class'		=>'main main-wrap temp-col-3-15x60x25',
											'tag'		=>'main',
											'wrap'		=> !empty( $TheChameleonMeta['main_wrap'] ) ? $TheChameleonMeta['main_wrap'] :  $TheChameleonOption['main_wrap'],
			                	       	   	'parts'		=> array(	
																array( 'id'		  => 'sidebar-two',
																		'tag'	  => 'aside',
																		'class'	  => 'sidebar-two sidebar-page col-item col-1',
																		'part'	  => 'Widgets',	
																		'setting' => array( 'sidebar' => $TheChameleonMeta['sidebar_2'] ),
																		),

			 				                					array(	'id'	  => 'main-content',
																		'tag'	  => 'section',
	                													'class'	  => 'main-content-page col-item col-1',	
	                													'part'	  => 'Post',
																		'setting' => array(  ),
																		),

																array(	'id'	  => 'sidebar',
																		'tag'	  => 'aside',
																		'class'	  => 'sidebar-page col-item col-1',
																		'part'	  => 'Widgets',
																		'setting' => array( 'sidebar' => $TheChameleonMeta['sidebar_1'] ),	
																		),

																),			

				 		 		     ),
								)); ?>