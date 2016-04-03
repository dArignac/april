<div <?php post_class('row'); ?>>
	<?php do_action( 'post_before' ); ?>

	<article class="col-sm-12">
		<?php the_title(); ?>
	</article>

	<?php do_action( 'post_after' ); ?>
</div>