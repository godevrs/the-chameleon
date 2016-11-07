<?php
namespace TheChameleon;

	
	class Menu extends Part{
		
	public $view 	 = 'menu';
	public $template = 'menu';
	public $path 	 = '/parts/Menu/';		
	public $config ;

	function __construct( ){

		$this->config = Config::getInstance();
		add_action( 'init', array(&$this, 'register_menus'));
	}
	

	/**
	 * 	Register theme menus	
	 *
	 * @author Goran Petrovic
	 * @since 1.0
	 *
	 **/	
	function register_menus() {
		register_nav_menus(
			array(
				'primary-menu' 	=> __( 'Primary Menu', 'the-chameleon' ),	
			)
		);
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
					'name'	  => 'primary_menu_sticky',
					'type'	  => 'checkbox',
					'title'	  => __('Sticky', 'the-chameleon'), 
					'desc'	  => __('Enable sticky Primary menu', 'the-chameleon'),					
					'default' => null,
				 );
				 
		$fields[] = array(
					'name'	  => 'primary_menu_wrap',
					'type'	  => 'select',
					'title'	  => __('Wrap', 'the-chameleon'), 
					'desc'	  => __('Choice wrap only for Type: The menu below the header.', 'the-chameleon'),
					'choices' => $this->config->wraps,
					'default' => 'normal',
				 );

	/*
		$fields[] = array(
						'name'	  => 'primary_menu_type',
						'type'	  => 'select',
						'title'	  => __('Type', 'the-chameleon'),  
						'desc'	  => __('Choice type of the primary menu.', 'the-chameleon'), 
						'choices' => array(
							        		'header'	=> __( 'The menu below the header', 'the-chameleon'),
							        		'header-c'	=> __( 'Without the menu', 'the-chameleon'),
									         ),
						'default' => 'header',
					 );*/
	


		return $this->customize = 
					array(				
						$this->config->slug =>
								array(
									'title'	   => __('Theme Options', 'the-chameleon'),  						
									'sections' => array(
														array(
															'title'	 	=> __('Primary Menu', 'the-chameleon'), 
															'desc'	  	=> __('Use this options to set up the primary menu.', 'the-chameleon'),   
															'priority'	=> 5,
															'fileds' 	=> $fields,
															), //section
														)//sections
									),//panel 

						);

	}
		
				
}		

 




?>