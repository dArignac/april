<?php
	/**
	 * Menu wrapping for the first level navigation. That is the always visible one and NOT the collapsible nav.
	 */
	wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'depth'           => 1,
			'container'       => 'div',
			'container_class' => 'col-sm-12 first-level-addon',
			'menu_class'      => 'nav',
			'menu_id'         => 'menu-first-level',
			'items_wrap'      => '<ul id="%1$s" class="%2$s nav-inline" role="navigation">%3$s</ul>'
		)
	);