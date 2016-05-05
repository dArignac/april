<?php if ( $categories = get_the_category( $post->ID ) ): ?>
	<div class="col-sm-10 col-sm-offset-1 post-categories">
		<?php echo __( 'Published in:', 'april' ); ?>
		<?php foreach ( $categories as $category ): ?>
			<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts in %s', 'april' ), $category->name ) ) ?>"><?php echo $category->cat_name; ?></a>
		<?php endforeach; ?>
	</div>
<?php endif; ?>