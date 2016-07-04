<?php if ( is_active_sidebar( 'primary' ) ) : ?>
	<?php
		$custom_widgets_open_image =  get_theme_mod( 'april_widgets_open_image' );
		$custom_widgets_close_image = get_theme_mod( 'april_widgets_close_image' );
	?>
	<aside>
		<div id="widgets-primary" class="collapse"><?php dynamic_sidebar( 'primary' ); ?></div>
		<button id="widgets-primary-open" data-toggle="collapse" data-target="#widgets-primary" aria-expanded="false" aria-controls="widgets-primary">
			<span class="sr-only"><?php echo __( 'Open sidebar', 'april' ) ?></span>
			<?php if ( $custom_widgets_open_image && $custom_widgets_close_image ): ?>
				<img src="<?php echo esc_url( $custom_widgets_open_image ); ?>" alt="<?php _e( 'Open widgets', 'april' ); ?>" />
				<img src="<?php echo esc_url( $custom_widgets_close_image ); ?>" alt="<?php _e( 'Close widgets', 'april' ); ?>" class="hidden" />
			<?php else: ?>
				<i class="fa fa-plus"></i>
			<?php endif; ?>
		</button>
	</aside>
<?php endif;