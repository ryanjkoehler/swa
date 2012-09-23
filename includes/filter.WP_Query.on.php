<?php 
	
/**
 * Allow custom query by post title search
 * 
 * @link http://wordpress.stackexchange.com/questions/18703/wp-query-with-post-title-like-something
 */

add_filter( 'posts_where', 'wpse18703_posts_where', 10, 2 );

function wpse18703_posts_where( $where, &$wp_query ) {

	global $wpdb;

	if ( $titlesearch = $wp_query->get( 'titlesearch' ) ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $titlesearch ) ) . '%\'';
	}
	
	if ( $titlesearch_exact = $wp_query->get( 'titlesearch_exact' ) ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( like_escape( $titlesearch ) ) . '\'';
	}
	
	return $where;
}