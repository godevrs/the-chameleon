<?php
namespace TheChameleon{
	use TheChameleon;
		/**
	 * 	Header  
	 *
	 * @author Goran Petrovic
	 * @since 1.0
	 *
	 **/

	class Skin extends Part{
	
	
		public $view 	 = 'skins';
		public $template = 'skins';
		public $path 	 = '/parts/Skins/';		
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
			
		$config = Config::getInstance();
					
		
		$choices = array( \get_template_directory_uri().'/css/skins/chameleon-themes/style.css'=>'The Chameleon' );
				
		if (  $config->skins ):
			
			foreach ( $config->skins as $key => $value) :
					
				$url = WP_CONTENT_URL.'/'.$this->config->skins_dir.'/'.$value->slug.'/style.css';	
					
					$choices[ $url ] =  $value->name;
					
					if (!empty( $value->sub ) ) :
						
							foreach ( $value->sub  as  $sub) :
								
									$url = WP_CONTENT_URL.'/'.$this->config->skins_dir.'/'.$value->slug.'/style-'.$sub->slug.'.css';
							
									$choices[ $url ] =  '- '.$value->name .' '.$sub->name;
						
							endforeach;
						
					endif;
					
					
				
				
			endforeach;

		endif;	

			
			
			$fields[] = array(
						'name'	  => 'skin',
						'type'	  => 'select',
						'title'	  => __('Skin', 'the-chameleon'),  
						'desc'	  => __('Choice skin for your The Chameleon.', 'the-chameleon'),  
						'choices' => $choices,
						'default' => \get_template_directory_uri().'/css/skins/chameleon-themes/style.css',
					 );

		
			return $this->customize = 
						array(
							$this->config->slug =>
									array(
										'title'	   => __('Theme Options', 'the-chameleon'),   					
										'sections' => array(
															array(
																'title'	 	=> __('Skin', 'the-chameleon'),  
																'desc'	 	=> __('On one click you can change design of The Chamelon theme. For more designs check our site', 'the-chameleon') .' <a href="http://www.chameleonthemes.net" target="_blank">The Chameleon</a>.',  
																'priority'	=> 1,
																'fileds' 	=> $fields,
																), //section
															)//sections
											),//panel  

								);
	
		}
		
	}
		

}

?>