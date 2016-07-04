<?php
	wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'depth'           => 1,
			'container'       => false,
			'container_class' => false,
			'menu_class'      => 'nav',
			'menu_id'         => 'menu-first-level',
			'items_wrap'      => '<ul id="%1$s" class="%2$s nav-inline" role="navigation">%3$s</ul>'
		)
	);