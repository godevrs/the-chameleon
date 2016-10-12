<?php


 	namespace TheChameleon;

    /**
      * Register Menu 
      * 
      * @author     Goran Petrovic <goran.petrovic@godev.rs>
      * @package    WordPress
      * @subpackage GoX
      * @since 	 GoX 1.0.0
      *
      * @version 1.0.0
      *
      */

/*
 	class Menu_Helper{
	
	
		function __construct( $parts ){

			$this->parts = $parts;
		

		}
	
	

	
	
	
	}*/

	
	
	use Walker_Nav_Menu;
	use stdClass;

	/**
	 * Cutom Walker_Nav_Menu
	 *
	 * @author Goran Petrovic
	 * @since 1.0
	 *
	 * @return void
	 **/
	class TheChameleon_Walker_Nav_Menu extends Walker_Nav_Menu {
  

	 	function display_element ( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output )
		    {
		        // check, whether there are children for the given ID and append it to the element with a (new) ID
		        $element->hasChildren = isset( $children_elements[ $element->ID ]) && !empty( $children_elements[ $element->ID ]);

		        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		    }


		// add classes to ul sub-menus
		function start_lvl( &$output, $depth = 0, $args = array() ) {
		    // depth dependent classes
		    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
		    $classes = array(
		        'sub-menu',
		        ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
		        ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
		        'menu-depth-' . $display_depth
		        );
		    $class_names = implode( ' ', $classes );
  

		    // build html
		    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
		}
  
		// add main/sub classes to li's and links
		 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		    global $wp_query;
		    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
  
		    // depth dependent classes
		    $depth_classes = array(
		        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
		        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
		        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
		        'menu-item-depth-' . $depth
		    );
		    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
  
		    // passed classes
		    $classes 	 = empty( $item->classes ) ? array() : (array) $item->classes;
		    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
   
		    // build html
		    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
  
		    // link attributes
		    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
  

			global $TheChameleon_options;
				
			//more links icon
			if( $depth==0 ) :
			  	$hasChildrenIcon = ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['menu_has_children'] ) ) ? $TheChameleon_options['menu_has_children']  : NULL;
			else:
				$hasChildrenIcon = ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['menu_sub_has_children'] ) ) ? '<span class="has_children">' . $TheChameleon_options['menu_sub_has_children'] . '</span>' : NULL;
			endif;

			(object)$args = new stdClass();

			$args->before 		= ( !empty( $args->before ) ) ? $args->before : NULL;	
			$args->link_before 	= ( !empty( $args->link_before ) ) ? $args->link_before : NULL;	
			$args->link_after 	= ( !empty( $args->link_after ) ) ? $args->link_after : NULL;				
			$args->after 		= ( !empty( $args->after ) ) ? $args->after : NULL;	


 		

		    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%7$s %8$s</a>%6$s',
		        $args->before,
		        $attributes,
		        $args->link_before,
		        apply_filters( 'the_title', $item->title, $item->ID ),
		        $args->link_after,
		        $args->after, 
				( $item->hasChildren == TRUE ) ? '&nbsp;'. $hasChildrenIcon : NULL,
				(!empty($item->description) and $depth == 0) ? '<p>'.$item->description.'</p>' : NULL
		    );
  
		    // build html
		    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
		

	}
	

	

?>