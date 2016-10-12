<?php

namespace TheChameleon{

	/**
	 * 	Widgets 
	 *
	 * @author Goran Petrovic
	 * @since 1.0
	 *
	 **/
	class Widgets extends Part{
	
	
		
		public $view 	 = 'widgets';
		public $template = 'widgets';
		public $path 	 = '/parts/Widgets/';		
		public $config ;
		public $data = array();
		function __construct( ){

			$this->config = Config::getInstance();

		}

	
		
		/**
		 * 	set data 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function set_data($data){
			
			return $this->data = $data;
			
		}
		

}
		
}

?>