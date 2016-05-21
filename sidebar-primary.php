<?php if ( is_active_sidebar( 'primary' ) ) : ?>
	<aside id="widgets-primary" class="collapse">
		<?php dynamic_sidebar( 'primary' ); ?>
	</aside>
	<button id="widgets-primary-open" data-toggle="collapse" data-target="#widgets-primary" aria-expanded="false" aria-controls="widgets-primary">
		<span class="sr-only"><?php echo __( 'Open sidebar', 'april' ) ?></span>
		<i class="fa fa-plus"></i>
	</button>
<?php endif;