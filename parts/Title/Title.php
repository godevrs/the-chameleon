<?php

namespace TheChameleon{

   /**
    * Archive part class   
    *
    * @author Goran Petrovic
    * @since 1.0
    *
    **/
	class Title extends Part{
		
		
		public $view 	 = 'title';
		public $template = 'title';
		public $path 	 = '/parts/Title/';		
		public $config ;

		function __construct( ){

			$this->config = Config::getInstance();

		}
	


	}
}