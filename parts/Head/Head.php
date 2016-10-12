<?php
	namespace TheChameleon{
	
	class Head extends Part{

		public $view 	 = 'head';
		public $template = 'head';
		public $path 	 = '/parts/Head/';		
		public $config ;

		function __construct( ){

			$this->config = Config::getInstance();

		}
	


}	

}
?>