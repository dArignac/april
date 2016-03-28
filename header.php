<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>

<body id="<?php print get_stylesheet(); ?>" <?php body_class(); ?>>
	<?php do_action( 'body_top' ); ?>
	<div class="container">

		<?php do_action( 'header_before' ); ?>
		<?php get_template_part( 'menu/primary' ); ?>
		<div class="row">
			<div class="col-sm-12">TODO WIDGETS</div>
		</div>
		<?php do_action( 'header_after' ); ?>

		<?php do_action( 'main_before' ); ?>
