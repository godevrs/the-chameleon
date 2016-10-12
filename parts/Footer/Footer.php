<?php

	namespace TheChameleon{

		
	class Footer extends Part{
		
		
		public $view 	 = 'footer';
		public $template = 'footer';
		public $path 	 = '/parts/Footer/';		
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
							'name'	  => 'footer_wrap',
							'type'	  => 'select',
							'title'	  => __('Wrap', 'the-chameleon'), 
							'desc'	  => __('Choice wrap.', 'the-chameleon'),
							'choices' => $this->config->wraps,
							'default' => 'normal',
						 );
								
				$fields[] = array(
							'name'	  => 'footer_col',
							'type'	   =>'select',
							'title'	  => __('Columns', 'the-chameleon'),
							'desc'	  => __('Choice number of columns for widgets in footer section.', 'the-chameleon'),
							'choices' => $this->config->columns,
							'default' => 'col-3',
						 );

						
				$fields[] = array(
							'name'	  => 'footer_animate',
							'type'	  => 'select',
							'title'	  => __('Animate', 'the-chameleon'),
							'desc' 	  => __('Choice animate effect for widgets.', 'the-chameleon'),
							'choices' => $this->config->animates,
							'default' => '',
						 );


				$fields[] = array(
							'name'	  => 'footer_duration',
							'type'	  => 'select',
							'title'	  => __('Duration', 'the-chameleon'),
							'desc' 	  => __('Choice duration for animate effect.', 'the-chameleon'),
							'choices' => $this->config->animate_durations,
							'default' => '',
						 );

				$fields[] = array(
							'name'	  => 'footer_delay',
							'type'	  => 'select',
							'title'	  => __('Delay', 'the-chameleon'),
							'desc' 	  => __('Choice delay for animate effect.', 'the-chameleon'),
							'choices' => $this->config->animate_delays,
							'default' => '',
						 );


				$this->customize = 
						array(
							$this->config->slug =>
										array(
											'title'	   => __('Theme Options', 'the-chameleon'),						
											'sections' => array(
															array(
																'title'	 	=> __('Footer', 'the-chameleon'), 
																'desc'	 	=> __('Use this options to set up footer.', 'the-chameleon'), 
																'priority'	=> 13,
																'fileds' 	=> $fields,
																  ), //section
																) //sections

											), //panel 

							);

					return $this->customize;

		}
	
	}	
	
	
}

?>