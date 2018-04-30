<div class="row">
	<div class="col-sm-12">
		<div class="collapse" id="collapsingNavbar">
			<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container'       => false,
						'container_class' => false,
						'menu_class'      => 'nav flex-column',
						'menu_id'         => 'menu-primary',
						'walker'          => new April_Menu_Walker,
						'items_wrap'      => '<ul id="%1$s" class="%2$s" role="navigation">%3$s</ul>'
					)
				);
			?>
		</div>
	</div>
</div>