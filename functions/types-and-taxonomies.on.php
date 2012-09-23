<?php 


$allposttypes = array('page', 'post', 'tax', 'chart' );

$eeeeditflow_supports = "'ef_custom_statuses', 'ef_notifications', 'ef_editorial_comments', 'ef_calendar', 'ef_editorial_metadata'";

//$editflow_supports = array('ef_custom_statuses', 'ef_notifications', 'ef_editorial_comments', 'ef_calendar', 'ef_editorial_metadata');


// We will need Press Releases (rename to media release?)
// We will need Events
// We need Clips

// If you try to register post types/taxonomies outside of (before) init, the site breaks. 
add_action('init', 'epi_custom_init', 0);

function epi_custom_init() 
{


	global $allposttypes;
	global $editflow_supports;


// $labels = array(
// 	'name' => _x( 'Publications', 'post type general name' ),
// 	'singular_name' => _x( 'Publication', 'post type singular name' ),
// 	'add_new' => __( 'Add New Publication' ),
// 	'add_new_item' => __( 'Add New Publication' ),
// 	'edit_item' => __( 'Edit Publication' ),
// 	'new_item' => __( 'New Publication' ),
// 	'view_item' => __( 'View Publication' ),
// 	'search_items' => __( 'Search Publications' ),
// 	'not_found' => __( 'No publications found.' ),
// 	'not_found_in_trash' => __( 'No publications found in Trash.' ),
// 	'menu_name' => __( 'Publications' ),
// );
// $args = array(
// 	'labels' => $labels,
// 	'description' => '',
// 	'public' => true,
// 	'publicly_queryable' => true,
// 	'exclude_from_search' => false,
// 	'show_ui' => true,
// 	'menu_position' => 3,
// 	'menu_icon' => null,
// 	'capability_type' => 'post',
// 	'hierarchical' => false,
// //	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', $editflow_supports ),
// 	'supports' => array('title', 'editor', 'author', 'excerpt', 'trackbacks', 'custom-fields', 'revisions'),
// 	// 'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'ef_custom_statuses', 'ef_notifications', 'ef_editorial_comments', 'ef_calendar', 'ef_editorial_metadata' ),
// //	'taxonomies' => array('post_tag', ),
// 	'rewrite' => true,
// 	'query_var' => true,
// 	'can_export' => true,
// 	'show_in_nav_menus' => true,
// );
// register_post_type('publication', $args);







$labels = array(
	'name' => _x( 'Charts', 'post type general name' ),
	'singular_name' => _x( 'Chart', 'post type singular name' ),
	'add_new' => __( 'Add New Chart' ),
	'add_new_item' => __( 'Add New Chart' ),
	'edit_item' => __( 'Edit Chart' ),
	'new_item' => __( 'New Chart' ),
	'view_item' => __( 'View Chart' ),
	'search_items' => __( 'Search Charts' ),
	'not_found' => __( 'No Charts found.' ),
	'not_found_in_trash' => __( 'No Charts found in Trash.' ),
	'menu_name' => __( 'Charts' ),
);


$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'menu_position' => 50,
	'menu_icon' => null,
	'capability_type' => 'post',
	'hierarchical' => false,
//	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', $editflow_supports ),
	'supports' => array('title', 'editor', 'author', 'excerpt', 'trackbacks', 'custom-fields', 'revisions'),
	// 'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'ef_custom_statuses', 'ef_notifications', 'ef_editorial_comments', 'ef_calendar', 'ef_editorial_metadata' ),
//	'taxonomies' => array('post_tag', ),
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'show_in_nav_menus' => true,
);




register_post_type('chart', $args);









$labels = array(
	'name' => _x( 'Taxonomy Meta', 'post type general name' ),
	'singular_name' => _x( 'Taxonomy Meta', 'post type singular name' ),
	'add_new' => __( 'Add New Taxonomy Meta' ),
	'add_new_item' => __( 'Add New Taxonomy Meta' ),
	'edit_item' => __( 'Edit Taxonomy Meta' ),
	'new_item' => __( 'New Taxonomy Meta' ),
	'view_item' => __( 'View Taxonomy Meta' ),
	'search_items' => __( 'Search Taxonomy Metas' ),
	'not_found' => __( 'No Taxonomy Metas found.' ),
	'not_found_in_trash' => __( 'No Taxonomy Metas found in Trash.' ),
	'menu_name' => __( 'Taxonomy Meta' ),
);
$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => false,
	'publicly_queryable' => true,
	'exclude_from_search' => true,
	'show_ui' => true,
	'menu_position' => 40,
	'menu_icon' => null,
	'capability_type' => 'post',
	'hierarchical' => false,
	// 'supports' => array('title', 'editor', 'author', 'excerpt', 'custom-fields', 'revisions'),
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'ef_custom_statuses', 'ef_notifications', 'ef_editorial_comments', 'ef_calendar', 'ef_editorial_metadata' ),


//	'taxonomies' => array('post_tag', ),
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'show_in_nav_menus' => false,
);
register_post_type('tax', $args);





/********************************************
Taxonomies
********************************************/


$labels = array(
	'name' => _x( 'Subjects', 'taxonomy general name' ),
	'singular_name' => _x( 'Subject', 'taxonomy singular name' ),
	'search_items' => __( 'Search Subjects' ),
	'popular_items' => __( 'Popular Subjects' ),
	'all_items' => __( 'All Subjects' ),
	'edit_items' => __( 'Edit Subjects' ),
	'update_item' => __( 'Update Subjects' ),
	'add_new_item' => __( 'Add New Subject' ),
	'new_item_name' => __( 'New Subject' ),
	'separate_items_with_commas' => __( 'Separate subjects with commas' ),
	'add_or_remove_items' => __( 'Add or remove subjects' ),
	'choose_from_most_used' => __( 'Choose from the most used subjects' ),
	'menu_name' => __( 'Subjects' ),
);


$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	// 'hierarchical' => true, // this makes it hierarchical in the UI
	'hierarchical' => true, // this makes it hierarchical in the UI
//	'rewrite' => array( 'hierarchical' => true ), // this makes hierarchical URLs
	'rewrite' => array( 'hierarchical' => true, 'slug' => 'subjects', 'with_front' => true ), // this makes hierarchical URLs
	'query_var' => true,
);




// if( is_admin() && (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') ) ) {
//     $args['hierarchical'] = true;
// }


// if( !is_admin() ) {
//     $args['hierarchical'] = true;
// }


register_taxonomy('subject', $allposttypes, $args);



$labels = array(
	'name' => _x( 'Types', 'taxonomy general name' ),
	'singular_name' => _x( 'Type', 'taxonomy singular name' ),
	'search_items' => __( 'Search Types' ),
	'popular_items' => __( 'Popular Types' ),
	'all_items' => __( 'All Types' ),
	'edit_items' => __( 'Edit Types' ),
	'update_item' => __( 'Update Types' ),
	'add_new_item' => __( 'Add New Type' ),
	'new_item_name' => __( 'New Type' ),
	'separate_items_with_commas' => __( 'Separate types with commas' ),
	'add_or_remove_items' => __( 'Add or remove types' ),
	'choose_from_most_used' => __( 'Choose from the most used types' ),
	'menu_name' => __( 'Types' ),
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	'hierarchical' => true, // this makes it hierarchical in the UI
//	'rewrite' => array( 'hierarchical' => true ), // this makes hierarchical URLs
	'rewrite' => array( 'hierarchical' => true, 'slug' => 'types', 'with_front' => true ), // this makes hierarchical URLs
	'query_var' => true,
);
register_taxonomy('type', $allposttypes, $args);




$labels = array(
	'name' => _x( 'Demographics', 'taxonomy general name' ),
	'singular_name' => _x( 'Demographic', 'taxonomy singular name' ),
	'search_items' => __( 'Search Demographics' ),
	'popular_items' => __( 'Popular Demographics' ),
	'all_items' => __( 'All Demographics' ),
	'edit_items' => __( 'Edit Demographics' ),
	'update_item' => __( 'Update Demographics' ),
	'add_new_item' => __( 'Add New Demographic' ),
	'new_item_name' => __( 'New Demographic' ),
	'separate_items_with_commas' => __( 'Separate demographics with commas' ),
	'add_or_remove_items' => __( 'Add or remove demographics' ),
	'choose_from_most_used' => __( 'Choose from the most used demographics' ),
	'menu_name' => __( 'Demographics' ),
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	'hierarchical' => true, // this makes it hierarchical in the UI
//	'rewrite' => array( 'hierarchical' => true ), // this makes hierarchical URLs
	'rewrite' => array( 'hierarchical' => true, 'slug' => 'demographics', 'with_front' => true ), // this makes hierarchical URLs
	'query_var' => true,
);
register_taxonomy('demographic', $allposttypes, $args);




$labels = array(
	'name' => _x( 'Features', 'taxonomy general name' ),
	'singular_name' => _x( 'Feature', 'taxonomy singular name' ),
	'search_items' => __( 'Search Features' ),
	'popular_items' => __( 'Popular Features' ),
	'all_items' => __( 'All Features' ),
	'edit_items' => __( 'Edit Features' ),
	'update_item' => __( 'Update Features' ),
	'add_new_item' => __( 'Add New Feature' ),
	'new_item_name' => __( 'New Feature' ),
	'separate_items_with_commas' => __( 'Separate features with commas' ),
	'add_or_remove_items' => __( 'Add or remove features' ),
	'choose_from_most_used' => __( 'Choose from the most used features' ),
	'menu_name' => __( 'Features' ),
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	'hierarchical' => true, // this makes it hierarchical in the UI
//	'rewrite' => array( 'hierarchical' => true ), // this makes hierarchical URLs
	'rewrite' => array( 'hierarchical' => true, 'slug' => 'features', 'with_front' => true ), // this makes hierarchical URLs
	'query_var' => true,
);
register_taxonomy('feature', $allposttypes, $args);




$labels = array(
	'name' => _x( 'Indicators', 'taxonomy general name' ),
	'singular_name' => _x( 'indicator', 'taxonomy singular name' ),
	'search_items' => __( 'Search indicators' ),
	'popular_items' => __( 'Popular indicators' ),
	'all_items' => __( 'All indicators' ),
	'edit_items' => __( 'Edit indicators' ),
	'update_item' => __( 'Update indicators' ),
	'add_new_item' => __( 'Add New indicator' ),
	'new_item_name' => __( 'New indicator' ),
	'separate_items_with_commas' => __( 'Separate indicators with commas' ),
	'add_or_remove_items' => __( 'Add or remove indicators' ),
	'choose_from_most_used' => __( 'Choose from the most used indicators' ),
	'menu_name' => __( 'Indicators' ),
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	'hierarchical' => true, // this makes it hierarchical in the UI
//	'rewrite' => array( 'hierarchical' => true ), // this makes hierarchical URLs
	'rewrite' => array( 'hierarchical' => true, 'slug' => 'indicators', 'with_front' => true ), // this makes hierarchical URLs
	'query_var' => true,
);
register_taxonomy('indicator', $allposttypes, $args);


















$labels = array(
	'name' => _x( 'SWA Chapters', 'taxonomy general name' ),
	'singular_name' => _x( 'SWA Chapter', 'taxonomy singular name' ),
	'search_items' => __( 'Search SWA Chapters' ),
	'popular_items' => __( 'Popular SWA Chapters' ),
	'all_items' => __( 'All SWA Chapters' ),
	'edit_items' => __( 'Edit SWA Chapters' ),
	'update_item' => __( 'Update SWA Chapters' ),
	'add_new_item' => __( 'Add New SWA Chapter' ),
	'new_item_name' => __( 'New SWA Chapter' ),
	'separate_items_with_commas' => __( 'Separate SWA Chapters with commas' ),
	'add_or_remove_items' => __( 'Add or remove types' ),
	'choose_from_most_used' => __( 'Choose from the most used SWA Chapters' ),
	'menu_name' => __( 'SWA Chapters' ),
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	'hierarchical' => true, // this makes it hierarchical in the UI
//	'rewrite' => array( 'hierarchical' => true ), // this makes hierarchical URLs
	'rewrite' => array( 'hierarchical' => true, 'slug' => 'swa-chapter', 'with_front' => true ), // this makes hierarchical URLs
	'query_var' => true,
);
register_taxonomy('swa_chapter', array('chart'), $args);





$labels = array(
	'name' => _x( 'Internal Tags', 'taxonomy general name' ),
	'singular_name' => _x( 'Internal Tag', 'taxonomy singular name' ),
	'search_items' => __( 'Search Internal Tags' ),
	'popular_items' => __( 'Popular Internal Tags' ),
	'all_items' => __( 'All Internal Tags' ),
	'edit_items' => __( 'Edit Internal Tags' ),
	'update_item' => __( 'Update Internal Tags' ),
	'add_new_item' => __( 'Add New Internal Tag' ),
	'new_item_name' => __( 'New Internal Tag' ),
	'separate_items_with_commas' => __( 'Separate internal tags with commas' ),
	'add_or_remove_items' => __( 'Add or remove internal tags' ),
	'choose_from_most_used' => __( 'Choose from the most used internal tags' ),
	'menu_name' => __( 'Internal Tags' ),
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => false,
	'hierarchical' => true, // this makes it hierarchical in the UI
	'rewrite' => array( 'hierarchical' => true ), // this makes hierarchical URLs
	'query_var' => true,
);



if( is_admin() && (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') ) ) {
    $args['hierarchical'] = false;
}


register_taxonomy('internal', $allposttypes, $args);
























// $labels = array(
// 	'name' => _x( 'People', 'taxonomy general name' ),
// 	'singular_name' => _x( 'Person', 'taxonomy singular name' ),
// 	'search_items' => __( 'Search People' ),
// 	'popular_items' => __( 'Popular People' ),
// 	'all_items' => __( 'All People' ),
// 	'edit_items' => __( 'Edit People' ),
// 	'update_item' => __( 'Update People' ),
// 	'add_new_item' => __( 'Add New Person' ),
// 	'new_item_name' => __( 'New Person' ),
// 	'separate_items_with_commas' => __( 'Separate people with commas' ),
// 	'add_or_remove_items' => __( 'Add or remove people' ),
// 	'choose_from_most_used' => __( 'Choose from the most used people' ),
// 	'menu_name' => __( 'People' ),
// );
// $args = array(
// 	'labels' => $labels,
// 	'public' => true,
// 	'show_in_nav_menus' => true,
// 	'show_ui' => true,
// 	'show_tagcloud' => true,
// 	'hierarchical' => true,
// 	'rewrite' => true,
// 	'query_var' => true,
// );


// if( is_admin() && (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') ) ) {
//     $args['hierarchical'] = false;
// }

// register_taxonomy('people', $allposttypes, $args);



}
