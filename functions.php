<?php
include 'menu/functions.php';

if ( ! function_exists( ( 'april_theme_setup' ) ) ) {
	/**
	 * Theme setup.
	 */
	function april_theme_setup() {

		add_theme_support( 'post-thumbnails' ); // featured images

		include_once 'include/customizer.php';
		include_once 'menu/walker.php';

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
	$typekitKidId = get_theme_mod( 'april_typekit_kit_id' );
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
	// will be replaced with grunt script
	wp_enqueue_style( 'april-font-awesome', get_template_directory_uri() . '/node_modules/font-awesome/css/font-awesome.css' );

	// default stylesheet
	// will be replaced with grunt script
	wp_enqueue_style( 'april-style', get_template_directory_uri() . '/css/april.css' );

	// typekit css depending on settings
	if ( $typekitKidId ) {
		$typekitCSS = '';
		$typekitFontFamily = get_theme_mod( 'april_typekit_font_family' );
		$typekitFontWeight = get_theme_mod( 'april_typekit_font_weight' );
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
	// will be replaced by grunt script - it packages all into april.js
	wp_enqueue_script( 'tether', get_template_directory_uri() . '/node_modules/tether/dist/js/tether.js', array('jquery'), null, false );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.js', array('jquery', 'tether'), null, false );
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

/**
 * Parse post content and attach the bootstrap class "img-fluid" to images to make them fluid within the column layout.
 * @param $content
 * @return string
 */
function april_the_content( $content ) {
	$content = mb_convert_encoding( $content, 'HTML-ENTITIES', "UTF-8" );
	$document = new DOMDocument();
	libxml_use_internal_errors( true );
	$document->loadHTML( utf8_decode( $content ) );

	$imgs = $document->getElementsByTagName( 'img' );
	foreach ( $imgs as $img ) {
		$img->setAttribute( 'class', $img->getAttribute( 'class' ) . ' img-fluid' );
	}

	$html = $document->saveHTML();
	return $html;
}
add_filter( 'the_content', 'april_the_content' );


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
			<div class="col-sm-10 offset-sm-1">
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

if ( ! function_exists( 'april_pre_get_posts' ) ) {
	function april_pre_get_posts( $query ) {

		if ( !$query->is_main_query() ) {
			return;
		}

		// fetch page query
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		// get all sticky posts - whatever category they belong to
		$sticky_posts = get_option( 'sticky_posts' );

		// on front page, filter the posts, see https://github.com/dArignac/april/issues/16
		if ( is_home() ) {

			$front_page_categories = get_theme_mod('april_display_front_page_category');

			// "display all" is value 0
			if ( $front_page_categories && count( $front_page_categories ) > 0 && $front_page_categories[0] != 0 ) {
				// only display the categories that were configured
				$query->set( 'cat', implode( ',', array_values( $front_page_categories ) ) );

				// remove sticky posts of the categories to be displayed from the sticky array
				// this results in displaying only sticky posts for the selected categories and hiding all other
				$sticky_posts_other_cats = array();
				foreach ( $sticky_posts as $post ) {
					foreach ( get_the_category( $post ) as $category ) {
						if ( ! in_array( $category->term_id, $front_page_categories ) ) {
							array_push( $sticky_posts_other_cats, $post );
							continue 2;
						}
					}
				}

				// do not show sticky posts of other categories
				$query->set( 'post__not_in', $sticky_posts_other_cats );
			}
		}

		// if we're on a category page, the sticky posts of the category are included via april_the_posts thus they
		// have to be removed from the query here
		if ( $query->is_category() ) {
			// get all sticky posts - whatever category they belong to
			$sticky_post_ids = get_option('sticky_posts');

			// get the current category
			$query_object = get_queried_object();
			$current_category_id = $query_object->term_id;

			// will store the sticky posts of the current category
			$exclude_post_ids = array();

			// iterate the stickies...
			foreach ( $sticky_post_ids as $post_id ) {
				// and iterate their categories...
				foreach ( get_the_category( $post_id ) as $category ) {
					// current category and one of the posts's categories match, save the id in the exclude array
					if ( $current_category_id == $category->term_id && !in_array( $category->term_id, $exclude_post_ids ) ) {
						array_push( $exclude_post_ids, $post_id );
					}
				}
			}

			// exclude posts
			$query->set( 'post__not_in', $exclude_post_ids );
		}

		// limit search results to posts
		if ( $query->is_search && !is_admin() ) {
			$query->set( 'post_type', array( 'post' ) );
		}

		// set pagination
		$query->set( 'paged', $paged );
	}
}

add_action( 'pre_get_posts' , 'april_pre_get_posts' );


if ( ! function_exists( 'april_the_posts' ) ) {
	function april_the_posts( $posts, $query ) {

		// if on a category page...
		if ( $query->is_category() ) {
			// get all sticky posts - whatever category they belong to
			$sticky_post_ids = get_option('sticky_posts');

			// get the currently displayed category
			$current_category = get_category( get_query_var( 'cat' ) );

			// will store the sticky posts of the current category
			$append_posts = array();

			// iterate the stickies...
			foreach ( $sticky_post_ids as $post_id ) {
				// and iterate their categories...
				foreach ( get_the_category( $post_id ) as $category ) {
					// current category and one of the posts's categories match, save the id in the append array
					if ( $current_category->term_id == $category->term_id && !in_array( $category->term_id, $append_posts ) ) {
						array_push( $append_posts, $post_id );
					}
				}
			}

			// fetch the posts, sort them, and prepend to the current posts
			// fetch 'em:
			$append_posts = array_map(
				function( $post_id ) {
					return get_post( $post_id );
				},
				$append_posts
			);
			// sort them by post date
			uasort(
				$append_posts,
				function( $a, $b ) {
					if ( $a->post_date_gmt == $b->post_date_gmt ) {
						return 0;
					}
					return ($a->post_date_gmt < $b->post_date_gmt) ? -1 : 1;
				}
			);
			// prepend
			$posts = array_merge( $append_posts, $posts);
		}

		return $posts;
	}
}
add_filter( 'the_posts', 'april_the_posts', 10, 2 );