<?php if ( is_active_sidebar( 'primary' ) ) :
	$widgets      = get_option( 'sidebars_widgets' );
	$widget_count = count( $widgets['primary'] );
	?>
	<aside>
		<?php //dynamic_sidebar( 'primary' ); ?>
	</aside>
<?php endif;