<?php
namespace TheChameleon{

	//Page Controller

	class Page extends Part{
		

		public $view 	 = 'page';
		public $template = 'fullwidth';
		public $path 	 = '/parts/Page/';		
		public $config ;

		function __construct( ){

			$this->config = Config::getInstance();
		
		}

		/**
		 * 	Post meta options 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function meta_boxes(){
					
			global $data;
				return $this->post_meta = 
									array(

										array(	
											'post_types' => array('page'),
											'title'		 => __('The Chameleon - Sidebars','the-chameleon'),
											'id'		 =>	'sidebars_page',
											'context'	 =>'side',
											'fields' 	 => array(
																array(
																	'type'	  => 'select',
																	'name'	  => 'sidebar_1',
																	'title'	  => __('Primary','the-chameleon'),
																	'default' => 'Page',
																	'desc'	  => __('This sidebar display for all templates whit one sidebar.','the-chameleon'),
																	'choices' => $this->config->sidebars,
																	'attr'	  => array('class'=>'')
																	),

																array(
																	'type'	  => 'select',
																	'name'	  => 'sidebar_2',
																	'title'	  => __('Secondary','the-chameleon'),
																	'desc'	  => __('This sidebar display only for templates whit two sidebars.','the-chameleon'),
																	'default' => 'Post',
																	'choices' => $this->config->sidebars,
																	'attr'	  => array('class'=>'', 'style'=>'')
																	),
																)//fileds
												
											),//box1

												array(	
													'post_types' => array('page'),
													'title'		 => __('Page Builder - The Chameleon','the-chameleon'),
													'id'		 => 'page_builder_main',
													'desc'		 => __('Use this Page builder to build layout for your page using the widgets. Create sidebars and select them in one of twenty sections and choice number of columns, aminate effect, dealy and duration for that section. Then go on Appearance >> Customize and add widgets in the sidebars.','the-chameleon'),
													'fields' 	 => array(

															//header
															array(
																'type'	  => 'page_builder',
																'name'	  => 'page_builder',
																'title'	  => '',
																'desc'	  => __('Choice wrap for Header section.','the-chameleon'),
																'default' => '',
																'choices' => $this->config->wraps,
																'attr'	  => array('class'=>'', 'style'=>'')
																),
																array( 'type' => 'none', 'name'	=> 'number_of_sections', 'default'=>'5'),
																array( 'type' => 'none', 'name'	=> 'active_page_builder', 'default'=>''),
														
																array( 'type' => 'none', 'name'	=> 'header_wrap'),
																array( 'type' => 'none', 'name' => 'header_sidebar'),
																array( 'type' => 'none', 'name'	=> 'header_col'),
																array( 'type' => 'none', 'name'	=> 'header_animate'),
																array( 'type' => 'none', 'name'	=> 'header_duration'),
																array( 'type' => 'none', 'name'	=> 'header_delay'),

																array( 'type' => 'none', 'name'	=> 'top_wrap'),
																array( 'type' => 'none', 'name' => 'top_sidebar'),
																array( 'type' => 'none', 'name'	=> 'top_col'),
																array( 'type' => 'none', 'name'	=> 'top_animate'),
																array( 'type' => 'none', 'name'	=> 'top_duration'),
																array( 'type' => 'none', 'name'	=> 'top_delay'),
																
																array( 'type' => 'none', 'name'	=> 'main_wrap'),

																array( 'type' => 'none', 'name'	=> 'section_1_wrap'),
																array( 'type' => 'none', 'name' => 'section_1_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_1_col'),
																array( 'type' => 'none', 'name'	=> 'section_1_class'),
																array( 'type' => 'none', 'name'	=> 'section_1_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_1_animate'),
																array( 'type' => 'none', 'name'	=> 'section_1_duration'),
																array( 'type' => 'none', 'name'	=> 'section_1_delay'),
																array( 'type' => 'none', 'name'	=> 'section_2_wrap'),
																array( 'type' => 'none', 'name' => 'section_2_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_2_col'),
																array( 'type' => 'none', 'name'	=> 'section_2_class'),
																array( 'type' => 'none', 'name'	=> 'section_2_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_2_animate'),
																array( 'type' => 'none', 'name'	=> 'section_2_duration'),
																array( 'type' => 'none', 'name'	=> 'section_2_delay'),
																array( 'type' => 'none', 'name'	=> 'section_3_wrap'),
																array( 'type' => 'none', 'name' => 'section_3_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_3_col'),
																array( 'type' => 'none', 'name'	=> 'section_3_class'),
																array( 'type' => 'none', 'name'	=> 'section_3_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_3_animate'),
																array( 'type' => 'none', 'name'	=> 'section_3_duration'),
																array( 'type' => 'none', 'name'	=> 'section_3_delay'),
																array( 'type' => 'none', 'name'	=> 'section_4_wrap'),
																array( 'type' => 'none', 'name' => 'section_4_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_4_col'),
																array( 'type' => 'none', 'name'	=> 'section_4_class'),
																array( 'type' => 'none', 'name'	=> 'section_4_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_4_animate'),
																array( 'type' => 'none', 'name'	=> 'section_4_duration'),
																array( 'type' => 'none', 'name'	=> 'section_4_delay'),
																array( 'type' => 'none', 'name'	=> 'section_5_wrap'),
																array( 'type' => 'none', 'name' => 'section_5_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_5_col'),
																array( 'type' => 'none', 'name'	=> 'section_5_class'),
																array( 'type' => 'none', 'name'	=> 'section_5_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_5_animate'),
																array( 'type' => 'none', 'name'	=> 'section_5_duration'),
																array( 'type' => 'none', 'name'	=> 'section_5_delay'),
																array( 'type' => 'none', 'name'	=> 'section_6_wrap'),
																array( 'type' => 'none', 'name' => 'section_6_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_6_col'),
																array( 'type' => 'none', 'name'	=> 'section_6_class'),
																array( 'type' => 'none', 'name'	=> 'section_6_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_6_animate'),
																array( 'type' => 'none', 'name'	=> 'section_6_duration'),
																array( 'type' => 'none', 'name'	=> 'section_6_delay'),
																array( 'type' => 'none', 'name'	=> 'section_7_wrap'),
																array( 'type' => 'none', 'name' => 'section_7_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_7_col'),
																array( 'type' => 'none', 'name'	=> 'section_7_class'),
																array( 'type' => 'none', 'name'	=> 'section_7_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_7_animate'),
																array( 'type' => 'none', 'name'	=> 'section_7_duration'),
																array( 'type' => 'none', 'name'	=> 'section_7_delay'),
																array( 'type' => 'none', 'name'	=> 'section_8_wrap'),
																array( 'type' => 'none', 'name' => 'section_8_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_8_col'),
																array( 'type' => 'none', 'name'	=> 'section_8_class'),
																array( 'type' => 'none', 'name'	=> 'section_8_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_8_animate'),
																array( 'type' => 'none', 'name'	=> 'section_8_duration'),
																array( 'type' => 'none', 'name'	=> 'section_8_delay'),
																array( 'type' => 'none', 'name'	=> 'section_9_wrap'),
																array( 'type' => 'none', 'name' => 'section_9_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_9_col'),
																array( 'type' => 'none', 'name'	=> 'section_9_class'),
																array( 'type' => 'none', 'name'	=> 'section_9_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_9_animate'),
																array( 'type' => 'none', 'name'	=> 'section_9_duration'),
																array( 'type' => 'none', 'name'	=> 'section_9_delay'),
																array( 'type' => 'none', 'name'	=> 'section_10_wrap'),
																array( 'type' => 'none', 'name' => 'section_10_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_10_col'),
																array( 'type' => 'none', 'name'	=> 'section_10_class'),
																array( 'type' => 'none', 'name'	=> 'section_10_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_10_animate'),
																array( 'type' => 'none', 'name'	=> 'section_10_duration'),
																array( 'type' => 'none', 'name'	=> 'section_10_delay'),
																array( 'type' => 'none', 'name'	=> 'section_11_wrap'),
																array( 'type' => 'none', 'name' => 'section_11_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_11_col'),
																array( 'type' => 'none', 'name'	=> 'section_11_class'),
																array( 'type' => 'none', 'name'	=> 'section_11_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_11_animate'),
																array( 'type' => 'none', 'name'	=> 'section_11_duration'),
																array( 'type' => 'none', 'name'	=> 'section_11_delay'),
																array( 'type' => 'none', 'name'	=> 'section_12_wrap'),
																array( 'type' => 'none', 'name' => 'section_12_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_12_col'),
																array( 'type' => 'none', 'name'	=> 'section_12_class'),
																array( 'type' => 'none', 'name'	=> 'section_12_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_12_animate'),
																array( 'type' => 'none', 'name'	=> 'section_12_duration'),
																array( 'type' => 'none', 'name'	=> 'section_12_delay'),
																array( 'type' => 'none', 'name'	=> 'section_13_wrap'),
																array( 'type' => 'none', 'name' => 'section_13_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_13_col'),
																array( 'type' => 'none', 'name'	=> 'section_13_class'),
																array( 'type' => 'none', 'name'	=> 'section_13_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_13_animate'),
																array( 'type' => 'none', 'name'	=> 'section_13_duration'),
																array( 'type' => 'none', 'name'	=> 'section_13_delay'),
																array( 'type' => 'none', 'name'	=> 'section_14_wrap'),
																array( 'type' => 'none', 'name' => 'section_14_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_14_col'),
																array( 'type' => 'none', 'name'	=> 'section_14_class'),
																array( 'type' => 'none', 'name'	=> 'section_14_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_14_animate'),
																array( 'type' => 'none', 'name'	=> 'section_14_duration'),
																array( 'type' => 'none', 'name'	=> 'section_14_delay'),
																array( 'type' => 'none', 'name'	=> 'section_15_wrap'),
																array( 'type' => 'none', 'name' => 'section_15_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_15_col'),
																array( 'type' => 'none', 'name'	=> 'section_15_class'),
																array( 'type' => 'none', 'name'	=> 'section_15_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_15_animate'),
																array( 'type' => 'none', 'name'	=> 'section_15_duration'),
																array( 'type' => 'none', 'name'	=> 'section_15_delay'),
																array( 'type' => 'none', 'name'	=> 'section_16_wrap'),
																array( 'type' => 'none', 'name' => 'section_16_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_16_col'),
																array( 'type' => 'none', 'name'	=> 'section_16_class'),
																array( 'type' => 'none', 'name'	=> 'section_16_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_16_animate'),
																array( 'type' => 'none', 'name'	=> 'section_16_duration'),
																array( 'type' => 'none', 'name'	=> 'section_16_delay'),
																array( 'type' => 'none', 'name'	=> 'section_17_wrap'),
																array( 'type' => 'none', 'name' => 'section_17_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_17_col'),
																array( 'type' => 'none', 'name'	=> 'section_17_class'),
																array( 'type' => 'none', 'name'	=> 'section_17_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_17_animate'),
																array( 'type' => 'none', 'name'	=> 'section_17_duration'),
																array( 'type' => 'none', 'name'	=> 'section_17_delay'),
																array( 'type' => 'none', 'name'	=> 'section_18_wrap'),
																array( 'type' => 'none', 'name' => 'section_18_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_18_col'),
																array( 'type' => 'none', 'name'	=> 'section_18_class'),
																array( 'type' => 'none', 'name'	=> 'section_18_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_18_animate'),
																array( 'type' => 'none', 'name'	=> 'section_18_duration'),
																array( 'type' => 'none', 'name'	=> 'section_18_delay'),
																array( 'type' => 'none', 'name'	=> 'section_19_wrap'),
																array( 'type' => 'none', 'name' => 'section_19_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_19_col'),
																array( 'type' => 'none', 'name'	=> 'section_19_class'),
																array( 'type' => 'none', 'name'	=> 'section_19_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_19_animate'),
																array( 'type' => 'none', 'name'	=> 'section_19_duration'),
																array( 'type' => 'none', 'name'	=> 'section_19_delay'),
																array( 'type' => 'none', 'name'	=> 'section_20_wrap'),
																array( 'type' => 'none', 'name' => 'section_20_sidebar'),
																array( 'type' => 'none', 'name'	=> 'section_20_col'),
																array( 'type' => 'none', 'name'	=> 'section_20_class'),
																array( 'type' => 'none', 'name'	=> 'section_20_custom_class'),
																array( 'type' => 'none', 'name'	=> 'section_20_animate'),
																array( 'type' => 'none', 'name'	=> 'section_20_duration'),
																array( 'type' => 'none', 'name'	=> 'section_20_delay'),
																
																array( 'type' => 'none', 'name'	=> 'bottom_wrap'),
																array( 'type' => 'none', 'name' => 'bottom_sidebar'),
																array( 'type' => 'none', 'name'	=> 'bottom_col'),
																array( 'type' => 'none', 'name'	=> 'bottom_animate'),
																array( 'type' => 'none', 'name'	=> 'bottom_duration'),
																array( 'type' => 'none', 'name'	=> 'bottom_delay'),
															),	
													),
									
											
												array(	
													'post_types' => array('page'),
													'title'		 => __('Custom CSS - The Chameleon','the-chameleon'),
													'id'		 => 'page_builder_10',
													'desc'		 => __('Use this option to enter custom css for this page.','the-chameleon'),
													'fields' 	 => array(
		
														//bottom
														array(
															'type'	  => 'textarea',
															'name'	  => 'custom_css',
															'title'	  => '',
															'desc'	  => __('Enter your custom css just for this page.','the-chameleon'),
															'default' => '',
															'attr'	  => array('class'=>'', 'style'=>'width:100%; height:250px;')
															),
													
											
													  )//fileds

								 				),//box2
								);

		}

		
}		
	
}
?>