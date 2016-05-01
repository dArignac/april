<i class="fa fa-comment" title="<?php _e( 'Comment icon', 'april' ); ?>"></i>
<?php
	if ( ! comments_open() && get_comments_number() < 1 ) :
		comments_number( __( 'Comments closed', 'april' ), __( 'One Comment', 'april' ), __( '% Comments', 'april' ) );
	else :
		echo '<a href="' . esc_url( get_comments_link() ) . '">';
		comments_number( __( 'Leave a Comment', 'april' ), __( 'One Comment', 'april' ), __( '% Comments', 'april' ) );
		echo '</a>';
	endif;
?>