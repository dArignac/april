<?php
$display_author = get_theme_mod( 'april_display_author' );
$date   = date_i18n( get_option( 'date_format' ), get_the_date( 'U' ) );
$author = get_the_author();
?>
<?php if ( $display_author ): ?>
	<?php printf( __( '%1$s by %2$s', 'april' ), $date, $author ); ?>
<?php else: ?>
	<?php echo $date; ?>
<?php endif; ?>