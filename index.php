<?php get_header(); ?>

<?php
	// on front page, filter the posts, see https://github.com/dArignac/april/issues/16
	if ( is_home() ) {
		$front_page_categories = get_theme_mod('april_display_front_page_category');
		// "display all" is value 0
		if ( $front_page_categories && count( $front_page_categories ) > 0 && $front_page_categories[0] != 0 ) {
			// fetch page query
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}
			query_posts(
				array(
					'paged' => $paged,
					'cat' => implode( ',', array_values( $front_page_categories ) )
				)
			);
		}
	};

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			april_get_content_template();
		endwhile;
	endif;
?>

<div class="row">
	<div class="col-sm-10 col-sm-offset-1 text-xs-center">
		<?php the_posts_pagination(
			array(
				'prev_text' => '&ltrif;',
				'next_text' => '&rtrif;'
			)
		); ?>
	</div>
</div>

<?php get_footer();