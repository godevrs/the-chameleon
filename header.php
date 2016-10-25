<?php
	global 	$TheChameleon;
	global 	$TheChameleonOption;
	$TheChameleon->Head->view();
	$TheChameleon->Upper->template('upper');	
	$TheChameleon->Header->template($TheChameleonOption['primary_menu_type']);  
	$TheChameleon->Top->template('top');
	
?>