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
	




