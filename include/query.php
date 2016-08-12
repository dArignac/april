<?php
class April_Query {
	/**
	 * @var null singleton instance
	 */
	private static $instance = null;

	/**
	 * Instantiates a singleton of the class.
	 * @return April_Query|null
	 */
	public static function get_instance() {
		if( null == self::$instance ) {
			self::$instance = new April_Query();
		}
		return self::$instance;
	}

	/**
	 * Class constructor registering the Wordpress hooks.
	 */
	private function __construct() {
		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
		add_filter( 'found_posts',   array( $this, 'found_posts'), 10, 2 );
	}

	/**
	 * Called before the query are made in the database - counts all stickies and adjusts the posts to display.
	 * So if there are 5 posts per page configured, and there are 2 stickies, then it will query 3 posts (2=3=5) instead
	 * of prepending the stickies to the 5 posts (the default implementation in WP).
	 * @param $query
	 */
	public function pre_get_posts( $query ) {

		if ( $query->is_main_query() && $query->is_home() ) {

			$count_stickies = count( get_option( 'sticky_posts' ) );
			$ppp = get_option( 'posts_per_page' );
			$offset = ( $count_stickies <= $ppp ) ? $count_stickies : $ppp;

			if ( !$query->is_paged() ) {
				$query->set( 'posts_per_page', ( $ppp - $offset ) );
			} else {
				$offset = ( ( $query->query_vars['paged'] - 1 ) * $ppp ) - $offset;
				$query->set( 'posts_per_page', $ppp );
				$query->set( 'offset', $offset );
			}

		}
	}

	/**
	 * This reports the number of found posts for a query and adjusted it accordingly to include the sticky posts, see
	 * pre_get_posts function.
	 * @param $found_posts
	 * @param $query
	 * @return mixed
	 */
	public function found_posts( $found_posts, $query ) {

		if( $query->is_main_query() && $query->is_home() ) {

			$count_stickies = count( get_option( 'sticky_posts' ) );
			$ppp = get_option( 'posts_per_page' );
			$offset = ( $count_stickies <= $ppp ) ? $count_stickies : $ppp;

			$found_posts = $found_posts + $offset;
		}
		return $found_posts;
	}
}