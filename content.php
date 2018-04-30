<article <?php post_class(); ?>>
	<?php do_action( 'post_before' ); ?>

	<?php
		$display_post_categories = get_theme_mod( 'april_display_post_categories' );
		$display_post_tags       = get_theme_mod( 'april_display_post_tags' );
		$display_page_titles     = get_theme_mod( 'april_display_page_titles' );
	?>

	<div class="row">

		<div class="col-sm-10 offset-sm-1">
			<?php if ( is_singular( 'post' ) || ( is_page() && $display_page_titles ) ) : ?>
				<h1 class="text-center">
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
				</h1>
			<?php endif; ?>
			<?php if ( ! is_page() ) : ?>
				<h2 class="text-center the-date">
					<?php get_template_part( 'content/post-meta' ); ?>
				</h2>
			<?php endif; ?>
		</div>

		<div class="col-sm-12">
			<?php get_template_part( 'content/post-featured-image' ); ?>
		</div>

		<div class="col-sm-10 offset-sm-1">
			<?php the_content(); ?>
			<?php wp_link_pages(
				array(
					'before' => '<nav class="navigation pagination post-navigation" role="navigation"><span class="title">' . __( 'Pages:', 'april' ) . '</span>',
					'after'  => '</nav>'
				)
			); ?>
		</div>

		<?php do_action( 'post_after' ); ?>

		<?php if ( $display_post_categories ): ?>
			<?php get_template_part( 'content/post-categories' ); ?>
		<?php endif; ?>
		<?php if ( $display_post_tags ): ?>
			<?php get_template_part( 'content/post-tags' ); ?>
		<?php endif; ?>

	</div>
</article>

<?php comments_template(); ?>