<?php
/**
 * Adds the bootstrap navbar classes to a menu item.
 * @param $classes
 * @return array
 */
function april_nav_menu_css_class( $classes ) {
	$classes[] = 'nav-item';
	return $classes;
}
add_filter( 'nav_menu_css_class', 'april_nav_menu_css_class' );

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
		$args->after = ' <span data-toggle="collapse" data-target="#tgglr-' . $toggler . ' + ul.sub-menu" id="tgglr-' . $toggler . '">open/close</span>';
	} else {
		$args->after = '';
	}
	return $args;
}
add_filter( 'nav_menu_item_args', 'april_nav_menu_item_args', 10, 3 );