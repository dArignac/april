<div class="row">
	<div class="col-sm-12">
		<nav class="navbar">
			<div class="navbar-brand">TODO LOGO and NAME</div>
			<button class="navbar-toggler pull-sm-right" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">&#9776;</button>
		</nav>
		<div class="collapse" id="exCollapsingNavbar">
			<div class="">
				<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container'       => false,
							'container_class' => false,
							'menu_class'      => 'nav',
							'menu_id'         => 'menu-primary',
							// TODO remove if not necessary - https://github.com/dArignac/april/issues/5
							'walker'          => new April_Menu_Walker
//							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
						)
					);
				?>
			</div>
		</div>
	</div>
</div>