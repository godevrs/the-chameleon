<?php
	

	global $TheChameleon;		
    global $TheChameleonOption;		
    global $TheChameleonMeta;	

	$sidebar = !empty( $TheChameleonMeta['header_sidebar'] ) ? $TheChameleonMeta['header_sidebar'] : 'Header';
	$wrap 	 = !empty( $TheChameleonMeta['header_wrap'] ) ? $TheChameleonMeta['header_wrap'] : $TheChameleonOption['header_wrap'];	
	$col 	 = !empty( $TheChameleonMeta['header_col'] ) ? $TheChameleonMeta['header_col'] : $TheChameleonOption['header_col'];

   
	//Primary Menu 
	$primary_menu = NULL;
	if ( has_nav_menu( 'primary-menu' ) ) :

		$primary_menu = array(	
								'id'	=> 'menu-wrap',	
								'tag'   => 'section',
								'wrap'	=> $TheChameleonOption['primary_menu_wrap'],
								'parts'	=> array(
											  array(	
												 'id'	   => 'menu',
										         'tag'	   => 'section',
										         'class'   => '',
										         'part'	   => 'Menu',
										         'setting' => array('type' =>'horizontal', 'class' =>'primary-menu' )
										         ),
									 		 ), 
								  );

	endif;
	
	
	$TheChameleon->render_template(array(		
	
										//header
										array(	
											'id'	=> 'header',
											'tag'	=> 'header',
											'wrap'	=> 	$wrap,
											'parts'	=> array(							
															array(
														        'id'	  => 'header-content',	
														        'tag'	  => 'section',	
														        'class'	  =>  $col,
														        'part'	  => is_active_sidebar( $sidebar ) ? 'Widgets' : 'Header',
														        'setting' => array( 'sidebar' => $sidebar)
														        ),
															),
										 	),
											$primary_menu
										//main menu
										
									)
	
	 );
	
	?>

