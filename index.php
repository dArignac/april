<?php get_header(); ?>

<?php
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