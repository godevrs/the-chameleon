<?php 

   global $TheChameleon;		
   global $TheChameleonOption;		
   global $TheChameleonMeta;	

	$sidebar = !empty( $TheChameleonMeta['top_sidebar'] ) ? $TheChameleonMeta['top_sidebar'] : 'Top';
	$sidebar = ( is_single() ) ? 'Post Top' : $sidebar; 	
	$wrap 	 = !empty( $TheChameleonMeta['top_wrap'] )    ? $TheChameleonMeta['top_wrap']    : $TheChameleonOption['top_wrap'];	
	$col 	 = !empty( $TheChameleonMeta['top_col'] )     ? $TheChameleonMeta['top_col']     : $TheChameleonOption['top_col'];
	

	if( is_active_sidebar( "$sidebar" ) ) :
	
		$TheChameleon->render_template(	array(
											array(	
												'id'	=>'top',
												'tag'	=>'section',
								        		'wrap'	=> $wrap ,
												'class' => '',
								        		'parts'	=>array(
								        						array(	
																	'id'	  => 'top-content',
																	'tag'	  => 'section',
										        					'class'	  => $col ,
										        					'part'	  => 'Widgets',
										        					'setting' => array( 'sidebar' => $sidebar )	
										        					 ),
						 		        						),	 
								        			) 
												)  
											);
										
	endif;

?>