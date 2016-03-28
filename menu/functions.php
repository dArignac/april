<?php
/**
 * Adds the bootstrap navbar classes to a menu item.
 * @param $classes
 * @param $item
 * @param $args
 * @param $depth
 * @return array
 */
function april_nav_menu_css_class($classes, $item, $args, $depth ) {
	$classes[] = 'nav-item';
	return $classes;
}
add_filter( 'nav_menu_css_class', 'april_nav_menu_css_class');