<?php
include 'menu/functions.php';

if ( ! function_exists( ( 'april_theme_setup' ) ) ) {
	/**
	 * Theme setup.
	 */
	function april_theme_setup() {

		add_theme_support( 'post-thumbnails' ); // featured images

		include 'include/customizer.php';
		include 'menu/walker.php';

		load_theme_textdomain( 'april', get_template_directory() . '/languages' );

		register_nav_menus( array(
			'primary' => __( 'Primary', 'april' ),
			'footer'  => __( 'Footer', 'april' )
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

	// Font Awesome
	wp_enqueue_style( 'april-font-awesome', get_template_directory_uri() . '/bower_components/font-awesome/css/font-awesome.css' );

	// default stylesheet
	wp_enqueue_style( 'april-style', get_stylesheet_uri() );

	// typekit css depending on settings
	if ( $typekitKidId ) {
		$typekitCSS = '';
		$typekitFontFamily = get_theme_mod( 'typekit_font_family' );
		$typekitFontWeight = get_theme_mod( 'typekit_font_weight' );
		if ( $typekitFontFamily ) {
			$typekitCSS = 'body, h1 { font-family: "' . $typekitFontFamily . '";';

			if ( $typekitFontWeight ) {
				$typekitCSS .= 'font-weight: ' . intval($typekitFontWeight) . ';';
			}

			$typekitCSS .= '}';
		}
		if ( $typekitCSS ) {
			wp_add_inline_style( 'april-style', $typekitCSS );
		}
	}

	// april scripts
	wp_enqueue_script( 'april-script', get_template_directory_uri() . '/js/april.js', array('jquery') );

	// Bootstrap required scripts
	// TODO make dist friendly - https://github.com/dArignac/april/issues/4
	wp_enqueue_script( 'tether', get_template_directory_uri() . '/bower_components/tether/dist/js/tether.js', array('jquery'), '1.2.0', false );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bower_components/bootstrap/dist/js/bootstrap.js', array('jquery', 'tether'), '4.0.0a2', false );
}
add_action( 'wp_enqueue_scripts', 'april_load_scripts_and_styles' );


if ( ! function_exists( 'april_get_content_template' ) ) {
	/**
	 * Select appropriate template part depending on content type.
	 */
	function april_get_content_template() {
		if ( is_home() ) {
			get_template_part( 'content', 'archive' );
		} elseif ( is_singular( 'post' ) || is_page() ) {
			get_template_part( 'content' );
		} elseif ( is_attachment() ) {
			get_template_part( 'content', 'attachment' );
		} elseif ( is_archive() ) {
			get_template_part( 'content', 'archive' );
		} else {
			get_template_part( 'content' );
		}
	}
}

/**
 * Registers the primary widget area with 4 widgets in a row.
 */
function april_register_widget_areas() {

	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', 'april' ),
			'id'            => 'primary',
			'description'   => __( 'Widgets in this area will be shown in the header dropdown.', 'april' ),
			'before_widget' => '<div class="col-sm-3">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>'
		)
	);
}
add_action( 'widgets_init', 'april_register_widget_areas' );

/**
 * Filter the sidebar params for the primary sidebar.
 * It adds the Bootstrap row HTML elements to place 4 widgets per row.
 * @param $params
 * @return mixed
 */
function april_dynamic_sidebar_params_for_primary( $params ) {
	$widgets = get_option( 'sidebars_widgets' );
	$widget_id = $params[0]['widget_id'];
	$widget_index = array_search($widget_id, $widgets['primary']);

	// Extrawurst for UTC - be extra wide
	if ( $params[0]['widget_name'] == 'Ultimate Tag Cloud' ) {
		$params[0]['before_widget'] = '<div class="col-sm-6">';
	}

	if ( $widget_index % 4 == 0 ) {
		$params[0]['before_widget'] = '<div class="row">' . $params[0]['before_widget'];

		// not the first widget but beginning of a new row, close the old one
		if ( $widget_index > 0 ) {
			$params[0]['before_widget'] = '</div>' . $params[0]['before_widget'];
		}
	}

	// catch the last widget and close the row tag
	if ( $widget_index == ( count( $widgets['primary'] ) - 1 ) ) {
		$params[0]['after_widget'] = $params[0]['after_widget'] . '</div>';
	}

	return $params;
}
add_filter( 'dynamic_sidebar_params', 'april_dynamic_sidebar_params_for_primary' );

/**
 * Add Bootstrap navigation class to all menu items.
 * This only applies for the footer though the adjustment is made for all menu items (also for primary)
 * @param $sorted_menu_items the sorted items
 * @return mixed
 */
function april_wp_nav_menu_objects( $sorted_menu_items ) {
	foreach ( $sorted_menu_items as $item ) {
		$item->classes[] = 'nav-item';
	}
	return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'april_wp_nav_menu_objects' );


if ( ! function_exists( ( 'april_comments_callback' ) ) ) {
	/**
	 * Comments template.
	 * @param $comment
	 * @param $args
	 * @param $depth
	 */
	function april_comments_callback( $comment, $args, $depth ) {
		?>
		<article id="comment-<?php comment_ID(); ?>" class="comment row <?php echo get_comment_class(); ?>">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="quotelike">
					<div class="author"><?php comment_author_link(); ?></div>
					<div class="date"><?php comment_date(); ?></div>
					<div class="text"><?php comment_text(); ?></div>
				</div>
			</div>
		</article>
		<?php
	}
}
