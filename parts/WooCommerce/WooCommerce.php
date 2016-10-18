<?php
namespace TheChameleon{


	class WooCommerce extends Part{
		

		public $view 	 = 'woocommerce';
		public $template = 'fullwidth';
		public $path 	 = 'parts/WooCommerce/';		
		public $config ;

		function __construct( ){

			$this->config = Config::getInstance();
		
		}

		
	}		
	
}
?>