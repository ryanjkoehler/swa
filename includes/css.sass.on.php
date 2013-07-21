<?php 




/****************************************************
	SASS

	Do not deactivate this or the stylesheet will not load!

****************************************************/



// Include the class (unless you are using the script as a plugin)
$sassClassPath = get_template_directory().'/functions/css.sass/wp-sass.php';

if ( file_exists( $sassClassPath ) ) {
	require_once( $sassClassPath );
}


// Enqueue the SASS stylesheets
if ( ! is_admin() ) {
	wp_enqueue_style( 'sass_main', get_stylesheet_directory_uri() . '/sass.scss' );
} else {
	// wp_enqueue_style( 'admin', get_stylesheet_directory_uri() . '/admin.sass.php' );	
}

// If you want to use a SASS file as a TinyMCE stylesheet
// add_editor_style( 'editor-style.sass' );