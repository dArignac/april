<!DOCTYPE html>
<?php
	$display_first_level_navigation = get_theme_mod( 'april_display_additional_first_level_navigation_on_desktop' );
	$logo_image                     = get_theme_mod( 'april_logo_image' );
	$custom_hamburger_image         = get_theme_mod( 'april_hamburger_image' );
	$navMenuLocations               = get_nav_menu_locations();
	$menuPrimaryID                  = $navMenuLocations[ 'primary' ];
	$menuPrimary                    = wp_get_nav_menu_object( $menuPrimaryID );
	$hasMenuPrimaryEntries          = is_object( $menuPrimary ) && $menuPrimary->count > 0;
?>

<html <?php language_attributes(); ?>>

<head>
	<title><?php bloginfo( 'name' ); ?><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>

<body id="<?php print get_stylesheet(); ?>" <?php body_class( $hasMenuPrimaryEntries ? 'primary-with-entries' : 'primary-without-entries' ); ?>>
	<div class="overflower">

		<?php do_action( 'body_top' ); ?>

		<div class="fixed-top">
			<div class="container">
				<header class="row">
					<div class="col-sm-12">

						<?php do_action( 'header_before' ); ?>

						<div class="row topline">
							<div class="col-10 col-sm-10 media">
								<?php if ( $logo_image ): ?>
									<a href="<?php echo esc_url( home_url() ); ?>" class="logo-image" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ;?>">
										<img class="align-self-start mr-3" src="<?php echo esc_url( $logo_image ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
									</a>
								<?php endif; ?>
								<div class="media-body">
									<h1 class="mt-0 mb-1">
										<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ;?>">
											<?php echo get_bloginfo( 'name' ); ?>
										</a>
									</h1>
									<?php if ( get_bloginfo( 'description' ) ): ?><h2><?php echo get_bloginfo( 'description' ); ?></h2><?php endif; ?>
								</div>
							</div>
							<div class="col-2 col-sm-2">
								<?php if ( $hasMenuPrimaryEntries ): ?>
									<button class="navbar-toggler pull-sm-right float-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
										<?php if ( $custom_hamburger_image ): ?>
											<img src="<?php echo esc_url( $custom_hamburger_image ); ?>" />
										<?php else: ?>
											<i class="fa fa-bars"></i>
										<?php endif; ?>
									</button>
								<?php endif; ?>
							</div>
						</div>
						<?php get_template_part( 'menu/primary' ); ?>
						<?php do_action( 'header_after' ); ?>

					</div>

					<?php if ( $display_first_level_navigation ): ?>
						<?php get_template_part( 'menu/firstleveladdon' ); ?>
					<?php endif; ?>
				</header>

				<?php get_sidebar( 'primary' ); ?>
			</div>
		</div>

		<div class="container">
			<?php do_action( 'main_before' ); ?>