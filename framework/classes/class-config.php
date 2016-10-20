<?php


	namespace TheChameleon;
	
	/**
	 * Theme Confing  
	 *
	 * globla variables for theme
	 *
	 *
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @link 		http://wwww.godev.rs
	 * @package     WordPress
	 * @subpackage  GoX 
	 * @since 		GoX 1.0.0
	 *
	 * @version 	1.0.0
	 *
	 **/
	class Config{
	
		private static $_instance = null;
		
		public $values;

	   	private function __construct(){
		
			$this->set_columns();
			$this->set_wraps();		
			$this->set_animations();
			$this->set_animation_duration();
			$this->set_animation_delay();	
			$this->set_page_builder_classes();

		}
			
		//getInstance
	    public static function getInstance(){
	        if (self::$_instance == null) {
	            self::$_instance = new self;
	        }

	        return self::$_instance;
	    }
		
		//Getters
	    function __get($key){
	        return $this->values[$key];
	    }

	    //Setters   
	    function __set($key, $value){
	        $this->values[$key]=$value;
	    }
	
	
	
		
		function set_columns(){


			return $this->values['columns'] = 
					array(
	  		 			'col-1' 	  	 => __( '1 Column', 'the-chameleon' ),
						'col-2' 	  	 => __( '2 Columns', 'the-chameleon' ),
						'col-2-30x70' 	 => __( '2 Columns 30x70%', 'the-chameleon' ),
						'col-2-70x30' 	 => __( '2 Columns 70x30%', 'the-chameleon' ),
						'col-3'		  	 => __( '3 Columns', 'the-chameleon' ),
						'col-3-60x25x15' => __( '3 Columns 60x25x15%', 'the-chameleon' ),
						'col-3-15x25x60' => __( '3 Columns 15x25x60%', 'the-chameleon' ),
						'col-4'		  	 => __( '4 Columns', 'the-chameleon' ),
						'col-5'		  	 => __( '5 Columns', 'the-chameleon' ),
						'col-6'		  	 => __( '6 Columns', 'the-chameleon' )

	   					); 


		}
	
		/*
			SET wrap options
		*/
		function set_wraps(){


			return $this->values['wraps'] = 
					array(
	  		 			''				 => __( 'Wrap', 'the-chameleon' ) , 
						'normal'		 => __( 'Box', 'the-chameleon' ) , 
						'stretch'		 => __( 'Stretch', 'the-chameleon' ) , 
						'fullwidth' 	 => __( 'Fullwidth', 'the-chameleon' )
	   					); 


		}
		
		/*
			SET animate options
		*/
		function set_animations(){


			return $this->values['animates'] = 
					array(
						''			=> __( 'Animate', 'the-chameleon' ), 
						 "bounce"=>"bounce",
				         "flash"=>"flash",
				         "pulse"=>"pulse",
				         "rubberBand"=>"rubberBand",
				         "shake"=>"shake",
				         "swing"=>"swing",
				         "tada"=>"tada",
				         "wobble"=>"wobble",
				         "jello"=>"jello",
				         "bounceIn"			=>"bounceIn",
				         "bounceInDown"		=>"bounceInDown",
				         "bounceInLeft"		=>"bounceInLeft",
				         "bounceInRight"	=>"bounceInRight",
				         "bounceInUp"		=>"bounceInUp",
				         "bounceOut"		=>"bounceOut",
				         "bounceOutDown"	=>"bounceOutDown",
				         "bounceOutLeft"	=>"bounceOutLeft",
				         "bounceOutRight"	=>"bounceOutRight",
				         "bounceOutUp"		=>"bounceOutUp",
				         "fadeIn"			=>"fadeIn",
				         "fadeInDown"		=>"fadeInDown",
				         "fadeInDownBig"	=>"fadeInDownBig",
				         "fadeInLeft"		=>"fadeInLeft",
				         "fadeInLeftBig"	=>"fadeInLeftBig",
				         "fadeInRight"		=>"fadeInRight",
				         "fadeInRightBig"	=>"fadeInRightBig",
				         "fadeInUp"			=>"fadeInUp",
				         "fadeInUpBig"		=>"fadeInUpBig",
				         "fadeOut"			=>"fadeOut",
				         "fadeOutDown"		=>"fadeOutDown",
				         "fadeOutDownBig"	=>"fadeOutDownBig",
				         "fadeOutLeft"		=>"fadeOutLeft",
				         "fadeOutLeftBig"	=>"fadeOutLeftBig",
				         "fadeOutRight"		=>"fadeOutRight",
				         "fadeOutRightBig"	=>"fadeOutRightBig",
				         "fadeOutUp"		=>"fadeOutUp",
				         "fadeOutUpBig"		=>"fadeOutUpBig",
				         "flip"=>"flip",
				         "flipInX"=>"flipInX",
				         "flipInY"=>"flipInY",
				         "flipOutX"=>"flipOutX",
				         "flipOutY"=>"flipOutY",
				         "lightSpeedIn"=>"lightSpeedIn",
				         "lightSpeedOut"=>"lightSpeedOut",
				         "rotateIn"=>"rotateIn",
				         "rotateInDownLeft"=>"rotateInDownLeft",
				         "rotateInDownRight"=>"rotateInDownRight",
				         "rotateInUpLeft"=>"rotateInUpLeft",
				         "rotateInUpRight"=>"rotateInUpRight",
				         "rotateOut"=>"rotateOut",
				         "rotateOutDownLeft"=>"rotateOutDownLeft",
				         "rotateOutDownRight"=>"rotateOutDownRight",
				         "rotateOutUpLeft"=>"rotateOutUpLeft",
				         "rotateOutUpRight"=>"rotateOutUpRight",
				         "slideInUp"=>"slideInUp",
				         "slideInDown"=>"slideInDown",
				         "slideInLeft"=>"slideInLeft",
				         "slideInRight"=>"slideInRight",
				         "slideOutUp"=>"slideOutUp",
				         "slideOutDown"=>"slideOutDown",
				         "slideOutLeft"=>"slideOutLeft",
				         "slideOutRight"=>"slideOutRight",
				         "zoomIn"=>"zoomIn",
				         "zoomInDown"=>"zoomInDown",
				         "zoomInLeft"=>"zoomInLeft",
				         "zoomInRight"=>"zoomInRight",
				         "zoomInUp"=>"zoomInUp",
				         "zoomOut"=>"zoomOut",
				         "zoomOutDown"=>"zoomOutDown",
				         "zoomOutLeft"=>"zoomOutLeft",
				         "zoomOutRight"=>"zoomOutRight",
				         "zoomOutUp"=>"zoomOutUp",
				         "hinge"=>"hinge",
				         "rollIn"=>"rollIn",
				         "rollOut"=>"rollOut",
	   					); 


		}
		
		/*
			SET animation duration options
		*/
		function set_animation_duration(){
			
			return $this->values['animate_durations'] = 
					array(
						''			 => __( 'Duration', 'the-chameleon' ), 
						'animated07' =>'0.7 secund',
						'animated08' =>'0.8 secund',
						'animated09' =>'0.9 secund',
						'animated1'	 =>'1 secund',
						'animated11' =>'1.1 secund',
						'animated15' =>'1.5 secund',
						'animated20' =>'2 secund',
						'animated22' =>'2.2 secund'
					);
		
		}
	
		/*
			SET animation delay options
		*/
		function set_animation_delay(){
			
			return $this->values['animate_delays'] = 
					array(
						''		  	=> __( 'Delay', 'the-chameleon' ), 
						'delay01' 	=> '0.1 secund',
						'delay02' 	=> '0.2 secund',
						'delay03' 	=> '0.3 secund',
						'delay04' 	=> '0.4 secund',
						'delay05' 	=> '0.5 secund',
						'delay06' 	=> '0.6 secund',
						'delay07'	=> '0.7 secund',
						'delay08' 	=> '0.8 secund',
						'delay09' 	=> '0.9 secund',
						'delay1'  	=> '1 secund',
						'delay1.2'  => '1.2 secund',
						'delay1.3'  => '1.3 secund',
						'delay1.4'  => '1.4 secund',
						'delay1.5'  => '1.5 secund',

						'delay2'  	=> '2 secunds',
						'delay2.2'  => '2.2 secunds',
						'delay2.5'  => '2.5 secunds',
						'delay3'  	=> '3 secunds',
						'delay3.5'  => '3.5 secund',
						'delay5'  	=> '5 secund',
						'delay7'  	=> '7 secund',

					);
	
		}



		/*
			SET page_builder_classes options
		*/
		function set_page_builder_classes(){

			return $this->values['page_builder_classes'] = 
					array(
						'page-builder-section-1' 	=> 'Light',
						'page-builder-section-2' 	=> 'Dark',
					

					);

		}
	
	
	}
	


?>