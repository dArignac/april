<section id="comments">
	<?php if ( have_comments() ) : ?>
		<div class="row">
			<div class="col-sm-10 offset-sm-1">
				<h6>
					<?php
					if ( 1 == get_comments_number() ) {
						printf( __( 'One response to %s', 'april' ),  '&#8220;' . get_the_title() . '&#8221;' );
					} else {
						printf(
							_n( '%1$s response to %2$s', '%1$s responses to %2$s', get_comments_number(), 'april' ),
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
			<div class="col-sm-5 offset-sm-1 text-left"><?php previous_comments_link( '&ltrif; ' . __( 'Older comments', 'april' ) ) ?></div>
			<div class="col-sm-5 text-right"><?php next_comments_link( __( 'Newer comments', 'april' ) . ' &rtrif;' ) ?></div>
		</div>

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ( comments_open() ) : ?>
			<!-- If comments are open, but there are no comments. -->

		<?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<div class="row">
				<div class="col-sm-10 offset-sm-1">
					<p class="nocomments"><?php _e( 'Comments are closed.', 'april' ); ?></p>
				</div>
			</div>

		<?php endif; ?>
	<?php endif; ?>

	<div class="row comment-form">
		<div class="col-sm-10 offset-sm-1">
			<?php
			$req       = get_option( 'require_name_email' );
			$aria_req  = ( $req ? " aria-required='true'" : '' );
			$html_req  = ( $req ? " required='required'" : '' );
			$commenter = wp_get_current_commenter();
			$fields =  array(
				'author' => '<fieldset class="form-group">' .
					'<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' .
					'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' />' .
					'</fieldset>',
				'email' => '<fieldset class="form-group">' .
					'<label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' .
					'<input id="email" class="form-control" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />' .
					'</fieldset>',
				'url' => '<fieldset class="form-group">' .
					'<label for="url">' . __( 'Website' ) . '</label>' .
					'<input id="url" class="form-control" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" />' .
					'</fieldset>',
			);
			$comment_field = '<fieldset class="form-group">' .
				'<label for="comment">' . _x( 'Comment', 'noun' ) . '</label>' .
				'<textarea id="comment" class="form-control" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>' .
				'</fieldset>';
			?>
			<?php comment_form(
				array(
					'comment_field'      => $comment_field,
					'fields'             => $fields,
					'title_reply_before' => '<h6>',
					'title_reply_after'  => '</h6>',
				)
			); ?>
		</div>
	</div>
</section>