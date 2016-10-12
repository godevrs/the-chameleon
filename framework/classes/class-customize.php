<?php


	namespace TheChameleon;
	

 	use WP_Customize_Image_Control;
	use User_Select_Custom_Control;


	/**
	 * 	Customize Option Builder 
	 *
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @package     WordPress
	 * @subpackage  Gox
	 * @since 		Gox  1.0.0
	 *
	 * @version 	1.0.0
	 *
	 *
	 **/
	 class Customize{
		
		public $parts;
		public $slug;
		
		
		function __construct( $parts ){

			$this->parts = $parts;
			
			$config = Config::getInstance();
			$this->slug = $config->slug ;
		
   	    	//set Customize options form all parts who have customize_options method
   	    	$this->set_customize_options();

      			global $TheChameleonOption;
   				//get all Customize theme options
	   	    	$this->get_customize_options_value();
	   	    	add_action('init', array($this,'get_customize_options_value') );
	   	   		add_action('wp', array(&$this,'get_customize_options_value') );

   	    	//register Customize 
   	    	add_action('customize_register', array(&$this, 'register_customize_options'));
   	
	    
		}
	
	

		/**
		 * 	Set customize options array from all parts 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/	
		function set_customize_options(){

			foreach ($this->parts as $key => $part) :
				if( method_exists($part, 'customize') ) :
					$this->customize[ $key ] = $part->customize();
				endif;
			endforeach;

		}


		/**
		 * 	Render customize options from parts arrays 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 * @var $wp_customize 
		 *
		 **/
		 function register_customize_options($wp_customize){


			foreach ($this->parts as $key => $part) {

				//part options
				if ( !empty( $this->customize[ $key ] ) ) :

					foreach ($this->customize[ $key ] as $key => $panel) {	
						//add panel
						self::add_panel($wp_customize, $panel['title'] );

							foreach ($panel['sections']  as $key => $section) {
								
								//default values
								$priority = !empty( $section['priority'] ) 	? $section['priority']  : 10; 
								$title 	  = !empty( $section['title'] ) 	? $section['title'] 	: '';	
								$desc 	  = !empty( $section['desc'] ) 		? $section['desc'] 		: '';

								//add section
								self::add_section($wp_customize,  $this->slug.$section['title'], $section['title'], $desc, $panel['title'], $priority);	

									foreach ($section['fileds']  as $key => $filed) {
										
										//default values
										$type 	   = !empty( $filed['type'] ) 		? $filed['type'] 	  : 'text';				
										$default   = !empty( $filed['default'] ) 	? $filed['default']   : '';					
										$title 	   = !empty( $filed['title'] ) 		? $filed['title'] 	  : '';	
										$desc 	   = !empty( $filed['desc'] ) 		? $filed['desc'] 	  : '';	
										$choices   = !empty( $filed['choices'] ) 	? $filed['choices']   : array();
										$transport = !empty( $filed['transport'] ) 	? $filed['transport'] : 'refresh';  //postMessage 

										//add filed	
										if ( method_exists('TheChameleon\Customize', $type) ):		
											self::{$type}($wp_customize, $this->slug.'options', $this->slug.$section['title'], $filed['name'], $default, $title, $desc, $transport, $choices );
										endif;
									}
							}

					}
				endif;
				# code...
			}

		}


		/**
		 * 	Set options from all parts 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function get_customize_options_value(){

			global $TheChameleonOption;

			//Parts
			foreach ($this->parts as $key => $part) :
					//part options
					if ( !empty( $this->customize[ $key ] ) ) :
						//panels
						foreach ($this->customize[ $key ]  as $panel_key => $panel) :
								//sections
								foreach ($panel['sections']  as $section_key => $section) :
										$key 		   = self::sanitize_name( $section['title'] );			
									 	$option        = get_option( strtolower($this->slug).'options', '');
									/*	$this->options = get_option( Plugin::$slug.'options', '');	*/		
									//fields					
									foreach ($section['fileds']  as $filed_key => $filed) :
										$name 	 					 = self::sanitize_name( $filed['name'] ); 				
										$TheChameleonOption[ $name ] =  isset( $option[ $name ] ) ? $option[ $name ]  : (  isset( $filed['default'] ) ? $filed['default']  : '' );
										$this->option[ $name ] 		 = !empty( $option[ $name ] ) ? $option[ $name ]  : ( !empty( $filed['default'] ) ? $filed['default']  : '' );
									endforeach;	

								endforeach;
							endforeach;			
					endif;					
				endforeach;

		/*
			if ( isset( $this->option ) )
		 			return $this->option;*/
		

		}


	
		/**
		 * 	Add Customize Panel
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var obj $wp_customize -  WP Object
		 * @var str $title - Panel Title in Customize view
		 * @var str $description - Panel Description in Customize view
		 * @var int $priority - Position order in customize view
		 * @var str $capability - edit_theme_options 
		 * @var str $theme_supports 
		 *
		 * @return void
		 **/
		static function add_panel($wp_customize, $title = "Theme Options", $description = "", $priority = 10, $capability = "edit_theme_options", $theme_supports = '')
		{

			$wp_customize->add_panel( 
				self::sanitize_name( $title ), 
				array(
			   	 	'priority'       => 10,
				    'capability'     => $capability, 
				    'theme_supports' => $theme_supports,
				    'title'          => $title,
				    'description'    => $description,
				) 
			);

		}
		
		/**
		 * 	Add Section in Customize Panel
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var obj $wp_customize -  WP Object
		 * @var str $id - Section ID must be unique
		 * @var str $title - Section Title in Customize view
		 * @var str $description - Section Description in Customize view
		 * @var str $panel - Panel ID, parent 
		 * @var ing $priority - Position order in customize view
		 *
		 * @return void
		 **/
		 static function add_section($wp_customize, $id = "setting", $title = "Setting", $description = '', $panel = 'Theme Options', $priority = 10)
		{

		   $wp_customize->add_section(
				self::sanitize_name( $id ), 
				array(
		     	  'title'    	=> $title,
			      'priority' 	=> $priority,
				  'description'	=> $description,
				  'panel'  		=> self::sanitize_name( $panel ),
		   		));

		}


		/**
		 * 	Add Text filed in Customize Section
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var obj $wp_customize -  WP Object
		 * @var str $panel - Panel ID, parent panel 
		 * @var str $section - Section ID, parent section
		 * @var str $name - Filed name, must be uniqu whit - or _ filed_name
		 * @var str $default - Default value 
		 * @var str $title - Label title in view 
		 * @var str $desc - Filed description in view
		 * @var str $transport - refresh, postMessage
		 *
		 * @return void
		 **/
		 static function text($wp_customize, $panel = "Theme Options", $section = "Setting", $name = 'text', $default = '', $title = '', $desc = '', $transport = 'refresh' )
		 {

			$wp_customize->add_setting(
				self::sanitize_name( $panel ).'['.$name.']', 
				array(
		 		   'default'        	   => $default ,
			       'capability'     	   => 'edit_theme_options',
			       'type'           	   => 'option',
				   'transport'   		   => $transport, //refresh , postMessage
				   'sanitize_callback' 	   => 'esc_attr',
				   'sanitize_js_callback'  => 'esc_js'
			   	   ));


			$wp_customize->add_control( 
				$name, 
				array(
		   		 	'label'   	  => $title,
				    'section' 	  => self::sanitize_name( $section ),
				    'settings'    => self::sanitize_name( $panel ).'['.$name.']',
				    'type'        => 'text',
					'description' => $desc,	
					));


		 }
	
	
	
		/**
		 * 	Add Image filed in Customize Section
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var obj $wp_customize -  WP Object
		 * @var str $panel - Panel ID, parent panel and get_option( panel name ) 
		 * @var str $section - Section ID, parent section
		 * @var str $name - Filed name, must be uniqu whit - or _ filed_name
		 * @var str $default - Default value 
		 * @var str $title - Label title in view 
		 * @var str $desc - Filed description in view
		 * @var str $transport - refresh, postMessage
		 *
		 * @return void
		 **/
		static function image($wp_customize, $panel = "Theme Options", $section = "Setting", $name = 'image', $default = NULL, $title = 'My Label', $desc = 'Desc', $transport = 'refresh' )
		{
			
			
			$wp_customize->add_setting(
		  		self::sanitize_name( $panel ).'['.$name.']', 
		  		array(
		      	   'default'        	   => $default ,
		  	       'capability'     	   => 'edit_theme_options',
		  	       'type'           	   => 'option',
		  		   'transport'   		   => $transport,
		  		   'sanitize_callback' 	   => 'esc_url',
		  		   'sanitize_js_callback'  => 'esc_js'
		  	   	   ));


		  	$wp_customize->add_control( new WP_Customize_Image_Control( 	
		  		$wp_customize, 
		  		$name,  
		  		array(
					'label'   	  => $title,
		  		    'section' 	  => self::sanitize_name( $section ),
		  		    'settings'    => self::sanitize_name( $panel ).'['.$name.']',
		  		    'type'        => 'image',
					'description' => $desc,	
		  			)));
		
		} 
	
		/**
		 * 	Add Texarea filed in Customize Section
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var obj $wp_customize -  WP Object
		 * @var str $panel - Panel ID, parent panel and get_option( panel name ) 
		 * @var str $section - Section ID, parent section
		 * @var str $name - Filed name, must be uniqu whit - or _ filed_name
		 * @var str $default - Default value 
		 * @var str $title - Label title in view 
		 * @var str $desc - Filed description in view
		 * @var str $transport - refresh, postMessage
		 *
		 * @return void
		 **/
		static function textarea($wp_customize, $panel = "Theme Options", $section = "Setting", $name = 'image', $default = NULL, $title = '', $desc = '', $transport = 'refresh' )
		{
				
				$wp_customize->add_setting(
					self::sanitize_name( $panel ).'['.$name.']', 
					array(
			 		   'default'        	   => $default ,
				       'capability'     	   => 'edit_theme_options',
				       'type'           	   => 'option',
					   'transport'   		   => $transport, //refresh , postMessage
					   'sanitize_callback' 	   => 'esc_textarea',
					   'sanitize_js_callback'  => 'esc_js'
				   	   ));


				$wp_customize->add_control( 
					$name, 
					array(
			   		 	'label'   	  => $title,
					    'section' 	  => self::sanitize_name( $section ),
					    'settings'    => self::sanitize_name( $panel ).'['.$name.']',
					    'type'        => 'textarea',
						'description' => $desc,	
						));
	
		}
	
		/**
		 * 	Add Checkbox filed in Customize Section
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var obj $wp_customize -  WP Object
		 * @var str $panel - Panel ID, parent panel and get_option( panel name ) 
		 * @var str $section - Section ID, parent section
		 * @var str $name - Filed name, must be uniqu whit - or _ filed_name
		 * @var str $default - Default value 
		 * @var str $title - Label title in view 
		 * @var str $desc - Filed description in view
		 * @var str $transport - refresh, postMessage
		 *
		 * @return void
		 **/
		static function checkbox($wp_customize,  $panel = "Theme Options", $section = "Setting", $name = 'image', $default = NULL, $title = '', $desc = '', $transport = 'refresh' )
		{
			
			
			$wp_customize->add_setting(
				self::sanitize_name( $panel ).'['.$name.']', 
				array(
				   'default'        	   => $default ,
			       'capability'     	   => 'edit_theme_options',
			       'type'           	   => 'option',
				   'transport'   		   => $transport, //refresh , postMessage
				   'sanitize_callback' 	   => 'esc_attr',
				   'sanitize_js_callback'  => 'esc_js'
			   	   ));

			$wp_customize->add_control( 
				$name, 
				array(
				 	'label'   	  => $title,
				    'section' 	  => self::sanitize_name( $section ),
				    'settings'    => self::sanitize_name( $panel ).'['.$name.']',
				    'type'        => 'checkbox',
					'description' => $desc,
					'std'         => '1',	
					));
			
			
			
		}
		
		/**
		 * 	Add Select box filed in Customize Section
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var obj $wp_customize -  WP Object
		 * @var str $panel - Panel ID, parent panel and get_option( panel name ) 
		 * @var str $section - Section ID, parent section
		 * @var str $name - Filed name, must be uniqu whit - or _ filed_name
		 * @var str $default - Default value 
		 * @var str $title - Label title in view 
		 * @var str $desc - Filed description in view
		 * @var str $transport - refresh, postMessage
		 *
		 * @return void
		 **/
		static function select($wp_customize, $panel = "Theme Options",  $section = "Setting", $name = 'image', $default = NULL, $title = '', $desc = '', $transport = 'refresh', $choices = array() )
		{

		
		    $wp_customize->add_setting(
				self::sanitize_name( $panel ).'['.$name.']', 
				array(
		     	   'default'        	  => $default ,
			       'capability'     	  => 'edit_theme_options',
			       'type'           	  => 'option',
				   'transport'   		  => $transport, //postMessage,refresh
				   'sanitize_callback' 	  => 'esc_attr',
				   'sanitize_js_callback' => 'esc_js'
		   		)
			);

		   $wp_customize->add_control( 
				$name,  
				array(
		      	   'label'   	  => $title,
				   'description'  => $desc,
				   'section' 	  => self::sanitize_name( $section ),
			   	   'settings'     => self::sanitize_name( $panel ).'['.$name.']',	
			       'type'    	  => 'select',
			       'choices' 	  => $choices,
		   		)
			);
			
		}
		
		
	
		/**
		 * 	Sanitize filed name   
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return string
		 **/
		static function sanitize_name( $name ){

			return str_replace('-', '_', sanitize_title( $name ) );

		}
		
	}
?>