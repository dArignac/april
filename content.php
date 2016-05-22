<article <?php post_class(); ?>>
	<?php do_action( 'post_before' ); ?>

	<div class="row">

		<div class="col-sm-10 col-sm-offset-1">
			<h1>
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
			</h1>
			<h2>
				<?php get_template_part( 'content/post-meta' ); ?>
			</h2>
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

		<?php
		$display_post_categories = get_theme_mod( 'display_post_categories' );
		$display_post_tags       = get_theme_mod( 'display_post_tags' );
		?>
		<?php if ( $display_post_categories ): ?>
			<?php get_template_part( 'content/post-categories' ); ?>
		<?php endif; ?>
		<?php if ( $display_post_tags ): ?>
			<?php get_template_part( 'content/post-tags' ); ?>
		<?php endif; ?>

	</div>
</article>

<?php comments_template(); ?>