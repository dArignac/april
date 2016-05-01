<?php get_header(); ?>

<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			april_get_content_template();
		endwhile;
	endif;
?>

<?php the_posts_pagination(); ?>

<?php get_footer();