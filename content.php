<div <?php post_class('row'); ?>>
	<?php do_action( 'post_before' ); ?>
	<div class="col-sm-1"></div>
	<article class="col-sm-8">
		<!-- TODO incomplete -->
		<?php //the_title(); ?>
	</article>
	<div class="col-sm-1"></div>
	<?php do_action( 'post_after' ); ?>
</div>