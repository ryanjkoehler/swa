<?php 
/****************************************************
	Scripts and styles
	
	How to properly add scripts in Wordpress
	http://wpcandy.com/teaches/how-to-load-scripts-in-wordpress-themes
	
	How to enqueue inline scripts
	http://wordpress.stackexchange.com/questions/24851/wp-enqueue-inline-script-due-to-dependancies
****************************************************/

/****************************************************
	Include all script in js-admin.php in the <head>
	by adding it to the wp_head hook

	This stuff might be deprecated
	Because enqueue is a better practice
****************************************************/

function epi_add_js_head() {
	$file = dirname( __FILE__ ) . '/wp_head.php';
	if (file_exists($file))
		include($file);
}
add_action('wp_head', 'epi_add_js_head');

function epi_add_js_footer() {
	$file = dirname( __FILE__ ) . '/wp_footer.php';
	if (file_exists($file))
		include($file);
}
add_action('wp_footer', 'epi_add_js_footer', 999);

function epi_add_js_footer_print() {
	if ( isset($_GET["view"]) && ($_GET["view"] == 'print') ) {
		$file = dirname( __FILE__ ) . '/wp_footer-print.php';
		if (file_exists($file))
			include($file);
	}
}
add_action('wp_footer', 'epi_add_js_footer_print');





/**
 * Registers and enqueues all javascript files ending in ".on.js"
 * If you want to only include the script conditionally (e.g., only on the homepage) use dequeue
 * 
 * @package WordPress
 * @param 
 * @param 
 * @param 
 * @return
 * @example: jquery.myplugin.1.4.min.js is registered as 'jquery-myplugin'
 * @uses bla
 * ... More information if needed.
 */


function epi_gravity_forms_css() {
	wp_dequeue_style('gforms_css');
	wp_dequeue_style('gforms_css-css');
}

add_action( 'wp_print_scripts', 'epi_gravity_forms_css' );
add_action( 'wp_print_styles', 'epi_gravity_forms_css' );
add_action( 'wp_enqueue_scripts', 'epi_gravity_forms_css' );
add_action( 'wp_enqueue_styles', 'epi_gravity_forms_css' );

// None of these seem to work to dequeue Gravity Forms CSS 
// http://www.seodenver.com/disable-gravity-forms-css-stylesheet/
function remove_gravityforms_style() { 
	wp_dequeue_style('gforms_css');
}
add_action('wp_print_styles', 'remove_gravityforms_style', 999999999);




add_action( 'wp_enqueue_scripts', 'epi_autoload_css_files_from_folder' );

function epi_autoload_css_files_from_folder() {
	
	$templatePath = get_template_directory(); // absolute path, no trailing slash
	$templateURI = get_template_directory_uri();
	
	/** Settings */
	$path = dirname(dirname( __FILE__ )); // Go up one directory
	$folder = '/includes-css/';
	$suffix = '.on'; 
	$extension = '.css';
	$searchstring = $path . $folder . "*" . $suffix . $extension;
	
	/** Loop through the folder to find matching files */ 
	foreach (glob($searchstring) as $file) {

		// Use the filename to make a script slug
		$slug = basename($file, $suffix.$extension );
		$slug = str_replace( '.', '-', strtolower($slug) );
		$slug = preg_replace( '/([\d-]|min)+$/', '', $slug );

		// Get the script URI
		$script_uri = $templateURI . str_replace($templatePath, '', $file);

		// Other parameters
		$version = null; // A null version prevents Wordpress from adding a query string to the end of our URL, which prevents caching
		$version = false; 
		$media = false; // For CSS, the default is false
		$in_footer = false; // For scripts, WP default is to output in the head
		$dependencies = array();

		wp_register_style(
			$slug, 
			$script_uri, 
			$dependencies, 
			$version, 
			$media );
		
		wp_enqueue_style( $slug );
	}
}



// NOTE -- THE ABOVE CSS VERSION OF THIS FUNCTION IS SLIGHTLY REFACTORED AND BETTER THAN THIS ONE --2012-09-02 23:37:35
add_action( 'wp_enqueue_scripts', 'epi_autoload_javascript_files_from_folder' );

function epi_autoload_javascript_files_from_folder() {
	
	$templatePath = get_template_directory(); // absolute path, no trailing slash
	$templateURI = get_template_directory_uri();
	
	/** Settings */
	$path = dirname(dirname( __FILE__ )); // Go up one directory
	$folder = '/includes-js/';
	$suffix = '.on'; 
	$extension = '.js';
	
	/** Loop through the matching files */ 
	foreach (glob($path.$folder."*".$suffix.$extension) as $file) {
		
		$script_uri = $templateURI . str_replace($templatePath, '', $file);
		
		// Use the filename to make a script slug. 
		// @example: jquery.myplugin.1.4.min.js becomes jquery-myplugin
		$slug = basename($file, $suffix.$extension );
		$slug = str_replace( '.', '-', strtolower($slug) );
		$slug = preg_replace( '/([\d-]|min)+$/', '', $slug );
				
		wp_register_script(
			$slug, 
			$script_uri, 
			array('jquery'), 
			null, true );
		
		wp_enqueue_script( $slug );
	}
}


// Let's try dequeueing something.

add_action( 'wp_enqueue_scripts', 'epi_javascript_conditionals' );

function epi_javascript_conditionals() {
	// if ( !is_front_page() );
		// wp_dequeue_script('aaa-test');
}




/****************************************************
	Replace local jQuery with Google's hosted copy
****************************************************/
add_action( 'wp_enqueue_scripts', 'epi_use_google_jquery' );

function epi_use_google_jquery() {
	if( !is_admin()){
	   wp_deregister_script('jquery'); 
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"), false, '1.7.2'); 
	   wp_enqueue_script('jquery');
	}
}

add_action( 'wp_enqueue_scripts', 'epi_dequeue_from_jumpdrive', 9999 );

function epi_dequeue_from_jumpdrive() {
	if( !is_admin() && is_page('swa-launch')){
	   // wp_deregister_script('jquery'); 
	   // wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"), false, '1.7.2'); 
	   // wp_enqueue_script('jquery');
	   wp_dequeue_script('jquery');

	}
}






/****************************************************
	Register and add javascript files
****************************************************/





// add_action( 'wp_enqueue_scripts', 'epi_load_javascript_files' );
// 
// function epi_load_javascript_files() {
// 	$dir = get_template_directory_uri();
// 	$pt = get_post_type();
// 	
// 	
// 	/****************************************************
// 	jquery.valign: used for vertically centering in the footer
// 	@todo: Very small, could probably be made inline. */
// 	
// 	wp_register_script(
// 		'jquery-valign', 
// 		$dir . '/js/jquery.valign.js', 
// 		array('jquery'), 
// 		null, true );
// 		
// 	wp_enqueue_script( 'jquery-valign' );
// 	
// 	
// 	/****************************************************
// 	Table2CSV: Parses an HTML table into a CSV or TSV
// 	@where: Used in charts */
// 	
// 	wp_register_script( 
// 		'jquery-table2csv', 
// 		$dir . '/js/jquery.table2csv.js', 
// 		array('jquery'),
// 		null, true );
// 
// 	if ( $pt == 'chart' )
// 		wp_enqueue_script( 'jquery-table2csv' );
// 	
// 	
// 	/****************************************************
// 	Table2CSV: Parses an HTML table into a CSV or TSV
// 	@where: used in Snapshot/Video/Quick Take tabbed widget */
// 	
// 	wp_register_script( 
// 		'jquery-jwtabs', 
// 		$dir . '/js/jquery.jwTabs.js', 
// 		array('jquery'),
// 		null, true );
// 
// 	if ( is_front_page() ) {
// 		wp_enqueue_script( 'jquery-jwtabs' );
// 		epi_add_inline_script('jquery-jwtabs');
// 	}
// 		
// 
// }







/****************************************************
	Register and add CSS files
****************************************************/

add_action('wp_enqueue_scripts', 'epi_add_css');

function epi_add_css() { 
	$dir = get_template_directory_uri();

	wp_register_style( 
		'epi-main',
		$dir . '/css/main.css',
		array(), null, 'all' );

	wp_register_style( 
		'epi-print',
		$dir . '/css/print.css',
		array(), null, 'print' );

	wp_register_style( 
		'slider-bsd',
		$dir . '/slider-bsd.css',
		array(), null, 'all');	

	wp_register_style( 
		'epi-typography',
		$dir . '/css/css-typography.css',
		array(), null, 'all');	

	wp_register_style( 
		'googlefonts-open-sans',
		'http://fonts.googleapis.com/css?family=Open+Sans:400,800',
		array(), null, 'all' );
	
	wp_register_style( 
		'googlefonts-francois-one',
		'http://fonts.googleapis.com/css?family=Francois+One',
		array(), null, 'all' );

	// wp_enqueue_style( 'epi-typography' );
	
	
	// wp_enqueue_style( 'epi-main' );
	// wp_enqueue_style( 'googlefonts-open-sans' );
	// wp_enqueue_style( 'googlefonts-francois-one' );
	
	
	// $isPrint = get_query_var('view') == 'print';
	// $pt = get_post_type();
	
	// if (!$isPrint) {
	// 	wp_enqueue_style( 'epi-print' );
	// }
	
	// if (is_front_page()) {
	// 	wp_enqueue_style( 'slider-bsd' );
	// }	
	

}




add_action( 'wp_enqueue_scripts', 'epi_css_conditionals' );

function epi_css_conditionals() {
	$isPrint = get_query_var('view') == 'print';
	$pt = get_post_type();
	
	wp_dequeue_style( 'epi-print' );
	
	if ($pt == 'chart') {
		wp_dequeue_style( 'epi-main' );
	}
	
}



