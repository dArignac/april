<!DOCTYPE html>
<?php
	$display_first_level_navigation = get_theme_mod( 'april_display_additional_first_level_navigation_on_desktop' );
	$logo_image =                     get_theme_mod( 'april_logo_image' );
	$custom_hamburger_image =         get_theme_mod( 'april_hamburger_image' );
?>

<html <?php language_attributes(); ?>>

<head>
	<title><?php bloginfo( 'name' ); ?><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>

<body id="<?php print get_stylesheet(); ?>" <?php body_class(); ?>>
	<div class="overflower">

		<?php do_action( 'body_top' ); ?>

		<div class="pos-f-t">
			<div class="container">
				<header class="row">
					<div class="col-sm-12">

						<?php do_action( 'header_before' ); ?>

						<div class="row topline">
							<div class="col-sm-10 col-xs-10 media">
								<?php if ( $logo_image ): ?>
									<div class="media-left">
										<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ;?>">
											<img class="media-object" src="<?php echo esc_url( $logo_image ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
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
								<button class="navbar-toggler pull-sm-right pull-xs-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
									<?php if ( $custom_hamburger_image ): ?>
										<img src="<?php echo esc_url( $custom_hamburger_image ); ?>" />
									<?php else: ?>
										<i class="fa fa-bars"></i>
									<?php endif; ?>
								</button>
							</div>
						</div>
						<?php get_template_part( 'menu/primary' ); ?>
						<?php do_action( 'header_after' ); ?>

					</div>

					<?php if ( $display_first_level_navigation ): ?>
						<div class="col-sm-12 first-level-addon">
							<?php get_template_part( 'menu/firstleveladdon' ); ?>
						</div>
					<?php endif; ?>
				</header>

				<?php get_sidebar( 'primary' ); ?>
			</div>
		</div>

		<div class="container">
			<?php do_action( 'main_before' ); ?>