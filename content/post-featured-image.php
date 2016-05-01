<?php if ( has_post_thumbnail( $post->ID ) ): ?>
	<?php
	// FIXME currently there is no integrated way to use *_post_thumbnail to get the caption and alt separate, so go the attachment way
	$post_thumbnail_id = get_post_thumbnail_id( $post );
	$post_thumbnail_url = wp_get_attachment_image_url( $post_thumbnail_id, 'full');
	$post_thumbnail_values = get_posts(
		array(
			'p' => $post_thumbnail_id,
			'post_type' => 'attachment'
		)
	);
	$post_caption = $post_thumbnail_values[0]->post_excerpt;
	$post_alt = $post_thumbnail_values[0]->post_name;
	?>
	<div class="text-xs-center">
		<figure class="figure">
			<?php if ( ! is_singular() ): ?><a href="<?php echo esc_url( get_permalink() ); ?>"><?php endif; ?>
			<img src="<?php echo $post_thumbnail_url; ?>" class="figure-img img-fluid" alt="<?php echo $post_alt; ?>">
			<?php if ( ! is_singular() ): ?></a><?php endif; ?>
			<?php if ( $post_caption && is_singular() ): ?><figcaption class="figure-caption text-xs-right"><?php echo $post_caption; ?></figcaption><?php endif; ?>
		</figure>
	</div>
<?php endif; ?>