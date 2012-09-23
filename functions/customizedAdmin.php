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
*****************************************************
*****************************************************
Only execute this stuff if we are in the admin section.
Using the is_admin() prevents us from loading extra code where don't need it.
*****************************************************
*****************************************************
****************************************************/

if (is_admin()) {


/****************************************************
Adds new taxonomy dropdown filters to custom post type edit lists.
****************************************************/

	add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
	 function my_restrict_manage_posts() {
	 
	 // only display these taxonomy filters on desired custom post_type listings
	 global $typenow;
	 if ($typenow == 'post' || $typenow == 'page' || $typenow == 'publication' || $typenow == 'bio' || $typenow == 'feature' || $typenow == 'clip' || $typenow == 'blog' || $typenow == 'issuepage'  ) {
	 
	     // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
	     $filters = array('people', 'type', 'topic', 'issue', 'internal');
	 
	     foreach ($filters as $tax_slug) {
	         // retrieve the taxonomy object
	         $tax_obj = get_taxonomy($tax_slug);
	         $tax_name = $tax_obj->labels->name;
	         // retrieve array of term objects per taxonomy
	         $terms = get_terms($tax_slug);
	 
	         // output html for taxonomy dropdown filter
	         echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
	         echo "<option value=''>Show All $tax_name</option>";
	         foreach ($terms as $term) {
	             // output each select option line, check against the last $_GET to show the current option selected
	             echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
	         }
	         echo "</select>";
	     }
	 }
	 }

/**************  END  ********************/




add_action('admin_head','hides_menus');

function hides_menus() {
	$array = array('posts', 'links', 'comments');?>
	<style type="text/css">
	<?php
	foreach ($array as $value) {
		echo '#menu-' . $value . ', ';
		} ?> { display:none; } </style>
	<?php }


}  // End of is_admin()










