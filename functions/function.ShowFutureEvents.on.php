<?php 

/****************************************************
	Marking future dated post as published
	http://wordpress.stackexchange.com/questions/175/marking-future-dated-post-as-published
****************************************************/

function setup_future_hook() {
// Replace native future_post function with replacement
	remove_action('future_event','_future_post_hook');
	add_action('future_event','publish_future_post_now');
}

function publish_future_post_now($id) {
// Set new post's post_status to "publish" rather than "future."
	wp_publish_post($id);
}

add_action('init', 'setup_future_hook');

/****************************************************
	Use the hey_ShowFuturePosts filter with the 
	Wordpress posts_where hook when you want to 
	loop through show future events.
	
	Here's how to use it:
	
	add_filter( 'posts_where', 'heyfilter_OnlyFuturePosts' );
		// put your normal WP_Query here
	remove_filter( 'posts_where', 'heyfilter_OnlyFuturePosts' );

****************************************************/

// Create a new filtering function that will add our where clause to the query
function heyfilter_OnlyFuturePosts ( $where = '' ) {
	// posts with a post_date later than 4 hours ago
	// Question: this may need to be adjusted based on the timezone of the server/user?
	
	$where .= " AND post_date >= '" . date('Y-m-d', strtotime('-4 hours')) . "'";
	return $where;

}

function heyfilter_OnlyPastPosts ( $where = '' ) {
	// posts with a post_date later than 4 hours ago
	// Question: this may need to be adjusted based on the timezone of the server/user?
	
	$where .= " AND post_date < '" . date('Y-m-d', strtotime('-4 hours')) . "'";
	return $where;

}
