<?php

	namespace TheChameleon;
	
	/**
	 * Parent Part  
	 *
	 * This calss extends all parts classes in part directory
	 *
	 *
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @package     WordPress 
	 * @subpackage  GoX
	 * @since 		GoX 1.0.0
	 *
	 * @version 	1.0.0
	 *
	 *
	 **/
	class Part{
		
		 public $template = '';
		 public $view 	  = '';
		 public $path 	  = '';
	     public $config   = '';
		
		function __construct(){
	
			$this->config = Config::getInstance();
			
		}
			
		/**
		 * 	Get template file 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		public function template($template = null, $path = null){
						
			$this->template 	= isset( $template ) ? $template : $this->template;
		    $this->path 		= isset( $path ) ? $path : $this->path;

			get_template_part( $this->path . 'template/' . $this->template );

		}

		/**
		 * 	Get view file 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		public 	function view($view = null, $path = null){
			
			$this->view 	= isset( $view ) ? $view : $this->view;
		    $this->path 	= isset( $path ) ? $path : $this->path; 

			get_template_part(  $this->path . 'view/' . $this->view );

		}

		
		
	}

?>