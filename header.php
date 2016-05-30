<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<title><?php bloginfo( 'name' ); ?><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>

<body id="<?php print get_stylesheet(); ?>" <?php body_class(); ?>>
	<div class="overflower">
		<div class="container">

			<?php do_action( 'body_top' ); ?>
			<header class="row">
				<div class="col-sm-12">

					<?php do_action( 'header_before' ); ?>

					<div class="row topline">
						<div class="col-sm-10 col-xs-10 media">
							<?php if ( get_theme_mod( 'logo_upload' ) ): ?>
								<div class="media-left">
									<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ;?>">
										<img class="media-object" src="<?php echo esc_url( get_theme_mod( 'logo_upload' ) ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
									</a>
								</div>
							<?php endif; ?>
							<div class="media-body hidden-xs-down">
								<h1 class="media-heading">
									<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ;?>">
										<?php echo get_bloginfo( 'name' ); ?>
									</a>
								</h1>
								<?php if ( get_bloginfo( 'description' ) ): ?><h2><?php echo get_bloginfo( 'description' ); ?></h2><?php endif; ?>
							</div>
						</div>
						<div class="col-sm-2 col-xs-2">
							<button class="navbar-toggler pull-sm-right pull-xs-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar"><i class="fa fa-bars"></i></button>
						</div>
					</div>
					<?php get_template_part( 'menu/primary' ); ?>
					<?php do_action( 'header_after' ); ?>

				</div>
			</header>

			<?php get_sidebar( 'primary' ); ?>

			<?php do_action( 'main_before' ); ?>
