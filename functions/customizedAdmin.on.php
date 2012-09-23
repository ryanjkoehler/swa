<?php






/*****************************************
Add custom links to the admin bar
*****************************************/


function my_admin_bar_menu() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	
	$wp_admin_bar->add_menu( array(
//	'parent' => 'epi_admin_menu',
	'id' => 'epi_show_editable_fields_menu_item',
	'title' => __( '#'),
	'href' => '#',
	'meta' => array( 'onclick' => '$(".admin-only").toggle(); event.preventDefault();' )));

	$wp_admin_bar->add_menu( array(
	'id' => 'epi_admin_menu',
	'title' => __( '★ EPI ★'),
	'href' => admin_url('plugin-install.php') ) );

	$wp_admin_bar->add_menu( array(
	'parent' => 'epi_admin_menu',
	'title' => __( 'Add Plugins'),
	'href' => admin_url('plugin-install.php') ) );
	$wp_admin_bar->add_menu( array(
	'parent' => 'epi_admin_menu',
	'title' => __( 'Installed Plugins'),
	'href' => admin_url('plugins.php') ) );
	$wp_admin_bar->add_menu( array(
	'parent' => 'epi_admin_menu',
	'title' => __( 'Custom Field Template'),
	'href' => admin_url('options-general.php?page=custom-field-template.php') ) );
	$wp_admin_bar->add_menu( array(
	'parent' => 'epi_admin_menu',
	'title' => __( 'Search Regex'),
	'href' => admin_url('tools.php?page=search-regex.php') ) );
	// 
	// $wp_admin_bar->add_menu( array(
	// 'id' => 'epi_admin_menu_2',
	// 'title' => __( 'Themes'),
	// 'href' => admin_url('themes.php') ) );
	// 
	// $wp_admin_bar->add_menu( array(
	// 'parent' => 'epi_admin_menu_2',
	// 'title' => __( 'Install Themes'),
	// 'href' => admin_url('theme-install.php') ) );
	// 
	$wp_admin_bar->add_menu( array(
	'parent' => 'epi_admin_menu',
	'id' => 'import_wxr',
	'title' => __( 'Import WXR'),
	'href' => admin_url('admin.php?import=wordpress') ) );

	$wp_admin_bar->add_menu( array(
	'parent' => 'epi_admin_menu',
	'title' => __( 'Export WXR'),
	'href' => admin_url('export.php') ) );

	$wp_admin_bar->add_menu( array(
	'parent' => 'epi_admin_menu',
	'title' => __( 'Pages Tree View'),
	'href' => admin_url('edit.php?post_type=page&page=cms-tpv-page-page') ) );
	
	$wp_admin_bar->add_menu( array(
	'parent' => 'epi_admin_menu',
	'title' => __( 'Backup Buddy'),
	'href' => admin_url('admin.php?page=pluginbuddy_backupbuddy-backup') ) );
	
	$wp_admin_bar->add_menu( array(
	'parent' => 'epi_admin_menu',
	'title' => __( 'Permalinks'),
	'href' => admin_url('options-permalink.php') ) );
	
	$wp_admin_bar->add_menu( array(
	'parent' => 'epi_admin_menu',
	'title' => __( 'Show editable fields'),
	'href' => '#',
	'meta' => array( 'onclick' => '$(".admin-only").toggle(); event.preventDefault();' )));

/*
	'id' => 'epi_admin_menu',
	'parent' => 'wp-admin-bar-appearance',
	'title' => __( 'Themes'),
	'href' => admin_url('themes.php') ) );
*/

// 
// $defaults = array(
// 	'title' => false,
// 	'href' => false,
// 	'parent' => false, // false for a root menu, pass the ID value for a submenu of that menu.
// 	'id' => false, // defaults to a sanitized title value.
// 	'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
// );



/****************************************************
	Add Edit dropdown for all post types.
****************************************************/

$wp_admin_bar->add_menu( array(
'id' => 'epi_edit_custom_post_types',
'title' => __( 'Edit'),
'href' => admin_url('edit.php?post_type=publication') ) );



$args = array(
	'public' => true
	);
$types = get_post_types($args, 'objects');


foreach ( $types as $type ) {

$wp_admin_bar->add_menu( array(
'parent' => 'epi_edit_custom_post_types',
'title' => __( $type->labels->name ),
'href' => admin_url( 'edit.php?post_type='. $type->name ) ) );

} 

} // end of Edit dropdown

add_action('admin_bar_menu', 'my_admin_bar_menu');



