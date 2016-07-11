<?php
	global $wp_query;
	get_header();
?>

<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<?php printf( __( 'Search Results for: %s', 'april' ), '<span>' . get_search_query() . '</span>'); ?>
	</div>
</div>

<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'content', 'archive' );
		endwhile;
	endif;
?>

<?php
	the_posts_pagination();
	get_footer();