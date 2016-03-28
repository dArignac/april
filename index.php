<?php get_header(); ?>

TODO CONTENT
<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			april_get_content_template();
		endwhile;
	endif;
?>

<?php get_footer();