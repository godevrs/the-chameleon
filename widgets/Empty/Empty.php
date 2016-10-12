<?php

	/**
	 * 	Empty Widget 
	 *
	 * Empty Widget widout content and title, user for push widgets in columns
	 *
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @package     WordPress
	 * @subpackage  The Chameleon
	 * @since 		The Chameleon 3.0.6
	 *
	 * @version 	1.0.0
	 *
	 *
	 **/	
	class TheChameleon_Empty_Widget extends WP_Widget {

		function __construct() {
			$widget_ops = array( 'classname' => 'empty_widget', 'description' => __( "Use this widget to make space between widgets.", 'the-chameleon' ) );
			parent::__construct('TheChameleon_Empty_Widget', __('Empty - The Chameleon', 'the-chameleon'), $widget_ops);
		}

		function widget( $args, $instance ) {
			extract( $args );		
					
			$title = apply_filters('widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base);
			
			echo $before_widget;

				if ( $title )

			echo $before_title . $title . $after_title; 

				echo '&nbsp;';

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
		
			$instance = $new_instance;		

			return $instance;
		}
	

		function form( $instance ) { 
		
			echo '<br/>';
		
		}

	}