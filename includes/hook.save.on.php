<?php 



/**
 * Remove extra lines and spaces from a post on save
 *
 * @todo Enable per-post override by custom field
 * @since 2012-09-01 15:30:33
 */

add_action('content_save_pre', 'my_strip_extra_space', 99);

function my_strip_extra_space($content){

	// Remove extra lines
	$content = preg_replace('/&nbsp;[\n\r]+/i', '', $content);
	$content = preg_replace('/[\n\r]+&nbsp;/i', '', $content);

	// Remove extra spaces
	$content = preg_replace('/[  ]+/', ' ', $content);
	
	return $content;
}






/**
 * Grab chart number and type from the title when you save a post
 *
 * @example Title: "ib334 | Table 4a | Cost of widgets over time"
 *          Resulting custom field value: Table 4a
 *          Resulting "Type" tag: Table
 *          
 * @link http://wpquestions.com/question/show/id/7179
 */


add_filter ('save_post','w559_save_post');

function w559_save_post($id) {

	global $post;
	$title = $_POST['post_title'];
	$pt = $post->post_type;

	// Check if this is the right post type
	if ( $pt == 'tax' ) {

		// Parse the title to see if it has a figure number and type
		// Title format is "Identifier | Table 10 | Title"
		$title_parts = explode('|', $title);
		$title_main = array_pop($title_parts);
		$title_main = trim($title_main);
		$label = array_pop($title_parts);
		$label = trim($label);
		$type = preg_match('/Table|Figure|Infographic|Interactive/i', $label, $matches) ? $matches[0] : '';

		$timestamp = date('h:i:s');

		// If it has a figure type, save that in the type taxonomy
		if ( $type ) {
			$taxonomy = 'type';
			wp_set_object_terms( $id, $type, $taxonomy, $Do_Not_Overwrite_Existing_Terms = true);
		}

		// If it has a figure number, save it into a custom field
		if ( $label ) {
			$meta_key = 'chart_label';
			update_post_meta( $id, $meta_key, $label );
		}
	}
}




/**
 * An attempt to dump SimplePie cache when a post is updated.
 * I don't think it works.
 *
 * @uses  SimplePie PHP RSS feeds
 */


// add_action('post_updated', 'my_emptySimplePieCache');

function my_emptySimplePieCache() {
	// check if this is an economic indicators page
	// $id = get_the_id();
	$id = $_POST['ID'];
	if (is_page($id)) {
		
		// path to SimplePie cache
		$folder = '/home/epi/stateofworkingamerica.org/cache/';
		// $handle = opendir($folder);

		foreach(glob($folder.'*.spc*') as $file) {
			rename ( $file, $file.'.'.date("Y-m-j").'.old' );
		}
	}
}