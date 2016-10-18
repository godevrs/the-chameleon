<?php 

	global $TheChameleon;
	global $TheChameleonOption;
	global $TheChameleonMeta;

	$TheChameleon->render_template( array(	
	
								array(  'id'		=> 'main',
										'tag'		=> 'main', 
										'class'		=> 'main-wrap temp-col-2-70x30',  
										'wrap'	 	=> !empty( $TheChameleonMeta['main_wrap'] ) ? $TheChameleonMeta['main_wrap'] :  $TheChameleonOption['main_wrap'],
					       				'parts'	 	=> array( 
	
															array(	'id'	  => 'main-content',
																	'tag'	  => 'section',
																	'class'	  => 'main-content-page col-item col-1',	
																	'part'	  => 'WooCommerce',
																	'setting' => array()
															),


															array(	'id'	  => 'sidebar',
																	'tag'	  => 'aside',
																	'class'	  => 'sidebar-page col-item col-1',
																	'part'	  => 'Widgets',
																	'setting' =>  array( 'sidebar' => 'WooCommerce')
															),

								                	 ),

								),	
						) ); ?>
					
