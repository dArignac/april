<article <?php post_class(); ?>>
	<?php do_action( 'archive_post_before' ); ?>

	<div class="row">

		<div class="col-sm-10 col-sm-offset-1">
			<h1 class="text-xs-center">
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
			</h1>
			<h2 class="text-xs-center the-date">
				<?php get_template_part( 'content/post-meta' ); ?>
			</h2>
		</div>

		<div class="col-sm-12">
			<?php get_template_part( 'content/post-featured-image' ); ?>
		</div>

		<div class="col-sm-10 col-sm-offset-1"><?php the_excerpt(); ?></div>

		<div class="comments col-sm-5 col-sm-offset-1 text-md-right col-xs-12 text-xs-center">
			<a class="post-continue-reading" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo __( 'Continue reading', 'april' ) ?></a>
		</div>
		<div class="comments col-sm-5 text-md-left col-xs-12 text-xs-center">
			<?php get_template_part( 'content/post-comments-link' ); ?>
		</div>
	</div>

	<?php do_action( 'archive_post_after' ); ?>
</article>