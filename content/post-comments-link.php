<?php
	if ( ! comments_open() && get_comments_number() < 1 ) :
		echo '<a class="post-comment-count" href="#">';
		comments_number( __( 'Comments closed', 'april' ), __( 'One Comment', 'april' ), __( '% Comments', 'april' ) );
		echo '</a>';
	else :
		echo '<a class="post-comment-count" href="' . esc_url( get_comments_link() ) . '">';
		comments_number( __( 'Leave a Comment', 'april' ), __( 'One Comment', 'april' ), __( '% Comments', 'april' ) );
		echo '</a>';
	endif;