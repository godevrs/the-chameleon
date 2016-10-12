<?php


/**
 * 	Widget part 
 *
 * @author Goran Petrovic
 * @since 1.0
 * @return html
 *
 **/

global $TheChameleon;

$sidebar = !empty( $TheChameleon->Widgets->data['sidebar'] ) ?  $TheChameleon->Widgets->data['sidebar'] : 'Page';

dynamic_sidebar( $sidebar ); ?>

