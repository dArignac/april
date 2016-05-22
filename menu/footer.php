<?php
	wp_nav_menu(
		array(
			'theme_location'  => 'footer',
			'container'       => false,
			'container_class' => false,
			'menu_class'      => 'nav',
			'menu_id'         => 'menu-footer',
			'items_wrap'      => '<ul id="%1$s" class="%2$s nav-inline text-xs-center" role="navigation">%3$s</ul>'
		)
	);
?>