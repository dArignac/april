<section id="comments">
	<?php if ( have_comments() ) : ?>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<h6>
					<?php
					if ( 1 == get_comments_number() ) {
						printf( __( 'One response to %s', 'april' ),  '&#8220;' . get_the_title() . '&#8221;' );
					} else {
						printf(
							_n( '%1$s response to %2$s', '%1$s responses to %2$s', get_comments_number(), 'arpil' ),
							number_format_i18n( get_comments_number() ),
							'&#8220;' . get_the_title() . '&#8221;'
						);
					}
					?>
				</h6>
			</div>
		</div>

		<?php wp_list_comments( array( 'callback' => 'april_comments_callback' ) ); ?>

		<div class="row">
			<div class="col-sm-5 col-sm-offset-1 text-xs-left"><?php previous_comments_link( '&ltrif; ' . __( 'Newer comments', 'april' ) ) ?></div>
			<div class="col-sm-5 text-xs-right"><?php next_comments_link( __( 'Older comments', 'april' ) . ' &rtrif;' ) ?></div>
		</div>

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ( comments_open() ) : ?>
			<!-- If comments are open, but there are no comments. -->

		<?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<p class="nocomments"><?php _e( 'Comments are closed.', 'april' ); ?></p>
				</div>
			</div>

		<?php endif; ?>
	<?php endif; ?>

	<!-- TODO enable -->
	<?php //comment_form(); ?>
</section>