<?php
	
    global $TheChameleon;		
	global $TheChameleonOption;
	global $TheChameleonMeta;
	
	$sidebar = !empty( $TheChameleonMeta['bottom_sidebar' ]) ? $TheChameleonMeta['bottom_sidebar'] : 'Bottom';
	$wrap 	 = !empty( $TheChameleonMeta['bottom_wrap'] )    ? $TheChameleonMeta['bottom_wrap']    : $TheChameleonOption['bottom_wrap'];	
	$col 	 = !empty( $TheChameleonMeta['bottom_sidebar'] ) ? $TheChameleonMeta['bottom_col']     : $TheChameleonOption['bottom_col'];


	//is actove bottom widgets
	if( is_active_sidebar( "$sidebar" ) ) :

			$TheChameleon->render_template( array(
												array(	
													'id'	 => 'bottom',
													'tag'	 => 'section',
													'wrap'	 =>  $wrap,	
													'parts'  =>  array(
																     array(
															        	'id'	  => 'bottom-content',
															        	'tag'	  => 'section', //in % 
															        	'class'	  => $col,	
															        	'part'	  => 'Widgets', 
															        	'setting' => array( 'sidebar' => $sidebar )
															              ),
																       ),	
													)	 	
												) 
										);

	endif;
?>