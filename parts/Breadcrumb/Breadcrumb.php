<?php
namespace TheChameleon{
	use TheChameleon;

   /**
    * Archive part class   
    *
    * @author Goran Petrovic
    * @since 1.0
    *
    **/
	class Breadcrumb extends Part{


		public $view 	 = 'breadcrumb';
		public $template = 'breadcrumb';
		public $path 	 = '/parts/Breadcrumb/';		
		public $config ;

		function __construct( ){

			$this->config = Config::getInstance();

		}
		

	}
}
?>