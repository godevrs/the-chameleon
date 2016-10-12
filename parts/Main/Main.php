<?php

	namespace TheChameleon{

   /**
    * Archive part class   
    *
    * @author Goran Petrovic
    * @since 1.0
    *
    **/
	class Main extends Part{

		public $view 	 = 'main';
		public $template = 'main';
		public $path 	 = '/parts/Main/';		
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
						'name'	  => 'main_wrap',
						'type'	  => 'select',
						'title'	  => __('Wrap', 'the-chameleon'), 
						'desc'	  => __('Choice wrap', 'the-chameleon'),
						'choices' =>  $this->config->wraps,			
						'default' => 'normal',
					 );

			return $this->customize = 
					array(
						$this->config->slug =>
									array(
										'title'	   =>  __('Theme Options', 'the-chameleon'),  					
										'sections' => array(
														array(
															'title'	 	=>  __('Main', 'the-chameleon'), 
															'desc'	  	=> __('Use this option to set up main content.', 'the-chameleon'), 
															'priority'	=> 7,
															'fileds' 	=> $fields,
															), //Section
														)//sections

									),//panel  - Front Page

						);

		}

	}
}
?>