<?php get_header();

// TODO separate archive header?
?>

<div>
	<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				april_get_content_template();
			endwhile;
		endif;
	?>
</div>

<?php get_footer();