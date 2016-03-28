<div class="row">
	<div class="col-sm-12">
		<nav class="navbar">
			<div class="navbar-brand">TODO LOGO and NAME</div>
			<button class="navbar-toggler pull-sm-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">&#9776;</button>
		</nav>
		<div class="collapse" id="collapsingNavbar">
			<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container'       => false,
						'container_class' => false,
						'menu_class'      => 'nav',
						'menu_id'         => 'menu-primary',
						'walker'          => new April_Menu_Walker,
						'items_wrap'      => '<ul id="%1$s" class="%2$s" role="navigation">%3$s</ul>'
					)
				);
			?>
		</div>
	</div>
</div>