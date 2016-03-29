<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>

<body id="<?php print get_stylesheet(); ?>" <?php body_class(); ?>>
	<?php do_action( 'body_top' ); ?>
	<div class="container">
		<header>
			<?php do_action( 'header_before' ); ?>
			<div class="row top">
				<?php
					$cssHeadline = 'col-sm-10 col-xs-10';
				?>
				<?php if ( get_theme_mod( 'logo_upload' ) ): $cssHeadline = 'col-sm-9 hidden-xs-down'; ?>
					<div class="col-sm-1 col-xs-10">
						<img src="<?php echo esc_url( get_theme_mod( 'logo_upload' ) ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
					</div>
				<?php endif; ?>
				<div class="<?php echo $cssHeadline; ?>">
					<h1>
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ;?>">
							<?php echo get_bloginfo( 'name' ); ?>
						</a>
					</h1>
				</div>
				<div class="col-sm-2 col-xs-2">
					<button class="navbar-toggler pull-sm-right pull-xs-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">&#9776;</button>
				</div>
			</div>
			<?php get_template_part( 'menu/primary' ); ?>
			<div class="row">
				<div class="col-sm-12"><!-- TODO WIDGETS --></div>
			</div>
			<?php do_action( 'header_after' ); ?>
		</header>

		<?php do_action( 'main_before' ); ?>
