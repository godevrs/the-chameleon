<?php
	namespace TheChameleon{

	/**
	 * 	Custom  
	 *
	 * @author Goran Petrovic
	 * @since 1.0
	 *
	 **/

	class Custom extends Part{
	
	
		public $view 	 = 'custom';
		public $template = 'custom';
		public $path 	 = '/parts/Custom/';		
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
						'name'	  => 'custom_css',
						'type'	  => 'textarea',
						'title'	  => __('CSS', 'the-chameleon'),  
						'desc'	  => __('Enter your custom css code.', 'the-chameleon'),  
						'default' => 'body{}',
					 );
	
			return $this->customize = 
					array(		
						$this->config->slug =>
									array(
										'title'	   => __('Theme Options', 'the-chameleon'),  					
										'sections' => array(
														array(
															'title'	 	=> __('Custom CSS', 'the-chameleon'),
															'desc'		=> __('Code added here will not be replaced after theme updates.', 'the-chameleon'),	
															'priority'	=> 2,
															'fileds' 	=> $fields,
															), //section
														)//sections
											),//panel 
						);

		}
		
		
	}		
	
}
?>