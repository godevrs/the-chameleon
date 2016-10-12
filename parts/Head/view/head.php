<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<title><?php wp_title('&raquo;',true, 'right');?> </title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />	
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php
	//WP head
	wp_head();
	
?>
</head>
<body <?php body_class('hidden'); ?> itemscope itemtype="http://schema.org/WebPage">