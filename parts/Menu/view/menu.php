<?php 	
	namespace TheChameleon; 

?>

<section class="standard-menu"><!--Menu Part-->

	<?php 

	global $TheChameleon;
	global $data;

	//horizontal-menu
	$container_class = ( $data['type'] == "horizontal" ) ? ' horizontal-menu' : ( ( $data['type'] == "vertical" ) ? 'vertical-menu' : ( ( ! empty( $data['type'] ) ) ? $data['type'] : 'horizontal-menu' ) );	
	$class 			 = ( ! empty( $data['class'] ) ) ? $data['class'] : 'primary-menu';	
	$menu_class      = ( ! empty( $data['menu_class'] ) ) ? $data['menu_class'] : 'menu';	
	$theme_location  = ( ! empty( $data['location'] ) ) ? $data['location'] : 'primary-menu' ;

	wp_nav_menu( array( 'container'  => 'nav', 'container_class' => $container_class.' '.$class, 'theme_location' => $theme_location, 'menu_class' => $menu_class, 'walker' => new TheChameleon_Walker_Nav_Menu), array() ); ?>
	
</section>
	
<section class="responsive-menu">
	
	<?php global  $locations;
    $menu_name = 'primary-menu';
 	$locations = get_nav_menu_locations();
	$locations['primary-menu'] = !empty($locations['primary-menu']) ? $locations['primary-menu'] : NULL;
    if ( !empty( $locations ) and ( $locations['primary-menu']!= '0' ) && isset( $locations[ $menu_name ] ) ) :
	
		
		$menu 		 = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items  = wp_get_nav_menu_items( $menu->term_id );
		$menu_list   = '<select class="menu-' . $menu_name . '" id="menu-' . $menu_name . '">';
		$current_url = get_current_uri();
	
		foreach ( (array) $menu_items as $key => $menu_item ) :

		    $title 		= $menu_item->title;
		    $url 	 	= $menu_item->url;
			$selected 	= ( $current_url ==  $url ) ? 'selected="selected"' :  NULL;		
			$has_parent = ( $menu_item->menu_item_parent > 0) ? '&#8212; ': NULL;	
		    $menu_list .= '<option value="'. $url .'" '. $selected .'>'. $has_parent . $title . '</option>';

		endforeach;
		
		$menu_list .= '</select>';

    endif;
		
	print ( ! empty( $menu_list ) ) ? $menu_list : ''; ?>	
</section><!--End Menu Part-->




