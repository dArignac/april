<?php
if ( ! function_exists( ( 'april_theme_setup' ) ) ) {
	/**
	 * Theme setup.
	 */
	function april_theme_setup() {

		include 'include/customizer.php';

		load_theme_textdomain( 'april', get_template_directory() . '/languages' );

		register_nav_menus( array(
			'primary' => __( 'Primary', 'april' )
		) );
	}
}
add_action( 'after_setup_theme', 'april_theme_setup', 10 );

/**
 * Include all javascripts and stylesheets.
 */
function april_load_scripts_and_styles() {

	// Typekit Javascript if configured
	$typekitKidId = get_theme_mod( 'typekit_kit_id' );
	if ( $typekitKidId ) {
		// insert once
		if ( !wp_script_is( 'april-theme-typekit-js', 'done' ) ) {
			echo "<script src=\"https://use.typekit.net/" . $typekitKidId . ".js\"></script>";
			echo "<script>try{Typekit.load({ async: true });}catch(e){}</script>";
			global $wp_scripts;
			$wp_scripts->done[] = 'april-theme-typekit-js';
		}
	}

	// default stylesheet
	wp_enqueue_style( 'april-style', get_stylesheet_uri() );

	// TODO: necessary?
	// enqueue comment-reply script only on posts & pages with comments open ( included in WP core )
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'april_load_scripts_and_styles' );


if ( ! function_exists( 'april_get_content_template' ) ) {
	/**
	 * Select appropriate template part depending on content type.
	 */
	function april_get_content_template() {
		if ( is_home() ) {
			get_template_part( 'content' );
		} elseif ( is_singular( 'post' ) ) {
			get_template_part( 'content' );
		} elseif ( is_page() ) {
			get_template_part( 'content', 'page' );
		} elseif ( is_attachment() ) {
			get_template_part( 'content', 'attachment' );
		} elseif ( is_archive() ) {
			get_template_part( 'content', 'archive' );
		} else {
			get_template_part( 'content' );
		}
	}
}