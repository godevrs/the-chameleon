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
	class Archive extends Part{

		public $view 	 = 'archive';
		public $template = 'right-sidebar';
		public $path 	 = '/parts/Archive/';		
		public $config ;

		function __construct( ){
	
			$this->config = Config::getInstance();

		}

		
		/**
		 * 	Set customize options 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function customize(){
		
		
			$fields[] = array(
						'name'	  => 'archive_template',
						'type'	  => 'select',
						'title'	  => __('Template', 'the-chameleon'),
						'desc'	  => __('Choice template', 'the-chameleon'),
						'choices' =>  array(	
											 'fullwidth'		  	  => __('Full Width', 'the-chameleon'),
											 'left-sidebar'		  	  => __('Left Sidebar', 'the-chameleon'),
											 'right-sidebar'	  	  => __('Right Sidebar', 'the-chameleon'),
											 'double-sidebars' 		  => __('Double Sidebars', 'the-chameleon'),
											 'double-right-sidebars'  => __('Double Right Sidebars', 'the-chameleon'),
											 'double-left-sidebars'	  => __('Double Left Sidebars', 'the-chameleon'),
										 ),
						'default' => 'right-sidebar',
					 );


			$fields[] = array(
						'name'	  => 'archive_col',
						'type'	  => 'select',
						'title'	  => __('Columns', 'the-chameleon'),
						'desc' 	  => __('Choice number of columns for the template.', 'the-chameleon'),
						'choices' => $this->config->columns,
						'default' => 'col-1',
					 );
		
 			$fields[] = array(
 						'name'	  => 'archive_meta',
 						'type'	  => 'text',
 						'title'	  => __('Meta Pattern', 'the-chameleon'),
						'desc'	  => __('The Meta is an option to define how to display meta appearance details with help of patterns. The available options are %author%, %date%, %category%, %comments% or to enter off and unplug meta completely. Example Example ( By %author% on %date% in %category% | %comments% ).', 'the-chameleon'),
 						'default' => 'By %author% on %date% in %category% | %comments%',
 					 );


		
					
			$fields[] = array(
						'name'	  => 'archive_animate',
						'type'	  => 'select',
						'title'	  => __('Animate', 'the-chameleon'),
						'desc' 	  => __('Choice animate effect for post in loop.', 'the-chameleon'),
						'choices' => $this->config->animates,
						'default' => '',
					 );


			$fields[] = array(
						'name'	  => 'archive_duration',
						'type'	  => 'select',
						'title'	  => __('Duration', 'the-chameleon'),
						'desc' 	  => __('Choice duration for animate effect.', 'the-chameleon'),
						'choices' => $this->config->animate_durations,
						'default' => '',
					 );
						
			$fields[] = array(
						'name'	  => 'archive_delay',
						'type'	  => 'select',
						'title'	  => __('Delay', 'the-chameleon'),
						'desc' 	  => __('Choice delay for animate effect.', 'the-chameleon'),
						'choices' => $this->config->animate_delays,
						'default' => '',
					 );


					
			return $this->customize = array(
				
				$this->config->slug =>
										array(
											'title'	   => __('Theme Options', 'the-chameleon'),						
											'sections' => array(
															array(
																'title'	 	=> __('Blog', 'the-chameleon'),
																'desc'		=> __('Use this options to set up default archive and blog section.', 'the-chameleon'),
																'priority'	=> 8,
																'fileds' 	=> $fields,
																), 
															   ) //sections

										     ), //panel
										  );


		}
		

		
		/**
		 * 	Set term options for categories and tags
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function term_meta(){


		
				$fields[] = array(
							'name'	  => 'main_wrap',
							'type'	  => 'select',
							'title'	  => __('Wrap', 'the-chameleon'), 
							'choices' => 
								array(
									''		 		 => __( 'Default', 'the-chameleon' ) , 
									'normal'		 => __( 'Normal', 'the-chameleon' ) , 
									'stretch'		 => __( 'Stretch', 'the-chameleon' ) , 
									'fullwidth' 	 => __( 'Fullwidth', 'the-chameleon' )
									),
							'default' => '',
						 );
			
				$fields[] = array(
							'name'	  => 'template',
							'type'	  => 'select',
							'title'	  => __('Template','the-chameleon'),
							'choices' =>  array(	
												 ''						  => __('Default', 'the-chameleon'),
												 'fullwidth'		      => __('Full Width', 'the-chameleon'),
												 'left-sidebar'		  	  => __('Left Sidebar', 'the-chameleon'),
												 'right-sidebar'	  	  => __('Right Sidebar', 'the-chameleon'),
												 'double-sidebars' 		  => __('Double Sidebars', 'the-chameleon'),
												 'double-right-sidebars'  => __('Double Right Sidebars', 'the-chameleon'),
												 'double-left-sidebars'	  => __('Double Left Sidebars', 'the-chameleon'),
											 ),
							'default' => 'right-sidebar',
							'desc'	  => __('The Template is possibility the term page show on a wide range of ways.', 'the-chameleon')
						 );

				$fields[] = array(
							'name'	  => 'columns',
							'type'	  => 'select',
							'title'	  => __('Columns','the-chameleon'), 
							'choices' => $this->config->columns,
							'default' => 'col-1',
							'desc'	  => __('The Layout is possibility that show posts in multiple columns.', 'the-chameleon')
						 );


				$fields[] = array(
							'name'	  => 'posts_per_page',
							'type'	  => 'text',
							'title'	  => __('Posts Per Page','the-chameleon'), 
							'default' => '',
							'desc'	  =>__('Number of posts that will be shown in this term.', 'the-chameleon'),
							'attr'	 => array('type'=>'number', 'style'=>'width:50px;')
						 );

	
				$fields[] = array(
							'name'	  => 'sidebar_1',
							'type'	  => 'select',
							'title'	  => __('Sidebar Primary','the-chameleon'), 
							'choices' => $this->config->sidebars,
							'default' => 'Page',
						 );	


				$fields[] = array(
							'name'	  => 'sidebar_2',
							'type'	  => 'select',
							'title'	  => __('Sidebar Secondary','the-chameleon'),  
							'choices' => $this->config->sidebars,
							'default' => 'Post',
							'desc'	  => __('The Sidebars is possibility to choose different sidebars for left and right side.', 'the-chameleon')
						 );	

											
				$fields[] = array(
							'name'	  => 'post_title',
							'type'	  => 'select',
							'title'	  => __('Post Title','the-chameleon'),  
							'choices' =>array(	
												'full'		=> __('Full Title','the-chameleon'),
												'hide'		=> __('Hide','the-chameleon'),						
												'20'		=> "20",										
												'25'		=> "25",
												'30'		=> "30",	
												'35'		=> "35",	
												'40'		=> "40",
												'45'		=> "45",		
												'50'		=> "50",
												'55'		=> "55",
												'60'		=> "60",
												'65'		=> "65",
												'70'		=> "70",
												'75'		=> "75",
												'80'		=> "80",
												'85'		=> "85",
												'90'		=> "90",
												'95'		=> "95",
												'100'		=> "100",
												'120'		=> "120",
												'140'		=> "140",
												'160'		=> "160",
												'180'		=> "180",
												'210'		=> "210"
												),
							'default' => 'full',
							'desc'	  => __('The Title is possibility to reduce the title of articles. Usually can be used when you choose layout in two or more columns to align more posts.', 'the-chameleon')
						 );	

			

					$fields[] = array(
								'name'	  => 'post_meta',
								'type'	  => 'text',
								'title'	  => __('Post Meta Pattern','the-chameleon'), 
								'default' => 'By %author% on %date% in %category% | %comments%',
								'desc'	  => __('The Meta is an option to define how to display meta appearance details with help of patterns. The available options are %author%, %date%, %category%, %comments% or to enter off and unplug meta completely. Example Example ( By %author% on %date% in %category% | %comments% ).', 'the-chameleon'),
							 	'attr'	  => array('style'=>'width:100%'), 
							);	


      				$fields[] = array(
							'name'	  => 'post_content',
							'type'	  => 'select',
							'title'	  => __('Post Content','the-chameleon'), 
							'choices' => array(	
												'excerpt' 		=> __('Excerpt','the-chameleon'),	
												'content'		=> __('Content','the-chameleon'),
												'hide'			=> __('Hide','the-chameleon'),
												'80'			=> "80",
												'100'			=> "100",
												'120'			=> "120",
												'140'			=> "140",	
												'160'			=> "160",
												'180'			=> "180",
												'200'			=> "200",
												'220'			=> "220",
												'240'			=> "240",
												'280'			=> "280",
												'300'			=> "300",
												'320'			=> "320",
												'340'			=> "340",
												'360'			=> "360",
												'380'			=> "380",
												'420'			=> "420"
												),
							'default' => 'excerpt',
							'desc'	  => __('The Text is possibility to short or extend text that appears in posts as a brief description or to display it in entirety.', 'the-chameleon')
						 );	



			
			return $this->term_options = array(
				
											'term_type'	=> array('category', 'post_tag', 'portfolios'),						
											'fileds' 	=>  $fields,

										);//panel  - Front Page
					
				
				
	
			
			
			
			
			
			
		}
		
		

		
		
	
	
}

}
?>