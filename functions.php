<?php
	
	namespace TheChameleon;	
	
	//PHP check
	if (!\is_admin() ):
		if (PHP_VERSION_ID < 50500) :
			echo "The Chameleon theme require min PHP 5.6";
			exit;
		endif;
	endif;
	
	include_once('framework/classes/class-config.php');
	
	global $config;
	
	$config 			= Config::getInstance();
	$config->name 		= 'The Chameleon';
	$config->slug 		= 'the_chameleon_';
	$config->namespace  = 'TheChameleon';
	$config->skins_dir  = 'the-chameleon-skins';
	$config->DIR  		= get_template_directory() ;
	$config->URL  		= get_template_directory_uri();

	//include helpers
	foreach (glob( $config->DIR.'/framework/helpers/*', GLOB_NOSORT ) as $dir_path) :
		include_once( $dir_path );
	endforeach;
	
	//incude classes
	foreach (glob( $config->DIR.'/framework/classes/*', GLOB_NOSORT ) as $dir_path) :
		include_once( $dir_path );
	endforeach;
	
	//include parts
	foreach (glob( $config->DIR.'/parts/*', GLOB_ONLYDIR ) as $dir_path) :
		$dir = explode('/', $dir_path);	
		$name =  end($dir);
		include_once( $dir_path.'/'.$name.'.php' );
	endforeach;
		
	//include widgets
	foreach (glob( $config->DIR.'/widgets/*', GLOB_ONLYDIR ) as $dir_path) :
		$dir = explode('/', $dir_path);	
		$name =  end($dir);
		include_once( $dir_path.'/'.$name.'.php' );
	endforeach;


	include_once('framework/class-bootstrap.php');

	global $TheChameleon;	
	global $TheChameleonOption;			
	$TheChameleon = new Bootstrap(); 
	
/*

	echo '<pre>';
 	for ($i=6; $i <=20 ; $i++) { 

	 echo "'section_{$i}_animate'		=> !empty( $TheChameleonMeta['section_{$i}_animate'] ) 	? $TheChameleonMeta['section_{$i}_animate'] 	: 'fadeIn',
		'section_{$i}_duration'	=> !empty( $TheChameleonMeta['section_{$i}_duration'] ) 	? $TheChameleonMeta['section_{$i}_duration'] 	: 'animated07',
		'section_{$i}_delay'		=> !empty( $TheChameleonMeta['section_{$i}_delay'] ) 		? $TheChameleonMeta['section_{$i}_delay'] 		: 'delay03',
	";

	}*/

	


	

?>