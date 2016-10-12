<?php

	namespace TheChameleon;
		
	/**
	 * Skins   
	 *
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
 	class Skins{
	
		var $skins = array();
		var	$skins_dir = 'the-chameleon-skins';
		
		function __construct(){
			
			
			$config = Config::getInstance();
			
			$config->skins = $this->set_skins();
		}
	
	
		function set_skins(){
			
			$config = Config::getInstance();
			
			$data = array();
			
			//include widgets
			foreach (glob( WP_CONTENT_DIR.'/'.$this->skins_dir.'/*', GLOB_ONLYDIR ) as $dir_path) :
				$dir 	= explode('/', $dir_path);	
				$name 	= end($dir);

				if(file_exists(WP_CONTENT_DIR.'/'.$this->skins_dir.'/'.$name.'/info.json') ) :
				
					$file[ $name ] = wp_remote_get(WP_CONTENT_URL.'/'.$this->skins_dir.'/'.$name.'/info.json');
						
					$data[ $name ] = json_decode( $file[ $name ]['body'] ) ;
					
				endif;
				
			endforeach;
			
			 $skins = $data;
			
			return $skins;
			
		}
	
	
	
	}