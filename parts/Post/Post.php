<?php
namespace TheChameleon{

	/**
	 * 	Header  
	 *
	 * @author Goran Petrovic
	 * @since 1.0
	 *
	 **/

	class Post extends Part{
	
	
		public $view 	 = 'post';
		public $template = 'right-sidebar';
		public $path 	 = '/parts/Post/';		
		public $config ;

		function __construct( ){

			$this->config = Config::getInstance();

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
						'name'	  => 'post_template',
						'type'	  => 'select',
						'title'	  => __('Template', 'the-chameleon'),
						'desc'	  => __('Choice post template.', 'the-chameleon'),
						'choices' => 
						 	array(	
								 'fullwidth'		  	  => __('Full Width', 'the-chameleon'),
								 'left-sidebar'		  	  => __('Left Sidebar', 'the-chameleon'),
								 'right-sidebar'	  	  => __('Right Sidebar', 'the-chameleon'),
								 'double-sidebars'    	  => __('Double Sidebars', 'the-chameleon'),
								 'double-right-sidebars'  => __('Double Right Sidebars', 'the-chameleon'),
								 'double-left-sidebars'	  => __('Double Left Sidebars', 'the-chameleon'),
							 	),
						'default' => 'right-sidebar',
					 );
		
				$fields[] = array(
							'name'	  => 'post_meta_pattern',
							'type'	  => 'text',
							'title'	  => __('Meta Pattern', 'the-chameleon'),
							'desc'	  => __('Use %author%, %date%, %category% and  %comments% helpers to defile post meta view.', 'the-chameleon'),
							'default' => 'By %author% on %date% in %category% | %comments%',
						 );
			
			return $this->customize = 
					array(
						$this->config->slug =>
										array(
											'title'	   => __('Theme Options','the-chameleon'),						
											'sections' => array(
															array(
																'title'	 	=> __('Post','the-chameleon'),
																'desc'	 	=> __('Use this options for set up single post.','the-chameleon'),
																'priority'	=> 9,
																'fileds' 	=> $fields,
																),
															  )

										   ),
										);

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
											'post_types' => array('post'),
											'title'		 => __('Sidebars','the-chameleon'),
											'id'		 =>	'sidebars_post',
											'context'	 =>'side',
											'fields' 	 => array(
																array(
																	'type'	  => 'select',
																	'name'	  => 'sidebar_1',
																	'title'	  => __('Primary','the-chameleon'),
																	'default' => 'Post',
																	'desc'	  =>  __('This sidebar display for all templates whit one sidebar.','the-chameleon'),
																	'choices' => $this->config->sidebars,
																	'attr'	  => array('class'=>'')
																	),

																array(
																	'type'	  => 'select',
																	'name'	  => 'sidebar_2',
																	'title'	  => __('Secondary','the-chameleon'),
																	'desc'	  => __('This sidebar display only for templates whit two sidebars.','the-chameleon'),
																	'default' => 'Page',
																	'choices' => $this->config->sidebars,
																	'attr'	  => array('class'=>'', 'style'=>'')
																	),
																	
																array(
																	'type'	  => 'select',
																	'name'	  => 'sidebar_footer',
																	'title'	  => __('Footer','the-chameleon'),
																	'desc'	  => __('Post footer content','the-chameleon'),
																	'default' => 'Post Footer',
																	'choices' => $this->config->sidebars,
																	'attr'	  => array('class'=>'', 'style'=>'')
																	),
																)//fileds

											),//sidebars_post
												
										array(	
											'post_types' => array('post'),
											'title'		 => __('Featured Media','the-chameleon'),
											'id'		 =>	'featured_media',
											'context'	 =>'side',
											'fields' 	 => array(
																array(
																	'type'	  => 'text',
																	'name'	  => 'featured_media',
																	'title'	  => __('Featured media','the-chameleon'),
																	'default' => '',
																	'desc'	  => __( 'Add media link for video post format. ', 'the-chameleon' ).'<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank"><i>'.__( 'Okay, So What Sites Can I Embed From?', 'the-chameleon' ).'</i></a></p>',
																	'attr'	  => array('class'=>'', 'style'=>'width:100%', 'placeholder'=>__('Entry your media url', 'the-chameleon'))
																	),

																array(
																	'type'	  => 'text',
																	'name'	  => 'featured_audio',
																	'title'	  => __('Featured audio','the-chameleon'),
																	'desc'	  => __('Add link for audio post format in .mp3 format','the-chameleon'),
																	'default' => '',
																	'attr'	  => array('class'=>'', 'style'=>'width:100%',  'placeholder'=>__('Entry your audio url', 'the-chameleon'))
																	),
																)//fileds

											),//featured_media
											
											array(	
												'post_types' => array('post'),
												'title'		 => __('Post Format Options','the-chameleon'),
												'id'		 =>	'post_formats',
												'context'	 =>'side',
												'fields' 	 => array(
																	array(
																		'type'	  => 'text',
																		'name'	  => 'quote_author_name',
																		'title'	  => __('Quote author name','the-chameleon'),
																		'default' => '',
																		'desc'	  => __('Add author name for Quote post format.','the-chameleon'),
																		'attr'	  => array('class'=>'', 'style'=>'width:100%', 'placeholder'=>__('Entry author name', 'the-chameleon'))
																		),

																	array(
																		'type'	  => 'text',
																		'name'	  => 'link',
																		'title'	  => __('Link post format','the-chameleon'),
																		'desc'	  => __('Add link for Link post format.','the-chameleon'),
																		'default' => '',
																		'attr'	  => array('class'=>'', 'style'=>'width:100%',  'placeholder'=>__('Entry url', 'the-chameleon'))
																		),
																	)//fileds

												),//featured_media


											
											
										);

		}

	
		

		
		
	}	

		
		
	
}

?>