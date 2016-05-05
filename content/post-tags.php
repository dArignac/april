<?php
//$tags   = get_the_tags( $post->ID );
//$output = '';
//if ( $tags ) {
//	echo '<div class="post-tags">';
//		echo '<span>' . __( "Tagged in", "founder" ) . '</span>';
//		echo '<ul>';
//			foreach ( $tags as $tag ) {
//				echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts tagged %s", 'founder' ), $tag->name ) ) . '">' . $tag->name . '</a></li>';
//			}
//		echo '</ul>';
//	echo '</div>';
//}
?>

<?php if ( $tags   = get_the_tags( $post->ID ) ): ?>
	<div class="col-sm-10 col-sm-offset-1 post-tags">
		<?php echo __( 'Tagged in:', 'april' ); ?>
		<?php foreach ( $tags as $tag ): ?>
			<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts with tag "%s"', 'april' ), $tag->name ) ) ?>"><?php echo $tag->name; ?></a>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
