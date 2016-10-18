<?php

namespace TheChameleon{
	
	class Upper extends Part{
		
		
		public $view 	 = 'upper';
		public $template = 'upper';
		public $path 	 = '/parts/Upper/';		
		public $config ;

		function __construct( ){

			$this->config = Config::getInstance();

		}
		


		/**
		 * 	Add options in customize setting
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function customize(){
			
			
			$fields[] = array(
						'name'	  => 'upper_sticky',
						'type'	  => 'checkbox',
						'title'	  => __('Sticky', 'the-chameleon'), 
						'desc'	  => __('Enable sticky upper', 'the-chameleon'),					
						'default' => null,
					 );
					 
					 
			$fields[] = array(
						'name'	  => 'upper_wrap',
						'type'	  => 'select',
						'title'	  => __('Wrap', 'the-chameleon'), 
						'desc'	  => __('Choice wrap', 'the-chameleon'),
						'choices' => $this->config->wraps,
						'default' => 'normal',
					 );

			$fields[] = array(
						'name'	  => 'upper_col',
						'type'	  => 'select',
						'title'	  => __('Columns', 'the-chameleon'),
						'desc'	  => __('Choice number of columns for widgets in upper section.', 'the-chameleon'),
						'choices' => $this->config->columns,
						'default' => 'col-2',
					 );
					

			$fields[] = array(
						'name'	  => 'upper_animate',
						'type'	  => 'select',
						'title'	  => __('Animate', 'the-chameleon'),
						'desc' 	  => __('Choice animate effect for widgets.', 'the-chameleon'),
						'choices' => $this->config->animates,
						'default' => '',
					 );


			$fields[] = array(
						'name'	  => 'upper_duration',
						'type'	  => 'select',
						'title'	  => __('Duration', 'the-chameleon'),
						'desc' 	  => __('Choice duration for animate effect.', 'the-chameleon'),
						'choices' => $this->config->animate_durations,
						'default' => '',
					 );

			$fields[] = array(
						'name'	  => 'upper_delay',
						'type'	  => 'select',
						'title'	  => __('Delay', 'the-chameleon'),
						'desc' 	  => __('Choice delay for animate effect.', 'the-chameleon'),
						'choices' => $this->config->animate_delays,
						'default' => '',
					 );	


			return $this->customize = 
					array(
						$this->config->slug=>
									array(
										'title'	   => __('Theme Options', 'the-chameleon'), 					
										'sections' => array(
															array(
																'title'	 	=> __('Upper', 'the-chameleon'),
																'desc'	 	=> __('Use this options to set up the upper section.', 'the-chameleon'), 
																'priority'	=> 3,
																'fileds' 	=> $fields,
																), //section
															)//sections
								 	 ), //panel 
					  );
	
		}
		
	}
}
?>