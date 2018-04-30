<?php
/**
 * Adjusts the navigation menu item arguments.
 * Adds an element for the collapsible navigation if there are child elements in navigation.
 * @param $args
 * @param $item
 * @param $depth
 * @return mixed
 */
function april_nav_menu_item_args( $args, $item, $depth ) {
	if ( $item->hasChildren ) {
		$toggler = esc_attr( $item->ID );
		$args->after = ' <span class="toggler"><span class="sr-only">toggle menu</span></span>';
	} else {
		$args->after = '';
	}
	return $args;
}
add_filter( 'nav_menu_item_args', 'april_nav_menu_item_args', 10, 3 );