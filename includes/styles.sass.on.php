<?php 




/****************************************************
	SASS

	Do not deactivate this or the stylesheet will not load!

****************************************************/



// Include the class (unless you are using the script as a plugin)
// require_once( get_template_directory() . '/wp-sass/wp-sass.php' );
// require_once( realpath(dirname(__FILE__)) . '/wp-sass/wp-sass.php' );

$wpSassPluginLocation = realpath(dirname(__FILE__)) . '/_plugins/wp-sass/wp-sass.php';
if (file_exists($wpSassPluginLocation)) {
	require_once( $wpSassPluginLocation );
}


// Enqueue the SASS stylesheets
if ( ! is_admin() ) {
	wp_enqueue_style( 'sass_main', get_stylesheet_directory_uri() . '/sass.scss.css' );
	// wp_enqueue_style( 'sass_main', get_stylesheet_directory_uri() . '/sass.php' );
} else {
	// wp_enqueue_style( 'admin', get_stylesheet_directory_uri() . '/admin.sass.php' );	
}

// If you want to use a SASS file as a TinyMCE stylesheet
// add_editor_style( 'editor-style.sass' );