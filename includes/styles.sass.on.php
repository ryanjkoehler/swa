<?php 

/**
 * Include SASS stylesheets, which then get compiled on the fly by WP-Sass and PHPSass
 *
 * @since 2012-09-24 07:28:26
 * @uses  WP-Sass Wordpress plugin for PHPSass
 * @link  https://github.com/sanchothefat/wp-sass
 * @uses  PHPSass Sass compiler for PHP
 * @link  https://github.com/richthegeek/phpsass
 * 
 */

/**
 * Include the WP-Sass plugin. We do this manually since we are not using WP-Sass as a traditional plugin.
 */
$wpSassPluginLocation = realpath(dirname(__FILE__)) . '/+plugins/wp-sass/wp-sass.php';
if ( file_exists($wpSassPluginLocation) ) {
	require_once( $wpSassPluginLocation );
}


/**
 * Enqueue the SASS stylesheets. Their filenames must end in .scss, .sass, .scss.php, or .sass.php.
 */
if ( ! is_admin() ) {
	wp_enqueue_style( 'sass_main', get_stylesheet_directory_uri() . '/sass.scss' );
	// wp_enqueue_style( 'sass_main', get_stylesheet_directory_uri() . '/sass.php' );
} else {
	// wp_enqueue_style( 'admin', get_stylesheet_directory_uri() . '/admin.sass.php' );
	// If you want to use a SASS file as a TinyMCE stylesheet
	// add_editor_style( 'editor-style.sass' );
}