<?php 


$allposttypes = array('blog', 'event','news','press','epinews', 'bio', 'issuepage', 'feature', 'snapshots', 'publication', 'test', 'post', 'page', 'mediapage', 'attachment', 'revision', 'nav_menu_item', 'clip' );

$eeeeditflow_supports = "'ef_custom_statuses', 'ef_notifications', 'ef_editorial_comments', 'ef_calendar', 'ef_editorial_metadata'";

//$editflow_supports = array('ef_custom_statuses', 'ef_notifications', 'ef_editorial_comments', 'ef_calendar', 'ef_editorial_metadata');


// We will need Press Releases (rename to media release?)
// We will need Events
// We need Clips

// If you try to register post types/taxonomies outside of (before) init, the site breaks. 
add_action('init', 'epi_custom_init');

function epi_custom_init() 
{


	global $allposttypes;
	global $editflow_supports;


$labels = array(
	'name' => _x( 'Publications', 'post type general name' ),
	'singular_name' => _x( 'Publication', 'post type singular name' ),
	'add_new' => __( 'Add New Publication' ),
	'add_new_item' => __( 'Add New Publication' ),
	'edit_item' => __( 'Edit Publication' ),
	'new_item' => __( 'New Publication' ),
	'view_item' => __( 'View Publication' ),
	'search_items' => __( 'Search Publications' ),
	'not_found' => __( 'No publications found.' ),
	'not_found_in_trash' => __( 'No publications found in Trash.' ),
	'menu_name' => __( 'Publications' ),
);
$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'menu_position' => 3,
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
register_post_type('publication', $args);



$labels = array(
	'name' => _x( 'Press Releases', 'post type general name' ),
	'singular_name' => _x( 'Press Release', 'post type singular name' ),
	'add_new' => __( 'Add New Press Release' ),
	'add_new_item' => __( 'Add New Press Release' ),
	'edit_item' => __( 'Edit Press Release' ),
	'new_item' => __( 'New Press Release' ),
	'view_item' => __( 'View Press Release' ),
	'search_items' => __( 'Search Press Releases' ),
	'not_found' => __( 'No Press Releases found.' ),
	'not_found_in_trash' => __( 'No Press Releases found in Trash.' ),
	'menu_name' => __( 'Press Releases' ),
);
$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'menu_position' => 3,
	'menu_icon' => null,
	'capability_type' => 'post',
	'hierarchical' => false,
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', ),
//	'taxonomies' => array('post_tag', ),
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'show_in_nav_menus' => true,
);
register_post_type('press', $args);





$labels = array(
	'name' => _x( 'Blog', 'post type general name' ),
	'singular_name' => _x( 'Blog', 'post type singular name' ),
	'add_new' => __( 'Add new blog post' ),
	'add_new_item' => __( 'Add new blog post' ),
	'edit_item' => __( 'Edit blog post' ),
	'new_item' => __( 'New blog post' ),
	'view_item' => __( 'View blog post' ),
	'search_items' => __( 'Search blog' ),
	'not_found' => __( 'No blog posts found.' ),
	'not_found_in_trash' => __( 'No blog posts found in Trash.' ),
	'menu_name' => __( 'Blog' ),
);
$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'menu_position' => 2,
	'menu_icon' => null,
	'capability_type' => 'post',
	'hierarchical' => false,
//	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', $editflow_supports),
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'ef_custom_statuses', 'ef_notifications', 'ef_editorial_comments', 'ef_calendar', 'ef_editorial_metadata' ),
//	'taxonomies' => array('post_tag', ),
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'show_in_nav_menus' => true,
// has_archive (boolean or string) (optional) Enables post type archives. Will use string as archive slug. Will generate the proper rewrite rules if rewrite is enabled.
	'has_archive' => true,
	
);
register_post_type('blog', $args);






$labels = array(
	'name' => _x( 'Events', 'post type general name' ),
	'singular_name' => _x( 'Event', 'post type singular name' ),
	'add_new' => __( 'Add New Event' ),
	'add_new_item' => __( 'Add New Event' ),
	'edit_item' => __( 'Edit Event' ),
	'new_item' => __( 'New Event' ),
	'view_item' => __( 'View Event' ),
	'search_items' => __( 'Search Events' ),
	'not_found' => __( 'No Events found.' ),
	'not_found_in_trash' => __( 'No Events found in Trash.' ),
	'menu_name' => __( 'Events' ),
);
$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'menu_position' => 3,
	'menu_icon' => null,
	'capability_type' => 'post',
	'hierarchical' => false,
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', $editflow_supports),
//	'taxonomies' => array('post_tag', ),
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'show_in_nav_menus' => true,
);
register_post_type('event', $args);




$labels = array(
	'name' => _x( 'EPI News', 'post type general name' ),
	'singular_name' => _x( 'EPI News', 'post type singular name' ),
	'add_new' => __( 'Add New EPI News' ),
	'add_new_item' => __( 'Add New EPI News' ),
	'edit_item' => __( 'Edit EPI News' ),
	'new_item' => __( 'New EPI News' ),
	'view_item' => __( 'View EPI News' ),
	'search_items' => __( 'Search EPI News' ),
	'not_found' => __( 'No EPI News found.' ),
	'not_found_in_trash' => __( 'No EPI News found in Trash.' ),
	'menu_name' => __( 'EPI News' ),
);
$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'menu_position' => 3,
	'menu_icon' => null,
	'capability_type' => 'post',
	'hierarchical' => false,
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', $editflow_supports),
//	'taxonomies' => array('post_tag', ),
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'show_in_nav_menus' => true,
	'has_archive' => 'epinews',
);
register_post_type('news', $args);





$labels = array(
	'name' => _x( 'Issue Pages', 'post type general name' ),
	'singular_name' => _x( 'Issue Pages', 'post type singular name' ),
	'add_new' => __( 'Add New Issue Pages' ),
	'add_new_item' => __( 'Add New Issue Pages' ),
	'edit_item' => __( 'Edit Issue Pages' ),
	'new_item' => __( 'New Issue Pages' ),
	'view_item' => __( 'View Issue Pages' ),
	'search_items' => __( 'Search Issue Pages' ),
	'not_found' => __( 'No Issue Pages found.' ),
	'not_found_in_trash' => __( 'No Issue Pages found in Trash.' ),
	'menu_name' => __( 'Issue Pages' ),
);
$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'menu_position' => 3,
	'menu_icon' => null,
	'capability_type' => 'post',
	'hierarchical' => true,
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', $editflow_supports),
//	'taxonomies' => array('post_tag', ),
//	'rewrite' => true,
	'rewrite' => array('slug'=>'research'),
	'query_var' => true,
	'can_export' => true,
	'show_in_nav_menus' => true,
);
register_post_type('issuepage', $args);



// $labels = array(
// 	'name' => _x( 'Economic Snapshots', 'post type general name' ),
// 	'singular_name' => _x( 'Economic Snapshot', 'post type singular name' ),
// 	'add_new' => __( 'Add New Economic Snapshot' ),
// 	'add_new_item' => __( 'Add New Economic Snapshot' ),
// 	'edit_item' => __( 'Edit Economic Snapshot' ),
// 	'new_item' => __( 'New Economic Snapshot' ),
// 	'view_item' => __( 'View Economic Snapshot' ),
// 	'search_items' => __( 'Search Economic Snapshots' ),
// 	'not_found' => __( 'No economic snapshots found.' ),
// 	'not_found_in_trash' => __( 'No economic snapshots found in Trash.' ),
// 	'menu_name' => __( 'Economic Snapshots' ),
// );
// $args = array(
// 	'labels' => $labels,
// 	'description' => '',
// 	'public' => true,
// 	'publicly_queryable' => true,
// 	'exclude_from_search' => true,
// 	'show_ui' => true,
// 	'menu_position' => 20,
// 	'menu_icon' => null,
// 	'capability_type' => 'post',
// 	'hierarchical' => false,
// 	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', ),
// 	'taxonomies' => array(),
// 	'rewrite' => true,
// 	'query_var' => true,
// 	'can_export' => true,
// 	'show_in_nav_menus' => true,
// );
// register_post_type('snapshots', $args);



$labels = array(
	'name' => _x( 'Feature Box', 'post type general name' ),
	'singular_name' => _x( 'Feature Box', 'post type singular name' ),
	'add_new' => __( 'Add New Feature Box' ),
	'add_new_item' => __( 'Add New Feature Box' ),
	'edit_item' => __( 'Edit Feature Box' ),
	'new_item' => __( 'New Feature Box' ),
	'view_item' => __( 'View Feature Box' ),
	'search_items' => __( 'Search Feature Boxes' ),
	'not_found' => __( 'No feature boxes found.' ),
	'not_found_in_trash' => __( 'No feature boxes found in Trash.' ),
	'menu_name' => __( 'Feature Boxes' ),
);
$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'menu_position' => 3,
	'menu_icon' => null,
	'capability_type' => 'post',
	'hierarchical' => false,
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', $editflow_supports),
//	'taxonomies' => array('post_tag', ),
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'show_in_nav_menus' => true,
);
register_post_type('feature', $args);




/****************************************************
Eric: I changed the slug of the People post type to 'bio' to prevent conflict with people taxonomy
****************************************************/

$labels = array(
	'name' => _x( 'Author Bios', 'post type general name' ),
	'singular_name' => _x( 'Author Bio', 'post type singular name' ),
	'add_new' => __( 'Add New Author Bio' ),
	'add_new_item' => __( 'Add New Author Bio' ),
	'edit_item' => __( 'Edit Author Bio' ),
	'new_item' => __( 'New Author Bio' ),
	'view_item' => __( 'View Author Bio' ),
	'search_items' => __( 'Search Author Bios' ),
	'not_found' => __( 'No Author Bios found.' ),
	'not_found_in_trash' => __( 'No Author Bios found in Trash.' ),
	'menu_name' => __( 'Author Bios' ),
);
$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => true,
	'show_ui' => true,
	'menu_position' => 20,
	'menu_icon' => null,
	'capability_type' => 'post',
	'hierarchical' => false,
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', $editflow_supports),
	'taxonomies' => array(),
	'rewrite' => true,
//	'rewrite' => array('slug' => bio, 'with_front' => true, ), // Eric: changed to allow author archive pages
	'query_var' => true,
	'can_export' => true,
	'show_in_nav_menus' => true,
);
register_post_type('bio', $args);




$labels = array(
	'name' => _x( 'Clips', 'post type general name' ),
	'singular_name' => _x( 'Clip', 'post type singular name' ),
	'add_new' => __( 'Add New Clip' ),
	'add_new_item' => __( 'Add New Clip' ),
	'edit_item' => __( 'Edit Clip' ),
	'new_item' => __( 'New Clip' ),
	'view_item' => __( 'View Clip' ),
	'search_items' => __( 'Search Clips' ),
	'not_found' => __( 'No clips found.' ),
	'not_found_in_trash' => __( 'No clips found in Trash.' ),
	'menu_name' => __( 'Clips' ),
);
$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => true,
	'show_ui' => true,
	'menu_position' => 20,
	'menu_icon' => null,
	'capability_type' => 'post',
	'hierarchical' => false,
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', ),
	'taxonomies' => array(),
	'rewrite' => true,
	'query_var' => true,
	'can_export' => true,
	'show_in_nav_menus' => true,
	'has_archive' => 'newsroom/clips',
);
register_post_type('clip', $args);


// 
// 
// $labels = array(
// 	'name' => _x( 'EPI News', 'post type general name' ),
// 	'singular_name' => _x( 'EPI News', 'post type singular name' ),
// 	'add_new' => __( 'Add New EPI News' ),
// 	'add_new_item' => __( 'Add New EPI News' ),
// 	'edit_item' => __( 'Edit EPI News' ),
// 	'new_item' => __( 'New EPI News' ),
// 	'view_item' => __( 'View EPI News' ),
// 	'search_items' => __( 'Search EPI News' ),
// 	'not_found' => __( 'No epi news found.' ),
// 	'not_found_in_trash' => __( 'No epi news found in Trash.' ),
// 	'menu_name' => __( 'EPI News' ),
// );
// $args = array(
// 	'labels' => $labels,
// 	'description' => 'EPI News: Read about EPI\'s latest research, publications, upcoming events, and related stories',
// 	'public' => true,
// 	'publicly_queryable' => true,
// 	'exclude_from_search' => false,
// 	'show_ui' => true,
// 	'menu_position' => 20,
// 	'menu_icon' => null,
// 	'capability_type' => 'post',
// 	'hierarchical' => false,
// 	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes', ),
// 	'taxonomies' => array(),
// 	'rewrite' => array('slug' => epinews, 'with_front' => true, ),
// 	'query_var' => true,
// 	'can_export' => true,
// 	'show_in_nav_menus' => true,
// );
// register_post_type('epinews', $args);







/********************************************
Taxonomies
********************************************/


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
	'name' => _x( 'Topics', 'taxonomy general name' ),
	'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
	'search_items' => __( 'Search Topics' ),
	'popular_items' => __( 'Popular Topics' ),
	'all_items' => __( 'All Topics' ),
	'edit_items' => __( 'Edit Topics' ),
	'update_item' => __( 'Update Topics' ),
	'add_new_item' => __( 'Add New Topic' ),
	'new_item_name' => __( 'New Topic' ),
	'separate_items_with_commas' => __( 'Separate topics with commas' ),
	'add_or_remove_items' => __( 'Add or remove topics' ),
	'choose_from_most_used' => __( 'Choose from the most used topics' ),
	'menu_name' => __( 'Topics' ),
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	'hierarchical' => false, // this makes it hierarchical in the UI
	'rewrite' => array( 'hierarchical' => true ), // this makes hierarchical URLs
	'query_var' => true,
);
// register_taxonomy('topic', $allposttypes, $args);




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




$labels = array(
	'name' => _x( 'Issues', 'taxonomy general name' ),
	'singular_name' => _x( 'Issue', 'taxonomy singular name' ),
	'search_items' => __( 'Search Issues' ),
	'popular_items' => __( 'Popular Issues' ),
	'all_items' => __( 'All Issues' ),
	'edit_items' => __( 'Edit Issues' ),
	'update_item' => __( 'Update Issues' ),
	'add_new_item' => __( 'Add New Issue' ),
	'new_item_name' => __( 'New Issue' ),
	'separate_items_with_commas' => __( 'Separate issues with commas' ),
	'add_or_remove_items' => __( 'Add or remove issues' ),
	'choose_from_most_used' => __( 'Choose from the most used issues' ),
	'menu_name' => __( 'Issues' ),
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	'hierarchical' => true, // this makes it hierarchical in the UI
//	'rewrite' => array( 'hierarchical' => true ), // this makes hierarchical URLs
//	'rewrite' => array( 'hierarchical' => false, 'slug' => 'issues' ), 
	'rewrite' => array( 'hierarchical' => false, 'slug' => 'issues' ), 
	'query_var' => true,
);


if( is_admin() && (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') ) ) {
    $args['hierarchical'] = false;
}


register_taxonomy('issue', $allposttypes, $args);




$labels = array(
	'name' => _x( 'People', 'taxonomy general name' ),
	'singular_name' => _x( 'Person', 'taxonomy singular name' ),
	'search_items' => __( 'Search People' ),
	'popular_items' => __( 'Popular People' ),
	'all_items' => __( 'All People' ),
	'edit_items' => __( 'Edit People' ),
	'update_item' => __( 'Update People' ),
	'add_new_item' => __( 'Add New Person' ),
	'new_item_name' => __( 'New Person' ),
	'separate_items_with_commas' => __( 'Separate people with commas' ),
	'add_or_remove_items' => __( 'Add or remove people' ),
	'choose_from_most_used' => __( 'Choose from the most used people' ),
	'menu_name' => __( 'People' ),
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	'hierarchical' => true,
	'rewrite' => true,
	'query_var' => true,
);


if( is_admin() && (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') ) ) {
    $args['hierarchical'] = false;
}

register_taxonomy('people', $allposttypes, $args);






$labels = array(
	'name' => _x( 'Sources', 'taxonomy general name' ),
	'singular_name' => _x( 'Source', 'taxonomy singular name' ),
	'search_items' => __( 'Search Sources' ),
	'popular_items' => __( 'Popular Sources' ),
	'all_items' => __( 'All Sources' ),
	'edit_items' => __( 'Edit Sources' ),
	'update_item' => __( 'Update Sources' ),
	'add_new_item' => __( 'Add New Source' ),
	'new_item_name' => __( 'New Source' ),
	'separate_items_with_commas' => __( 'Separate sources with commas' ),
	'add_or_remove_items' => __( 'Add or remove sources' ),
	'choose_from_most_used' => __( 'Choose from the most used sources' ),
	'menu_name' => __( 'Sources' ),
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	'hierarchical' => false,
//	'rewrite' => true,
	'rewrite' => array( 'slug' => 'source', 'with_front' => true ),
	'query_var' => true,
);
register_taxonomy('source', array('clip', ), $args);

}
