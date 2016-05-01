<div <?php post_class('row'); ?>>
	<?php do_action( 'post_before' ); ?>

	<article class="col-sm-12">
		<h1 class="text-xs-center">
			<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
		</h1>
		<?php get_template_part( 'content/post-meta' ); ?>
		<?php get_template_part( 'content/featured-image' ); ?>
	</article>

	<?php do_action( 'post_after' ); ?>
</div>