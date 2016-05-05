<article <?php post_class(); ?>>
	<?php do_action( 'post_before' ); ?>

	<div class="row">

		<div class="col-sm-10 col-sm-offset-1">
			<h1 class="text-xs-center">
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
			</h1>
			<?php get_template_part( 'content/post-meta' ); ?>
		</div>

		<div class="col-sm-12">
			<?php get_template_part( 'content/post-featured-image' ); ?>
		</div>

		<div class="col-sm-10 col-sm-offset-1">
			<?php the_content(); ?>
			<?php wp_link_pages( array(
				'before' => '<p class="post-pagination">' . __( 'Pages:', 'april' ),
				'after'  => '</p>',
			) ); ?>
		</div>

		<?php do_action( 'post_after' ); ?>

		<?php get_template_part( 'content/post-categories' ); ?>
		<?php get_template_part( 'content/post-tags' ); ?>

	</div>
</article>